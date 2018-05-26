Releasing new version
=====================

1. make sure you have all parameters set-up in `publish_parameters.yml`.
1. push new code to repository.
1. create new tag and push it.
1. build new release: `composer run build` - command should create `raml-code-generator.phar` file.
1. publish new release: `composer run release` - command should create new release and upload previously generated file to repository.
