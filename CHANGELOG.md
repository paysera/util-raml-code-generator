# Changelog
All notable changes to this project will be documented in this file.

The format is based on [Keep a Changelog](http://keepachangelog.com/en/1.0.0/)
and this project adheres to [Semantic Versioning](http://semver.org/spec/v2.0.0.html).

## 4.1.0

### Added
- Support of Discriminated types - https://github.com/raml-org/raml-spec/blob/master/versions/raml-10/raml-10.md#using-discriminator


## 4.0.0

### Changed
- Both PHP and JS generators no longer generates base filters (matches `Filter` name) if there are both base filters and normal filters defined or more.

## 3.1.0

### Added
- Added support of `application/javascript` content-type. Returns string.
- Added support for non-filter Traits.

### Fixed
- Generated javascript Entities now properly includes used Entities.
