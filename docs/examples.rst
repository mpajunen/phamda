Examples
========

These examples highlight the major features of Phamda. Basic usage examples can also be found on the
:doc:`function list</functions>`.


Currying
--------

Nearly all of the functions use automatic partial application or **currying**. This means that you can call the
:ref:`filter` function with only the predicate callback and get a new function:

.. code-block:: php

    use Phamda\Phamda as P;

    $isPositive   = function ($x) { return $x > 0; };
    $list         = [5, 7, -3, 19, 0, 2];
    $getPositives = P::filter($isPositive);

    $getPositives($list) === [5, 7, 3 => 19, 5 => 2];

The final result is the same as using two arguments directly. Of course this new function could now be used to filter
other lists as well.

It's also possible to create new curried functions, including from native PHP functions. The :ref:`curry` function
takes a function and initial parameters and returns a new function:

.. code-block:: php

    $replaceBad = P::curry('str_replace', 'bad', 'good');

    $replaceBad('bad day') === 'good day';
    $replaceBad('not bad') === 'not good';


Composition
-----------

Phamda functions are **composable**. The basic functions can be used to create new, more complex functions. There are
also several functions to help with function composition. For example the :ref:`compose` function takes multiple
argument functions and returns a new function. Calling this new function applies the argument functions in succession:

.. code-block:: php

    $double           = function ($x) { return $x * 2; };
    $addFive          = function ($x) { return $x + 5; };
    $addFiveAndDouble = P::compose($double, $addFive);

    $addFiveAndDouble(16) === 42;

    // Equivalent to calling $double($addFive(16));


Often the :ref:`pipe` function is a more natural way to compose functions. It is similar to :ref:`compose`, but the
argument functions are applied in reverse order:

.. code-block:: php

    $doubleAndAddFive = P::pipe($double, $addFive);

    $doubleAndAddFive(16) === 37;


Parameter order
---------------

When using functional techniques it's usually most convenient if data is the last parameter. Often native PHP and
library functions do not follow for this pattern. Phamda includes some tools to make it easier to use these functions
functionally. The simplest is :ref:`flip`, it switches the order of the first two parameters:

.. code-block:: php

    $pow   = function ($a, $b) { return $a ** $b; };
    $powOf = P::flip($pow);

    $pow(2, 8) === 256;
    $powOf(2, 8) === 64;


:ref:`twist` is somewhat more complicated and will return a new function where the original first parameter is now last:

.. code-block:: php

    $redact = P::twist('substr_replace')('REDACTED', 5);

    $redact('foobarbaz') === 'foobaREDACTED';


Using :ref:`twist` may not work well with variadic functions. This is where :ref:`twistN` can be useful. It requires an
additional parameter to set the location of the replaced parameter.

All of these functions return curried functions.


Pipelines
---------

Combining these techniques allows the building of function pipelines. In this example they are applied to processing a
list of badly formatted product data:

.. code-block:: php

    $products = [
        ['category' => 'QDT', 'weight' => 65.8, 'price' => 293.5, 'number' => 15708],
        ['number' => 59391, 'price' => 366.64, 'category' => 'NVG', 'weight' => 15.5],
        ['category' => 'AWK', 'number' => 89634, 'price' => 341.92, 'weight' => 35],
        ['price' => 271.8, 'weight' => 5.3, 'number' => 38718, 'category' => 'ETW'],
        ['price' => 523.63, 'weight' => 67.9, 'number' => 75905, 'category' => 'YVM'],
        ['price' => 650.31, 'weight' => 3.9, 'category' => 'XPA', 'number' => 46289],
        ['category' => 'WGX', 'weight' => 75.5, 'number' => 26213, 'price' => 471.44],
        ['category' => 'KCF', 'price' => 581.85, 'weight' => 31.9, 'number' => 48160],
    ];

    $formatPrice = P::flip('number_format')(2);
    $process     = P::pipe(
        P::filter( // Only include products that...
            P::pipe(
                P::prop('weight'), // ... weigh...
                P::gt(50.0) // ... less than 50.0.
            )
        ),
        P::map( // For each product...
            P::pipe(
                // ... drop the weight field and fix field order:
                P::pick(['number', 'category', 'price']),
                // ... and format the price:
                P::evolve(['price' => $formatPrice])
            )
        ),
        P::sortBy( // Sort the products by...
            P::prop('number') // ... comparing product numbers.
        )
    );

    $process($products) === [
        ['number' => 38718, 'category' => 'ETW', 'price' => '271.80'],
        ['number' => 46289, 'category' => 'XPA', 'price' => '650.31'],
        ['number' => 48160, 'category' => 'KCF', 'price' => '581.85'],
        ['number' => 59391, 'category' => 'NVG', 'price' => '366.64'],
        ['number' => 89634, 'category' => 'AWK', 'price' => '341.92'],
    ];
