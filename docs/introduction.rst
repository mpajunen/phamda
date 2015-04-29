Introduction
============

Phamda is a functional programming library for PHP. The main features are:

* A set mostly familiar functions, including basic ones like :ref:`filter`, :ref:`map` and :ref:`reduce`.
* Almost all of the functions are automatically curried. Calling a function with fewer parameters than are expected
  returns a new function.
* Placeholder arguments can be used with all of these curried functions.
* The functions are designed to be composable. Specific functions like :ref:`compose` and :ref:`pipe` enable different
  composition patterns.


Requirements
------------

* PHP 5.6+ or HHVM


Installation
------------

Phamda can be installed easily in any project using Composer:

.. code-block:: sh

    composer require phamda/phamda
