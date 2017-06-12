<?php

namespace Paysera\Util\RamlCodeGenerator\Twig;

use Doctrine\Common\Inflector\Inflector;
use Fig\Http\Message\RequestMethodInterface;
use Fig\Http\Message\StatusCodeInterface;
use Paysera\Util\RamlCodeGenerator\Entity\Definition\ApiDefinition;
use Paysera\Util\RamlCodeGenerator\Entity\Definition\ArgumentDefinition;
use Paysera\Util\RamlCodeGenerator\Entity\Definition\ResultTypeDefinition;
use Paysera\Util\RamlCodeGenerator\Exception\InvalidDefinitionException;
use Paysera\Util\RamlCodeGenerator\Service\StringConverter;
use Raml\Body;
use Raml\Method;
use Raml\Resource;
use Twig_Extension;
use Twig_SimpleFunction;

class ApiMethodExtension extends Twig_Extension
{
    // /categories/{id}/elements
    const RESOURCE_NAME_REGEX = '#^\/(?P<base_name>\w+)(?:.+\/(?P<sub_name>[\w|-]*)$)*#';

    // /categories/{id}
    const SINGULAR_RESOURCE = '#{(\w+)}$#';

    // /categories/{id}/*
    const IDENTIFIER_RESOURCE = '#{(\w+)}#';

    const DEFAULT_VARIABLE_TYPE = 'string';

    private $stringConverter;

    public function __construct(StringConverter $stringConverter)
    {
        $this->stringConverter = $stringConverter;
    }

    public function getFunctions()
    {
        return [
            new Twig_SimpleFunction('generate_method_name', [$this, 'generateMethodName']),
            new Twig_SimpleFunction('generate_method_arguments', [$this, 'generateMethodArguments']),
            new Twig_SimpleFunction('generate_uri', [$this, 'generateUri'], ['is_safe' => ['html']]),
            new Twig_SimpleFunction('generate_body', [$this, 'generateBody']),
            new Twig_SimpleFunction('generate_result_populator', [$this, 'generateResultPopulator'], ['is_safe' => ['html']]),
            new Twig_SimpleFunction('inline_arguments', [$this, 'inlineArguments']),
            new Twig_SimpleFunction('inline_argument_names', [$this, 'inlineArgumentNames']),
            new Twig_SimpleFunction('get_return_type', [$this, 'getReturnType']),
        ];
    }

    /**
     * @param Method $method
     * @param ApiDefinition $api
     * @return string
     */
    public function getReturnType(Method $method, ApiDefinition $api)
    {
        $okResponse = $method->getResponse(StatusCodeInterface::STATUS_OK);
        if ($okResponse === null) {
            return 'null';
        }

        /** @var Body $body */
        $body = $okResponse->getBodyByType('application/json');

        if ($body->getType() !== null && $api->getType($body->getType()) !== null) {
            return sprintf('Entities\%s', $body->getType());
        }

        return 'null';
    }


    /**
     * @param ArgumentDefinition[] $arguments
     * @return string
     */
    public function inlineArguments(array $arguments)
    {
        $parts = [];
        foreach ($arguments as $argument) {
            if ($argument->getType() === ArgumentDefinition::TYPE_DEFAULT) {
                $parts[] = $argument->getName();
            } else {
                $parts[] = sprintf('%s %s', $argument->getNamespacedType(), $argument->getName());
            }
        }

        return trim(implode(', ', $parts));
    }

    /**
     * @param ArgumentDefinition[] $arguments
     * @return string
     */
    public function inlineArgumentNames(array $arguments)
    {
        $names = [];
        foreach ($arguments as $argument) {
            $names[] = $argument->getName();
        }

        return implode(', ', $names);
    }

    /**
     * @param Method $method
     * @param Resource $resource
     * @param ApiDefinition $api
     * @return ArgumentDefinition[]
     */
    public function generateMethodArguments(Method $method, Resource $resource, ApiDefinition $api)
    {
        $arguments = array_merge(
            $this->extractUriArguments($resource->getUri()),
            $this->extractTraitArguments($method, $api),
            $this->extractBodyTypeArguments($method, $api)
        );

        return $arguments;
    }


