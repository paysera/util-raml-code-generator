## How to:
1. Copy `raml` specification to `raml/{api_name}` directory. 
`api_name` acts as root directory for given raml and should match the name of API you're going to generate.
2. Run `bin/console paysera:php-generator:rest-client {api_name} {namespace}`.
    * `api_name` is same name as in step 1.
    * `namespace` is the namespace of your PHP library. 
3. Check the dumped output to `generated/{api_name}` directory.

## Example:

Please take a look at example [RAML definition](./example-raml.md) and from this definition [generated code](./example-generated.md).

Now you need to provide authentication (or other) options to `ClientFactory`:

```php
use Paysera\Client\CategoryClient\ClientFactory;

$clientFactory = ClientFactory::create([
    'base_url' => 'custom base url',
    'basic' => [
        'username' => 'user',
        'password' => 'pass'
    ],
    'oauth' => [
        'token' => [
            'access_token' => 'your oauth access token',
            'refresh_token' => 'your oauth refresh token',
        ],
    ],
    // other configuration options
]);

$categoryClient = $clientFactory->getCategoryClient();

```

After these steps, you can use all methods in `CategoryClient`.

## Using generated code locally

To quickly test generate code one can use composer `repositories` feature:
1. Add following config to your `composer.json` file:
```json
{
    "repositories": [
        {
            "type": "path",
            "url": "/path/to/util-raml-code-generator/generated/package"
        }
    ],
    "require": {
      "my/package": "@dev"
    }
}
```
2. Run `composer update my/package`
Please read https://getcomposer.org/doc/05-repositories.md#path for additional configuration options.
