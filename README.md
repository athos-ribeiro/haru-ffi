# PHP libHaru FFI

[libHaru](http://libharu.org/) is a library for generating PDF files.

This is a PHP FFI Haru bindings implementation created to be compatible with
the now unmaintained [PHP Haru PECL extension](https://pecl.php.net/package/haru).

## How to use this library

For now, please, check the examples at `tests/UsageExamplesTest.php` or the
unmaintained PECL extension documentation. If you are missing any specific
features, do not hesitate to file an issue here so we can better prioritize.

## Current development state

As of version `0.1.0`, this initial, minimal version of haru-ffi is only enough
to generate the PDF version of the PHP documentation in
[phd](https://github.com/php/phd). This version was extracted from
https://github.com/php/phd/pull/69
