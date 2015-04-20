# Phamda

Phamda is a set of functional programming tools for PHP, heavily inspired by the Javascript library
[Ramda](http://ramdajs.com/). PHP 5.6+ or HHVM is required.

## Installation

Using composer: `composer require phamda/phamda`

## Examples

Phamda includes several typical functional programming tools, though the argument order may be atypical. For
example `filter` and `map`:

```php
use Phamda\Phamda;

$list = [5, 7, -3, 19, 0, 2];

$isPositive = function ($x) { return $x > 0; };
$result     = Phamda::filter($isPositive, $list); // => [5, 7, 19, 2]

$double = function ($x) { return $x * 2; };
$result = Phamda::map($double, $list); // => [10, 14, -6, 38, 0, 4]
```

The argument order supports the main feature of Phamda: Nearly all of the functions use **automatic partial
application** or currying. This means that you can call the `filter` function with only the predicate
callback, resulting in a new function:

```php
$getPositives = Phamda::filter($isPositive);
$result       = $getPositives($list); // => [5, 7, 19, 2]
```

The final result is the same as using two arguments directly. Of course this new function could now be used
to filter other lists as well.

Another major feature of Phamda is that the functions are **composable**. The basic functions can be used to
create more complex ones. In addition there are several functions to help with function composition, for
example the `compose` function that takes multiple argument functions and returns a new function. Calling
this new function applies the argument functions in succession:

```php
$addFive          = function ($x) { return $x + 5; };
$addFiveAndDouble = Phamda::compose($double, $addFive);
$result           = $addFiveAndDouble(16); // => 42
// Equivalent to calling $double($addFive(16));
```

Phamda also supports **placeholder arguments**. A placeholder can be created by calling the `_` function.
A placeholder can be used with all curried functions, for example:

```php
$subtractTen = Phamda::subtract(Phamda::_(), 10);
$result      = $subtractTen(22); // => 12
```

In the next example these concepts are applied to processing a list of badly formatted product data.
The `pipe` function is used here. It's similar to `compose` but the argument functions are applied in
reverse order:

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

$formatPrice = Phamda::curry('number_format', Phamda::_(), 2);
$process     = Phamda::pipe(
    Phamda::filter( // Only include products that...
        Phamda::pipe(
            Phamda::prop('weight'), // ... weigh...
            Phamda::lt(Phamda::_(), 50.0) // ... less than 50.0.
        )
    ),
    Phamda::map( // For each product...
        Phamda::pipe(
            Phamda::pick(['number', 'category', 'price']), // ... drop the weight field and fix field order.
            Phamda::evolve(['price' => $formatPrice]) // ... and format the price.
        )
    ),
    Phamda::sortBy( // Sort the products by...
        Phamda::prop('number') // ... comparing product numbers.
    )
);

// Note that the actual data is not used before the next row.
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
```

The [function list](docs/Functions.rst) includes more examples.

## License

MIT license, see LICENSE file.
