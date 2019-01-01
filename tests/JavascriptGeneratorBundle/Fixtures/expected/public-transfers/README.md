# @vendor/public-transfers-client

`@vendor/public-transfers-client` package provides means to interact with Vendor PublicTransfersClient REST API.
Package source code is written in ES6 syntax ant is transpiled to ES5 using babel.
Additional Angular JS module `vendor.http.public-transfers-client` with `vendorHttpPublicTransfersClientFactory` service is also provided.

## Installing
Using npm:
```bash
$ npm install @vendor/public-transfers-client
```

Using javascript files
```html
<script src="//domain.com/path/to/@paysera/http-client-common/dist/main.js"></script>
<script src="//domain.com/path/to/@vendor/public-transfers-client/dist/lib.js"></script>
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
import { createPublicTransfersClient } from '@vendor/public-transfers-client';

const client = createPublicTransfersClient({
    baseUrl: 'http://sandbox.domain.com/', // optional, custom base url
    middleware: [ // optional, list of middleware
        new JWTAuthenticationMiddleware(
            new Scope('scope:a'),
            new SessionStorageTokenProvider(
                (scope) => ({ scope, accessToken: 'created-token' }),
                (scope) => ({ scope, accessToken: 'refreshed-token' }),
                'public_transfers_client', // unique identifier of token
                'PublicTransfersClient', // storage namespace
            ),
        ),
    ]
});
```

## Demo
 - Run `npm install`
 - Run `npm run build`
 - Run `npm run serve` and take a look at `/dist/app.js` file
