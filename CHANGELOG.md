# Changelog

All notable changes to this project will be documented in this file.

The format is based on [Keep a Changelog](https://keepachangelog.com/en/1.1.0/),
and this project adheres to [Semantic Versioning](https://semver.org/spec/v2.0.0.html).

## [Unreleased]

### Added

- Allow system-wide library search when loading libhpdf.

### Fixed

- Fix some bogus return values.
- Raise some missing exceptions upon underlying library errors.

## [0.2.1] - 2023-04-19

### Added

- Require ext-ffi.
- Add HaruFFI abstraction so we only call FFI load once.

## [0.2.0] - 2023-04-15

### Added

- Increase our libharu feature coverage to enable the generation of the PDFs
  created by the tests and examples available in the former PECL haru
  extension. These are available at `tests/UsageExamplesTest.php`

## [0.1.0] - 2023-04-08

### Added

- Initial release with minimal feature set to generate PDFs for the upstream
  PHP documentation.
