# Javascript package generation

1. Copy `raml` specification to `raml/{api_name}` directory. 
`api_name` acts as root directory for given RAML is part of package name you're going to generate.
2. Run `bin/console paysera:js-generator:package {api_name} {client_name}`.
    * `api_name` is directory name from step 1.
    * `client_name` is the part of your main javascript client name
3. Check the dumped output to `generated/{api_name}` directory.
4. See additional command options with `bin/console paysera:js-generator:package --help`

## Examples

Please see `/tests` content for RAML definition and generated code examples.
Generated packages also have `/demo` directory with library usage example.

## Using generated code locally

 - If your app is using `npm`:
    1. Add dependency to `package.json`
    ```json
    "dependencies": {
        "generated-lib-name": "file:/path/to/generate/lib"
    }
    ```
    2. Run `npm install`
    
 - If package was generated using `--build-dependencies` option, just include javascript files from generated package `demo/index.html` file
    - If your app is using Angular JS, add all files, except `demo/app.js`:
    ```html
    <script type="text/javascript" src="../node_modules/angular/angular.js"></script>
    <script type="text/javascript" src="../node_modules/paysera-http-client-common/dist/babel.polyfill.js"></script>
    <script type="text/javascript" src="../node_modules/paysera-http-client-common/dist/lib.js"></script>
    <script type="text/javascript" src="../dist/ng.module.js"></script>
    ```
    - If your app needs just basic code in ES5 code level:
    ```html
    <script type="text/javascript" src="../node_modules/paysera-http-client-common/dist/babel.polyfill.js"></script>
    <script type="text/javascript" src="../node_modules/paysera-http-client-common/dist/lib.js"></script>
    <script type="text/javascript" src="../dist/lib.js"></script>
    ```
