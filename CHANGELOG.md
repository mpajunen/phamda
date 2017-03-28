# Changelog

## [Unreleased]

### Changed
- `P::flip` now returns a curried function.
- Function parameters with unambiguous types now have type declarations.

### Removed
- Placeholder arguments
- `P::dec`, `P::inc`

## [0.7.0] - 2016-03-27
### Added
- PHP 7.1 test coverage

### Changed
- `P::first` and `P::last` now return `null` instead of `false` if the collection is empty.
- `P::indexOf` now returns `null` instead of `false` if the item is not found.
- `P::stringIndexOf` and `P::stringLastIndexOf` now return `null` instead of `false` if the substring is not found.
- `P::isEmpty` now expects that the collection is `\Countable` (or implements `isEmpty` method or is an array).
- Some functions now enforce their parameter types more strictly.

### Deprecated
- Placeholder arguments
- `P::dec`, `P::inc`

### Removed
- PHP 5.6 support

## [0.6.1] - 2016-05-19
### Changed
- Allow empty delimiter for `P::explode`.

## [0.6.0] - 2016-05-19
### Added
- `P::fromPairs`, `P::toPairs`

## [0.5.0] - 2016-03-31
### Fixed
- Added missing `key` and `collection` arguments in `P::each`.

### Removed
- `P::*Indexed`

## [0.4.0] - 2016-01-14
### Added
- PHP 7.0 test coverage

### Changed
- Inner functions of all basic collection functions once again receive `value`, `key` and `collection` as arguments. 

### Deprecated
- `P::*Indexed`

## [0.3.0] - 2015-04-29
### Added
- `P::*Indexed`, separate multi parameter versions of the basic collection functions
- `P::evolve`

### Changed
- Only `value` is passed to the inner function of the basic collection functions.

## [0.2.0] - 2015-04-09
### Added
- `P::apply`, `P::flatMap`, `P::invoker` and 7 other functions

### Changed
- Expanded placeholder support
- Support negative indexes in string and collection manipulation

## [0.1.0] - 2015-03-23
### Added
- `P::compose`, `P::curry`, `P::pipe` and various other functions, 93 total
- Basic placeholder argument support
- PHP 5.6 and partial HHVM support



[Unreleased]: https://github.com/mpajunen/phamda/compare/0.7.0...HEAD
[0.7.0]: https://github.com/mpajunen/phamda/compare/0.6.1...0.7.0
[0.6.1]: https://github.com/mpajunen/phamda/compare/0.6.0...0.6.1
[0.6.0]: https://github.com/mpajunen/phamda/compare/0.5.0...0.6.0
[0.5.0]: https://github.com/mpajunen/phamda/compare/0.4.0...0.5.0
[0.4.0]: https://github.com/mpajunen/phamda/compare/0.3.0...0.4.0
[0.3.0]: https://github.com/mpajunen/phamda/compare/0.2.0...0.3.0
[0.2.0]: https://github.com/mpajunen/phamda/compare/0.1.0...0.2.0
[0.1.0]: https://github.com/mpajunen/phamda/tree/0.1.0
