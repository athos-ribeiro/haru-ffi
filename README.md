# PHP libHaru FFI

[libHaru](http://libharu.org/) is a library for generating PDF files.

This is a PHP FFI Haru bindings implementation created to be compatible with
the now unmaintained [PHP Haru PECL extension](https://pecl.php.net/package/haru).

## How to use this library

For now, please, check the examples at `tests/UsageExamplesTest.php` or the
unmaintained PECL extension documentation. If you are missing any specific
features, do not hesitate to file an issue here so we can better prioritize.

### Requirements

This library is being developed with PHP >= 8.1. It is currently not tested
with lower PHP versions. Moreover, note that the FFI extension is quite recent
and this library may not work as intended in previous PHP versions.

You will need to have libharu installed in your sysyem to use this library.

In Debian, Ubuntu, or any derivatives, you can install it by running

```
sudo apt install libhpdf-2.3.0
```

In Fedora, RHEL or any derivatives, you can install it by running

```
sudo dnf install libhharu
```

### Development

As long as you have PHP >= 8, composer, and libharu installed in your system,
running `make check` should get you started by running our unit tests and any
additional checks.

Feel free to submit Pull Requests or file issues in our repository at
https://github.com/athos-ribeiro/haru-ffi.

## Current development state

As of version `0.x.y`, this initial, minimal version of haru-ffi is only enough
to

- generate the PDF version of the PHP documentation in
  [phd](https://github.com/php/phd). This version was extracted from [our phd
  pdf generation pull request](https://github.com/php/phd/pull/69); and
- run the examples described in `tests/UsageExamplesTest.php`.
