Phamda
======

Phamda is a set of functional programming tools for PHP 5.6+, heavily inspired by the Javascript library
[Ramda](http://ramdajs.com/).

Examples
========

Phamda includes several typical functional programming tools, for example `filter` and `map`:

```php
use Phamda\Phamda;

$list = [5, 7, -3, 19, 0, 2];

$isPositive = function ($x) { return $x > 0; };
$result     = Phamda::filter($isPositive, $list); // [5, 7, 19, 2]

$double = function ($x) { return $x * 2; };
$result = Phamda::map($double, $list); // [10, 14, -6, 38, 0, 4]
```

The main feature of the library is that nearly all of the functions use automatic partial application or
currying. This means that you can call the `filter` function with only the predicate callback. The
result is a new function:

```php
$getPositives = Phamda::filter($isPositive);
$result       = $getPositives($list); // [5, 7, 19, 2]
```

The final result is the same as using two parameters directly. Of course this new function could now be
used to filter other lists as well.

Another feature of Phamda is that the functions can easily be used to create new functions. For example
the `compose` function takes multiple functions as parameters and returns a new function. Calling this
new function applies the original functions in succession:

```php
$addFive          = function ($x) { return $x + 5; };
$addFiveAndDouble = Phamda::compose($double, $addFive);
$result           = $addFiveAndDouble(16); // 42
// Equivalent to calling $double($addFive(16));
```

In the next example these concepts are applied to processing a list of badly formatted product data.
Here the `pipe` function is used. It's the similar to `compose` but the parameter functions are applied
in reverse order:

```php
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

$process = Phamda::pipe(
    Phamda::filter( // Only include products that...
        Phamda::pipe(
            Phamda::prop('weight'), // ... weigh...
            Phamda::gt(50.0) // ... less than 50.0. (The parameter order is unintuitive here.)
        )
    ),
    Phamda::map( // For each product...
        Phamda::pick(['number', 'category', 'price']) // ... drop the weight field and fix field order.
    ),
    Phamda::map( // For each product...
        Phamda::map( // ... check the fields...
            function ($value, $key) {
                return $key === 'price' ? number_format($value, 2) : $value; // ... and format the price.
            }
        )
    ),
    Phamda::sort( // Sort the products...
        Phamda::comparator(
            function ($a, $b) {
                return $a['number'] < $b['number']; // ... by the product number.
            }
        )
    )
);

// Note that the actual data is not used before the next row.
$result = $process($products);
/*
[
    ['number' => 38718, 'category' => 'ETW', 'price' => '271.80'],
    ['number' => 46289, 'category' => 'XPA', 'price' => '650.31'],
    ['number' => 48160, 'category' => 'KCF', 'price' => '581.85'],
    ['number' => 59391, 'category' => 'NVG', 'price' => '366.64'],
    ['number' => 89634, 'category' => 'AWK', 'price' => '341.92'],
]
*/
```

License
=======

MIT license, see LICENSE file.
