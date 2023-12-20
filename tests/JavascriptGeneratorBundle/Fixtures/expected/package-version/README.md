# @vendor/package-version-client

`@vendor/package-version-client` package provides means to interact with Vendor PackageVersionClient REST API.
Package source code is written in ES6 syntax ant is transpiled to ES5 using babel.

## Installing
Using npm:
```bash
$ npm install @vendor/package-version-client
```

Using javascript files
```html
<script src="//domain.com/path/to/@paysera/http-client-common/dist/main.js"></script>
<script src="//domain.com/path/to/@vendor/package-version-client/dist/lib.js"></script>
```

# Usage
```js
import {
    createClient,
    createRequest,
    JWTAuthenticationMiddleware,
    SessionStorageTokenProvider,
    Scope,
} from '@paysera/http-client-common';
import { createPackageVersionClient } from '@vendor/package-version-client';

const client = createPackageVersionClient({
    baseUrl: 'http://sandbox.domain.com/', // optional, custom base url
    middleware: [ // optional, list of middleware
        new JWTAuthenticationMiddleware(
            new Scope('scope:a'),
            new SessionStorageTokenProvider(
                (scope) => ({ scope, accessToken: 'created-token' }),
                (scope) => ({ scope, accessToken: 'refreshed-token' }),
                'package_version_client', // unique identifier of token
                'PackageVersionClient', // storage namespace
            ),
        ),
    ]
});
```
