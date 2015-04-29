Examples
========

Here are a few examples highlighting the major features of Phamda. Basic usage examples can also be found on the
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
    $result       = $getPositives($list); // => [5, 7, 19, 2]

The final result is the same as using two arguments directly. Of course this new function could now be used to filter
other lists as well.

It's also possible to create new curried functions, including from native PHP functions. The :ref:`curry` function
takes a function and initial parameters and returns a new function:

.. code-block:: php

    $replaceBad = P::curry('str_replace', 'bad', 'good');
    $dayResult  = $replaceBad('bad day'); // => 'good day'
    $notResult  = $replaceBad('not bad'); // => 'not good'


Composition
-----------

Phamda functions are **composable**. The basic functions can be used to create new, more complex functions. There are
also several functions to help with function composition. For example the :ref:`compose` function that takes multiple
argument functions and returns a new function. Calling this new function applies the argument functions in succession:

.. code-block:: php

    $double           = function ($x) { return $x * 2; };
    $addFive          = function ($x) { return $x + 5; };
    $addFiveAndDouble = P::compose($double, $addFive);
    $result           = $addFiveAndDouble(16); // => 42
    // Equivalent to calling $double($addFive(16));


Placeholders
------------

Phamda also supports **placeholder arguments**. A placeholder can be created by calling the `_` (underscore) function.
A placeholder can be used with any curried function, for example:

.. code-block:: php

    $_           = P::_();
    $subtractTen = P::subtract($_, 10);
    $result      = $subtractTen(22); // => 12

Placeholders also work with manually curried functions:

.. code-block:: php

    $slashCount = P::curry('substr_count', P::_(), '/');
    $result     = $slashCount('ab/c/de//f/'); // => 5


Pipelines
---------

Combining these techniques allows the building of function pipelines. In this example they are applied to processing a
list of badly formatted product data using the :ref:`pipe` function. It's similar to :ref:`compose` but the argument
functions are applied in reverse order:

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

    $formatPrice = P::curry('number_format', P::_(), 2);
    $process     = P::pipe(
        P::filter( // Only include products that...
            P::pipe(
                P::prop('weight'), // ... weigh...
                P::lt(P::_(), 50.0) // ... less than 50.0.
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

    $result = $process($products);
    /* =>
    [
        ['number' => 38718, 'category' => 'ETW', 'price' => '271.80'],
        ['number' => 46289, 'category' => 'XPA', 'price' => '650.31'],
        ['number' => 48160, 'category' => 'KCF', 'price' => '581.85'],
        ['number' => 59391, 'category' => 'NVG', 'price' => '366.64'],
        ['number' => 89634, 'category' => 'AWK', 'price' => '341.92'],
    ]
    */
