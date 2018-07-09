# @vendor/inheritance-client

`@vendor/inheritance-client` package provides means to interact with Vendor InheritanceClient REST API.
Package source code is written in ES6 syntax ant is transpiled to ES5 using babel.
Additional Angular JS module `vendor.http.inheritance-client` with `vendorHttpInheritanceClientFactory` service is also provided.

## Installing
Using npm:
```bash
$ npm install @vendor/inheritance-client
```

Using javascript files
```html
<script src="//domain.com/path/to/@paysera/http-client-common/dist/main.js"></script>
<script src="//domain.com/path/to/@vendor/inheritance-client/dist/lib.js"></script>
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
import { createInheritanceClient } from '@vendor/inheritance-client';

const client = createInheritanceClient({
    baseUrl: 'http://sandbox.domain.com/', // optional, custom base url
    middleware: [ // optional, list of middleware
        new JWTAuthenticationMiddleware(
            new Scope('scope:a'),
            new SessionStorageTokenProvider(
                (scope) => ({ scope, accessToken: 'created-token' }),
                (scope) => ({ scope, accessToken: 'refreshed-token' }),
                'inheritance_client', // unique identifier of token
                'InheritanceClient', // storage namespace
            ),
        ),
    ]
});
```

## Demo
 - Run `npm install`
 - Run `npm run build`
 - Run `npm run serve` and take a look at `/dist/app.js` file
