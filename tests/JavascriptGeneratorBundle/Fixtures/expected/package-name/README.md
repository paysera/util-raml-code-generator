# @vendor-name/overwritten-package-name

`@vendor-name/overwritten-package-name` package provides means to interact with Vendor PackageNameClient REST API.
Package source code is written in ES6 syntax ant is transpiled to ES5 using babel.

## Installing
Using npm:
```bash
$ npm install @vendor-name/overwritten-package-name
```

Using javascript files
```html
<script src="//domain.com/path/to/@paysera/http-client-common/dist/main.js"></script>
<script src="//domain.com/path/to/@vendor-name/overwritten-package-name/dist/lib.js"></script>
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
import { createPackageNameClient } from '@vendor-name/overwritten-package-name';

const client = createPackageNameClient({
    baseUrl: 'http://sandbox.domain.com/', // optional, custom base url
    middleware: [ // optional, list of middleware
        new JWTAuthenticationMiddleware(
            new Scope('scope:a'),
            new SessionStorageTokenProvider(
                (scope) => ({ scope, accessToken: 'created-token' }),
                (scope) => ({ scope, accessToken: 'refreshed-token' }),
                'package_name_client', // unique identifier of token
                'PackageNameClient', // storage namespace
            ),
        ),
    ]
});
```
