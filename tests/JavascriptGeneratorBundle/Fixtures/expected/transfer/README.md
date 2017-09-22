# vendor-transfer-client

`vendor-transfer-client` package provides means to interact with Vendor Transfer REST API.
Package source code is written in ES6 syntax ant is transpiled to ES5 using babel.
Additional Angular JS module `vendor.http.transfer` with `vendorHttpTransferClientFactory` service is also provided.

## Installing
Using npm:
```bash
$ npm install vendor-transfer-client
```

Using javascript files
```html
<script src="//domain.com/path/to/paysera-http-client-common/dist/lib.js"></script>
<script src="//domain.com/path/to/vendor-transfer-client/dist/lib.js"></script>
```

# Usage
```js
import { ClientFactory } from 'vendor-transfer-client';

let factory = ClientFactory.create({
    baseUrl: 'http://sandbox.domain.com/', // optional, custom base url
    refreshTokenProvider: function (Scope) {} // optional, needed only if API requires authentication
});

let client = factory.getTransferClient(); // accepts optional TokenProvider argument, needed only if API requires authentication
```

## Demo
 - Run `npm install`
 - Run `npm run build`
 - Run `npm run serve` and take a look at `/dist/app.js` file
