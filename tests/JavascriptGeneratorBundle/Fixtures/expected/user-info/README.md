# @vendor/user-info-client

`@vendor/user-info-client` package provides means to interact with Vendor UserInfoClient REST API.
Package source code is written in ES6 syntax ant is transpiled to ES5 using babel.

## Installing
Using npm:
```bash
$ npm install @vendor/user-info-client
```

Using javascript files
```html
<script src="//domain.com/path/to/@paysera/http-client-common/dist/main.js"></script>
<script src="//domain.com/path/to/@vendor/user-info-client/dist/lib.js"></script>
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
import { createUserInfoClient } from '@vendor/user-info-client';

const client = createUserInfoClient({
    baseUrl: 'http://sandbox.domain.com/', // optional, custom base url
    middleware: [ // optional, list of middleware
        new JWTAuthenticationMiddleware(
            new Scope('scope:a'),
            new SessionStorageTokenProvider(
                (scope) => ({ scope, accessToken: 'created-token' }),
                (scope) => ({ scope, accessToken: 'refreshed-token' }),
                'user_info_client', // unique identifier of token
                'UserInfoClient', // storage namespace
            ),
        ),
    ]
});
```
