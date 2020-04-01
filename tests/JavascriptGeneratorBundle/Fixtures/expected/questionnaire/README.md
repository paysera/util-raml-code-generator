# @vendor/questionnaire-client

`@vendor/questionnaire-client` package provides means to interact with Vendor QuestionnaireClient REST API.
Package source code is written in ES6 syntax ant is transpiled to ES5 using babel.

## Installing
Using npm:
```bash
$ npm install @vendor/questionnaire-client
```

Using javascript files
```html
<script src="//domain.com/path/to/@paysera/http-client-common/dist/main.js"></script>
<script src="//domain.com/path/to/@vendor/questionnaire-client/dist/lib.js"></script>
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
import { createQuestionnaireClient } from '@vendor/questionnaire-client';

const client = createQuestionnaireClient({
    baseUrl: 'http://sandbox.domain.com/', // optional, custom base url
    middleware: [ // optional, list of middleware
        new JWTAuthenticationMiddleware(
            new Scope('scope:a'),
            new SessionStorageTokenProvider(
                (scope) => ({ scope, accessToken: 'created-token' }),
                (scope) => ({ scope, accessToken: 'refreshed-token' }),
                'questionnaire_client', // unique identifier of token
                'QuestionnaireClient', // storage namespace
            ),
        ),
    ]
});
```

## Demo
 - Run `npm install`
 - Run `npm run build`
 - Run `npm run serve` and take a look at `/dist/app.js` file
