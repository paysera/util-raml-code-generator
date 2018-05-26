# Changelog
All notable changes to this project will be documented in this file.

The format is based on [Keep a Changelog](http://keepachangelog.com/en/1.0.0/)
and this project adheres to [Semantic Versioning](http://semver.org/spec/v2.0.0.html).

## 7.0.0
### Fixed
- Properly generates return types and return values of arrays. Previously instead of array, `null` was returned. 
### Changed
- Changes made to how singular/plural method names are resolved. Now if response is iterable and request method is `GET` - it should be in plural.
- `PHP code generator` and `JS code generator` now expects 3 arguments:
  * 1 - path to `raml` file
  * 2 - path to directory where to put generated code
  * 3 - Client name in case of `JS code generator` and Client namespace in case of `PHP code generator`
- `API name` now is resolved from `namespace` in case of `PHP code generator` and from `client_name` in case of `JS code generator`.

## 6.0.0
### Fixed
- Non-required properties now properly returns `null`. Previously instance of return type was created with no data.
### Added
- Support of `Libraries` - https://github.com/raml-org/raml-spec/blob/master/versions/raml-10/raml-10.md/#libraries
- Support of 3-rd party types. Now it is possible to configure specific type pattern, for which `Entity` will not be generated,
but instead imported from configured library.

## 5.0.0
### Changed
- Inheritance in `Entities` and `Filters`.
    * Generated `Entities` will extend class described in it's RAML `type` facet.
    * Generated `Filters` will extend **first class** in it's RAML `is` facet. 
    If no `is` facets provided, generated `Filter` will extend base `Entity`.

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
