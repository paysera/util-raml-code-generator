# Changelog
All notable changes to this project will be documented in this file.

The format is based on [Keep a Changelog](http://keepachangelog.com/en/1.0.0/)
and this project adheres to [Semantic Versioning](http://semver.org/spec/v2.0.0.html).

## 11.11.1
### Changed
- Migrated from Travis CI to GitHub Actions

## 11.11.0
### Added
- 202 responses can now return a body.

## 11.10.1
### Removed
- Removed PHP `7.2` and `7.3` from Travis includes
### Changed
- Changed Requirements section in README.md

## 11.10.0
### Changed
- Updated PHP version requirement from `^7.2` to `>=7.4`
- Updated `sebastian/diff` dependency from `^2.0` to `^4.0`
- Updated `phpunit/phpunit` dependency from `^6.5` to `^9.4`
- Removed `sensio/distribution-bundle` dependency
- Updated composer scripts

## 11.9.0
### Added
- MAC authentication support in client factory configuration
### Changed
- PHP version requirement in composer.json changed from ">=7.2" to "^7.2"
- Fixed authentication type comments in README templates (changed "it API" to "if API")
- Changed TypeScript interface declarations to class declarations in .d.ts files
- Added export keyword to interface declarations in .d.ts files
- Updated @paysera/http-client-common dependency to "^2.6.4"

## 11.8.0
### Changed
- exports for properties
- methods types export to type declaration
- library `paysera/lib-rest-client-common` version bump to 2.6.4

## 11.7.0
 - Added requirements to readme
 - Updated dependencies

## 11.6.0
### Added
- Added options for defining `library_version` and `platform_version` 
- Added library version and platform version to composer.json and package.json

## 11.5.0
### Changed
- `apiClient` property is changed from private to protected, to be able to extend factory class

## 11.4.5
### Fixed
- `Paysera.File` now gets properly generated.

## 11.4.4
### Changed
- Removed demo generation from js client.

## 11.4.3
### Changed
- Generate tree shakable js clients. JS skeleton based on github.com/paysera/js-lib-skeleton.

## 11.4.2
### Fixed
- `exec: raml-code-generator: not found` bug fixed for `release:clients` command

## 11.4.1
### Changed
- Fix generated php method return type when using annotation `(stream_response)`

## 11.4.0
### Changed
- Support content type `text/csv`
- Support stream response by using annotation type `(stream_response)` in raml method

## 11.3.1
### Fixed
- Wrong new release version for javascript clients

## 11.3.0
### Changed
- Generate clients with `"evp/money": "^1.0 || ^2.0"`.
- Support filters without any own fields, just inherited.

## 11.2.3
### Fixed
- The compiled `raml-code-generator.phar` command now does not report any errors.

## 11.2.2
### Changed
- Use another encrypted Travis CI token, as encryption is related to the repository.

## 11.2.1
N/A (empty version)

## 11.2.0
### Changed
- Requires at least PHP 7.2, updates used internal libraries.

## 11.1.1
### Fixed
- Use `rawurlencode()` instead of `urlencode()` for encoding URL arguments when generating PHP clients.
- Bring back the generation and upload of `raml-code-generator.phar` when creating a release. Now the process is
automated.

## 11.1.0
### Added
- `release:clients` ability to delete old source files that are not present in generated files 

## 11.0.1
### Fixed
- `php-generator:rest-client` now can correctly generate API methods, which uses plain `Money` as argument

## 11.0.0
### Removed
- Removed angular-js client wrapper and `angular` as a dependency.
### Added
- Experimental `index.d.ts` generation for JS clients.
### Fixed
- `release:clients` command now overwrites dependencies

## 10.7.2
### Changed
- Removed not necessary static method to get all available entity enum values.

## 10.7.1
### Added
- Properties in Javascript entities which hold enums, generates as static properties.

## 10.7.0
### Added
- Ability to provide method name with `(generator_method_name_override)` annotation

## 10.6.1
### Fixed
- In JS package generator replaced `phar` file with `bin/console`

## 10.6.0
### Added
- File entity for application/octet-stream content type (only for js client)
### Removed
- raml-code-generator phar

## 10.5.1
### Fixed
- URI Generation of urls with multiple params - /smt/{p1}/{p2}/{etc.}

## 10.5.0
### Added
- Support of `file` property type

## 10.4.6
### Fixed
- In JS package generator use `TypeConfigurationProvider` to properly create `Money` from response.

## 10.4.5
### Fixed
- In JS package generator property remove namespaces of imported libraries.
- Do not singularize words shorter or equal than 3 chars

## 10.4.4
### Fixed
- In `ReplaceFilesStep` switched `getSourceDir` to `getGeneratedDir`.
- Added missing `sprintf` argument.

## 10.4.3
### Fixed
- In `ReplaceFilesStep` provide custom Iterator to skip VCS files removal.

## 10.4.2
### Fixed
- Fixed `file not found` warning when creating new package.
- Added `package-lock.json` to ignored files when comparing changes.

## 10.4.1
### Fixed
- Removed `.` from `.babelrc.json.twig` as such naming caused `There are no registered paths for namespace "__main__".` errors in Phar env.

## 10.4.0
### Added
- Escaping reserved keywords, like `public` in `javascript` 

## 10.3.0
### Added
- Ability to return Paysera.Money as a response of an endpoint, not only to use it as property of another type.
- Added `release:clients` command - it automates RAML client generation, repository cloning and other manual stuff.
- Improved readme.

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

## 10.0.0
### Added
- support of raml date formats.
- support of `luxon` in `js` client for date handling.
### Removed
- In `js` removed `DateFactory.js` in favour of `luxon`.
### Changed
- In `js` client all date instances now are `DateTime` from `luxon`.

## 9.1.1
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
