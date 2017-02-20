# Phamda Code Generator

Code generator for the [Phamda](https://github.com/mpajunen/phamda) library.

- Generates curried functions from inner functions.
- Generates basic test cases based on the same inner functions.

## Usage

To add or modify a function in Phamda:

- Fork and clone the repository.
- Install dependencies: `composer install`.
- Make changes to the `build/Builder/InnerFunctions.php` file.
- Execute the builder: `php build/build.php`.
- Add a test data provider to `tests/BasicProvidersTrait.php` file if adding a new function.

[PHP CS Fixer](https://github.com/FriendsOfPHP/PHP-CS-Fixer) is also required.
