<?php
declare(strict_types=1);

namespace Paysera\Bundle\JavascriptGeneratorBundle\Twig;

use Doctrine\Common\Inflector\Inflector;
use Fig\Http\Message\RequestMethodInterface;
use Fig\Http\Message\StatusCodeInterface;
use Paysera\Bundle\CodeGeneratorBundle\Entity\Definition\ApiDefinition;
use Paysera\Bundle\CodeGeneratorBundle\Entity\Definition\ArgumentDefinition;
use Paysera\Bundle\CodeGeneratorBundle\Entity\Definition\ResultTypeDefinition;
use Paysera\Bundle\CodeGeneratorBundle\Exception\InvalidDefinitionException;
use Paysera\Bundle\CodeGeneratorBundle\ResourcePatterns;
use Paysera\Bundle\JavascriptGeneratorBundle\Service\NameResolver;
use Paysera\Bundle\PhpGeneratorBundle\Service\StringConverter;
use Raml\Body;
use Raml\Method;
use Raml\Resource;
use Twig_Extension;
use Twig_SimpleFunction;

class ApiMethodExtension extends Twig_Extension
{
    private $stringConverter;
    private $nameResolver;

    public function __construct(
        StringConverter $stringConverter,
        NameResolver $nameResolver
    ) {
        $this->stringConverter = $stringConverter;
        $this->nameResolver = $nameResolver;
    }

    public function getFunctions()
    {
        return [
            new Twig_SimpleFunction('js_get_client_name', [$this->nameResolver, 'getClientName']),
            new Twig_SimpleFunction('js_get_package_name', [$this->nameResolver, 'getPackageName']),
            new Twig_SimpleFunction('js_get_angular_module_name', [$this->nameResolver, 'getAngularJsModuleName']),
            new Twig_SimpleFunction('js_get_angular_client_factory_name', [$this->nameResolver, 'getAngularJsFactoryClassName']),
            new Twig_SimpleFunction('js_generate_method_name', [$this, 'generateMethodName']),
            new Twig_SimpleFunction('js_generate_method_arguments', [$this, 'generateMethodArguments']),
            new Twig_SimpleFunction('js_generate_body', [$this, 'generateBody']),
            new Twig_SimpleFunction('js_generate_uri', [$this, 'generateUri'], ['is_safe' => ['html']]),
            new Twig_SimpleFunction('js_inline_arguments', [$this, 'getInlineArguments']),
            new Twig_SimpleFunction('js_generate_result_populator', [$this, 'generateResultPopulator'], ['is_safe' => ['html']]),
            new Twig_SimpleFunction('js_get_return_type', [$this, 'getReturnType']),
        ];
    }

    /**
     * @param ArgumentDefinition[] $arguments
     * @return string
     */
    public function getInlineArguments(array $arguments) : string
    {
        $parts = [];
        foreach ($arguments as $argument) {
            $parts[] = $argument->getName();
        }

        return trim(implode(', ', $parts));
    }

    /**
     * @param Method $method
     * @param Resource $resource
     * @param ApiDefinition $api
     * @return ArgumentDefinition[]
     */
    public function generateMethodArguments(Method $method, Resource $resource, ApiDefinition $api) : array
    {
        $arguments = array_merge(
            $this->extractUriArguments($resource->getUri()),
            $this->extractTraitArguments($method, $api),
            $this->extractBodyTypeArguments($method, $api)
        );

        return $arguments;
    }

    public function generateUri(Resource $resource) : string
    {
        $replaced = preg_replace(ResourcePatterns::PATTERN_IDENTIFIER_RESOURCE, '%s', ltrim($resource->getUri(), '/'));
        $arguments = $this->extractUriArguments($resource->getUri());

        foreach ($arguments as $key => $argument) {
            $arguments[$key] = sprintf('\' + encodeURIComponent(%s) + \'', $argument->getName());
        }

        if (empty($arguments)) {
            return $replaced;
        }

        return vsprintf($replaced, $arguments);
    }

    public function generateBody(Method $method, ApiDefinition $api) : string
    {
        /** @var ArgumentDefinition[] $arguments */
        $arguments = array_merge(
            $this->extractTraitArguments($method, $api),
            $this->extractBodyTypeArguments($method, $api)
        );

        if (count($arguments) > 1) {
            $argumentNames = [];
            foreach ($arguments as $argument) {
                $argumentNames[] = $argument->getName();
            }
            throw new InvalidDefinitionException(sprintf(
                'More than one body argument found: "%s"',
                implode(', ', $argumentNames)
            ));
        }

        if (!empty($arguments)) {
            return reset($arguments)->getName();
        }

        return 'null';
    }

    public function generateResultPopulator(Method $method, ApiDefinition $api) : string
    {
        $okResponse = $method->getResponse(StatusCodeInterface::STATUS_OK);

        if ($okResponse === null) {
            return 'null;';
        }

        /** @var Body $body */
        $body = $okResponse->getBodyByType('application/json');

        if ($body->getType() !== null && $api->getType($body->getType()) !== null) {
            $type = $api->getType($body->getType());
            if ($type instanceof ResultTypeDefinition) {
                return sprintf('new %s(data, \'%s\');', $body->getType(), $type->getDataKey());
            }
            return sprintf('new %s(data);', $body->getType());
        }

        return 'null;';
    }

    public function getReturnType(Method $method, ApiDefinition $api) : string
    {
        $okResponse = $method->getResponse(StatusCodeInterface::STATUS_OK);
        if ($okResponse === null) {
            return 'null';
        }

        /** @var Body $body */
        $body = $okResponse->getBodyByType('application/json');

        if ($body->getType() !== null && $api->getType($body->getType()) !== null) {
            return $body->getType();
        }

        return 'null';
    }

