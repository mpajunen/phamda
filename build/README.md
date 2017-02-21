# Phamda Code Generator

Code generator for the [Phamda](https://github.com/mpajunen/phamda) library. It generates:

- Auto-curried functions from inner functions.
- Basic test cases based on the same inner functions.
- A function list for documentation.

## Usage

To add or modify a function in Phamda:

- Fork and clone the repository.
- Install dependencies: `composer install`.
- Make changes, typically to the `build/Builder/InnerFunctions.php` file.
- Build generated files: `composer build`.
- Add a test data provider to the `tests/BasicProvidersTrait.php` file if adding a new function.

The code generator uses [PHP Parser](https://github.com/nikic/PHP-Parser) for manipulating the code and
[PHP CS Fixer](https://github.com/FriendsOfPHP/PHP-CS-Fixer) to fix some style issues in the output.