    public function generateUri(Resource $resource)
    {
        $replaced = preg_replace(self::IDENTIFIER_RESOURCE, '%s', ltrim($resource->getUri(), '/'));
        $arguments = $this->extractUriArguments($resource->getUri());

        foreach ($arguments as $key => $argument) {
            $arguments[$key] = sprintf('urlencode(%s)', $argument->getName());
        }

        if (empty($arguments)) {
            return sprintf("'%s'", $replaced);
        }

        return sprintf("sprintf('%s', %s)", $replaced, implode(", ", $arguments));
    }

    public function generateBody(Method $method, ApiDefinition $api)
    {
        $arguments = array_merge(
            $this->extractTraitArguments($method, $api),
            $this->extractBodyTypeArguments($method, $api)
        );

        if (count($arguments) > 1) {
            throw new InvalidDefinitionException(sprintf(
                'More than one body argument found: "%s"',
                implode(', ', $arguments)
            ));
        }

        if (!empty($arguments)) {
            return reset($arguments)->getName();
        }

        return 'null';
    }

    public function generateResultPopulator(Method $method, ApiDefinition $api)
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
                return sprintf('new Entities\%s($data, \'%s\');', $body->getType(), $type->getDataKey());
            }
            return sprintf('new Entities\%s($data);', $body->getType());
        }

        return 'null;';
    }

    private function extractBodyTypeArguments(Method $method, ApiDefinition $api)
    {
        $arguments = [];

        /** @var Body $body */
        foreach ($method->getBodies() as $body) {
            if ($body->getType() !== null && $api->getType($body->getType()) !== null) {
                $arguments[] = (
                new ArgumentDefinition(sprintf('$%s', lcfirst($body->getType())))
                )->setType($body->getType());
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
                    new ArgumentDefinition(sprintf('$%s', lcfirst($trait)))
                )->setType($trait);
            }
        }

        return $arguments;
    }

    /**
     * @param string $uri
     * @return ArgumentDefinition[]
     */
    private function extractUriArguments($uri)
    {
        $arguments = [];
        if (preg_match_all(self::IDENTIFIER_RESOURCE, $uri, $matches) === 1) {
            foreach ($matches[1] as $match) {
                $arguments[] = new ArgumentDefinition(sprintf(
                    '$%s',
                    $this->stringConverter->convertSlugToVariableName($match)
                ));
            }
        }

        return $arguments;
    }

    /**
     * @param Method $method
     * @param Resource $resource
     *
     * @return string
     * @throws InvalidDefinitionException
     */
    public function generateMethodName(Method $method, Resource $resource)
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
            } else {
                return $nameParts['sub_name'] . ucfirst(Inflector::singularize($nameParts['base_name']));
            }
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

    /**
     * @param string $method
     *
     * @return string
     * @throws InvalidDefinitionException
     */
    private function getNamePrefix($method)
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
     * @return bool
     */
    private function isIdentifierResource($uri)
    {
        return preg_match(self::IDENTIFIER_RESOURCE, $uri) === 1;
    }

    /**
     * @param string $uri
     * @param string $method
     *
     * @return bool
     */
    private function isBinaryResource($uri, $method)
    {
        return $method === RequestMethodInterface::METHOD_PUT && $this->isPluralResource($uri);
    }

    /**
     * @param string $uri
     * @return bool
     */
    private function isSingularResource($uri)
    {
        return preg_match(self::SINGULAR_RESOURCE, $uri) === 1;
    }

    /**
     * @param string $uri
     * @return bool
     */
    private function isPluralResource($uri)
    {
        return !$this->isSingularResource($uri);
    }

    /**
     * @param string $uri
     * @return array|null
     *
     * @throws InvalidDefinitionException
     */
    private function getNameParts($uri)
    {
        if (preg_match(self::RESOURCE_NAME_REGEX, $uri, $matches) === 1) {
            if (!isset($matches['base_name'])) {
                throw new InvalidDefinitionException(sprintf('Unable to resolve name parts for uri "%s"', $uri));
            }
            return $matches;
        }

        return null;
    }
}
