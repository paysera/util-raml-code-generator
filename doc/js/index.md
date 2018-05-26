# Javascript package generation

1. Run `bin/console js-generator:package {path_to_raml} {output_dir} {client_name}`.
    * `path_to_raml` path to `raml` file.
    * `output_dir` directory where to put generated files.
    * `client_name` is the name of your main javascript client. 
1. Check the dumped output to `{output_dir}` directory.
1. See additional command options with `bin/console js-generator:package --help`

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
