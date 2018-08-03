# Changelog
All notable changes to this project will be documented in this file.

The format is based on [Keep a Changelog](http://keepachangelog.com/en/1.0.0/)
and this project adheres to [Semantic Versioning](http://semver.org/spec/v2.0.0.html).

## 10.3.0
### Added
- Ability to return Paysera.Money as a response of an endpoint, not only to use it as property of another type.

## 10.2.0
### Added
- Support or `url_parameters`: https://github.com/raml-org/raml-spec/blob/master/versions/raml-10/raml-10.md#base-uri-and-base-uri-parameters
Defaults will be used from RAML spec, if missing - exception will be thrown. You should pass required url parameters ar `options`

## 10.1.1
### Fixed
- Restored backwards-compatibility with `paysera/lib-rest-client-common 1.0` in `ClientFactory__construct()`.

## 10.1.0
### Added
- JS and PHP clients now support scalar items type in Results. 

## 10.0.1
### Added
- `php-generator:symfony-bundle` added to `phar`

#10.0.0
### Added
- support of raml date formats.
- support of `luxon` in `js` client for date handling.
### Removed
- In `js` removed `DateFactory.js` in favour of `luxon`.
### Changed
- In `js` client all date instances now are `DateTime` from `luxon`.

# 9.1.1
### Added
- `php client` generated clients now supports `paysera/lib-rest-client-common 2.0`. Clients will have `withOptions` method.
Be aware that you need `paysera/lib-rest-client-common 2.0` to use this method.

## 9.0.0
### Added
- `php-generator:symfony-bundle` command now generates Symfony Bundle with most of API-specific classes configured.
### Changed
- paths like `/resources/{id}/{verb-ish-word}` are treated as verbs if word can have verb meaning in WordNet db.

## 8.0.0
### Added
- Generated Javascript clients for `Money` type are using the `@paysera/money` library now. 

## 7.0.2
### Fixed
- `Money` properties now are stored as arrays of `amount` and `currency`, not as two separate properties for `amount` and `currency`.

## 7.0.1
### Fixed
- `SQLSTATE[HY000] [14] unable to open database file` is not fixed - `sqlite://phar://raml-code-generator.phar/app/Resources/word_net_sqlite-31.db`
seems to be invalid path to Sqlite database, so it is copied to temp dir.

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