    /**
     * @param Method $method
     * @param Resource $resource
     *
     * @return string
     * @throws InvalidDefinitionException
     */
    public function generateMethodName(Method $method, Resource $resource) : string
    {
        $nameParts = $this->getNameParts($resource->getUri());
        $name = $this->getNamePrefix($method->getType());

        if (
            $this->isBinaryResource($resource->getUri(), $method->getType())
            && $this->isIdentifierResource($resource->getUri())
        ) {
            if (strpos($nameParts['sub_name'], '-') !== false) {
                $subParts = explode('-', $nameParts['sub_name']);
                $firstPart = $subParts[0];
                unset($subParts[0]);
                return $firstPart
                    . ucfirst(Inflector::singularize($nameParts['base_name']))
                    . Inflector::classify(implode(' ', $subParts))
                ;
            }

            return $nameParts['sub_name'] . ucfirst(Inflector::singularize($nameParts['base_name']));
        }

        if (
            $this->isSingularResource($resource->getUri())
            || (
                $this->isPluralResource($resource->getUri())
                && $method->getType() !== RequestMethodInterface::METHOD_GET
            )
        ) {
            $name .= ucfirst(Inflector::singularize($nameParts['base_name']));
            if (isset($nameParts['sub_name'])) {
                $name .= ucfirst(Inflector::singularize($nameParts['sub_name']));
            }
            return $name;
        }

        if (
            $this->isPluralResource($resource->getUri())
            && $method->getType() === RequestMethodInterface::METHOD_GET
        ) {
            if (!isset($nameParts['sub_name'])) {
                return $name . ucfirst(Inflector::pluralize($nameParts['base_name']));
            }
            $name .= ucfirst(Inflector::singularize($nameParts['base_name']));
            if (isset($nameParts['sub_name'])) {
                $name .= ucfirst(Inflector::pluralize($nameParts['sub_name']));
            }
            return $name;
        }

        throw new InvalidDefinitionException(sprintf(
            'Unable to resolve method name from uri "%s" and method "%s"',
            $resource->getUri(),
            $method->getType()
        ));
    }

    private function extractBodyTypeArguments(Method $method, ApiDefinition $api) : array
    {
        $arguments = [];

        /** @var Body $body */
        foreach ($method->getBodies() as $body) {
            if ($body->getType() !== null && $api->getType($body->getType()) !== null) {
                $arguments[] = (new ArgumentDefinition(sprintf('%s', lcfirst($body->getType()))))
                    ->setType($body->getType());
            }
        }

        return $arguments;
    }

    /**
     * @param Method $method
     * @param ApiDefinition $api
     *
     * @return ArgumentDefinition[]
     */
    private function extractTraitArguments(Method $method, ApiDefinition $api)
    {
        $arguments = [];
        foreach ($method->getTraits() as $trait) {
            if ($api->getType($trait) !== null) {
                $arguments[] = (
                new ArgumentDefinition(sprintf('%s', lcfirst($trait))))->setType($trait);
            }
        }

        return $arguments;
    }

    /**
     * @param string $uri
     * @return ArgumentDefinition[]
     */
    private function extractUriArguments(string $uri)
    {
        $arguments = [];
        if (preg_match_all(ResourcePatterns::PATTERN_IDENTIFIER_RESOURCE, $uri, $matches) === 1) {
            foreach ($matches[1] as $match) {
                $arguments[] = new ArgumentDefinition(sprintf(
                    '%s',
                    $this->stringConverter->convertSlugToVariableName($match)
                ));
            }
        }

        return $arguments;
    }

    private function isIdentifierResource(string $uri) : bool
    {
        return preg_match(ResourcePatterns::PATTERN_IDENTIFIER_RESOURCE, $uri) === 1;
    }

    private function isBinaryResource(string $uri, string $method) : bool
    {
        return $method === RequestMethodInterface::METHOD_PUT && $this->isPluralResource($uri);
    }

    private function isSingularResource(string $uri) : bool
    {
        return preg_match(ResourcePatterns::PATTERN_SINGULAR_RESOURCE, $uri) === 1;
    }

    private function isPluralResource(string $uri) : bool
    {
        return !$this->isSingularResource($uri);
    }

    /**
     * @param string $method
     *
     * @return string
     * @throws InvalidDefinitionException
     */
    private function getNamePrefix(string $method) : string
    {
        switch ($method) {
            case RequestMethodInterface::METHOD_GET:
                return 'get';
            case RequestMethodInterface::METHOD_DELETE:
                return 'delete';
            case RequestMethodInterface::METHOD_PATCH:
            case RequestMethodInterface::METHOD_PUT:
                return 'update';
            case RequestMethodInterface::METHOD_POST:
                return 'create';
            default:
                throw new InvalidDefinitionException(sprintf('Unable to resolve method prefix for type "%s"', $method));
        }
    }

    /**
     * @param string $uri
     * @return array|null
     *
     * @throws InvalidDefinitionException
     */
    private function getNameParts(string $uri)
    {
        if (preg_match(ResourcePatterns::PATTERN_RESOURCE_NAME, $uri, $matches) === 1) {
            if (!isset($matches['base_name'])) {
                throw new InvalidDefinitionException(sprintf('Unable to resolve name parts for uri "%s"', $uri));
            }
            return $matches;
        }

        return null;
    }
}
