<?php

namespace Paysera\Bundle\PhpGeneratorBundle\Twig;

use Paysera\Bundle\CodeGeneratorBundle\Entity\Definition\ApiDefinition;
use Paysera\Bundle\CodeGeneratorBundle\Entity\Definition\ArgumentDefinition;
use Paysera\Bundle\CodeGeneratorBundle\Entity\Definition\ResultTypeDefinition;
use Paysera\Bundle\CodeGeneratorBundle\Exception\InvalidDefinitionException;
use Paysera\Bundle\CodeGeneratorBundle\ResourcePatterns;
use Paysera\Bundle\CodeGeneratorBundle\Service\ArgumentsHelper;
use Paysera\Bundle\CodeGeneratorBundle\Service\BodyResolver;
use Paysera\Bundle\CodeGeneratorBundle\Service\MethodNameBuilder;
use Paysera\Bundle\CodeGeneratorBundle\Service\ResourceTypeDetector;
use Paysera\Bundle\PhpGeneratorBundle\Service\StringConverter;
use Paysera\Component\TypeHelper;
use Raml\Body;
use Raml\Method;
use Raml\Resource;
use Twig_Extension;
use Twig_SimpleFunction;

class ApiMethodExtension extends Twig_Extension
{
    private $stringConverter;
    private $methodNameBuilder;
    private $resourceTypeDetector;
    private $argumentsHelper;
    private $bodyResolver;

    public function __construct(
        StringConverter $stringConverter,
        MethodNameBuilder $methodNameBuilder,
        ResourceTypeDetector $resourceTypeDetector,
        ArgumentsHelper $argumentsHelper,
        BodyResolver $bodyResolver
    ) {
        $this->stringConverter = $stringConverter;
        $this->methodNameBuilder = $methodNameBuilder;
        $this->resourceTypeDetector = $resourceTypeDetector;
        $this->argumentsHelper = $argumentsHelper;
        $this->bodyResolver = $bodyResolver;
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
            new Twig_SimpleFunction('is_raw_response', [$this, 'isRawResponse']),
        ];
    }

    /**
     * @param Method $method
     * @param ApiDefinition $api
     * @return string
     */
    public function getReturnType(Method $method, ApiDefinition $api)
    {
        $body = $this->bodyResolver->getResponseBody($method);

        if ($body === null) {
            return 'null';
        }

        if ($body->getType() !== null) {
            if ($api->getType($body->getType()) !== null) {
                return sprintf('Entities\%s', $body->getType());
            }
            if (TypeHelper::isPrimitiveType($body->getType())) {
                return $body->getType();
            }
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

        return $this->argumentsHelper->filterOutBaseFilter($arguments);
    }

    public function generateUri(Resource $resource)
    {
        $replaced = preg_replace(ResourcePatterns::PATTERN_IDENTIFIER_RESOURCE, '%s', ltrim($resource->getUri(), '/'));
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
        /** @var ArgumentDefinition[] $arguments */
        $arguments = array_merge(
            $this->extractTraitArguments($method, $api),
            $this->extractBodyTypeArguments($method, $api)
        );

        return $this->argumentsHelper->resolveArgumentName($arguments);
    }

    public function generateResultPopulator(Method $method, ApiDefinition $api)
    {
        $body = $this->bodyResolver->getResponseBody($method);

        if ($body === null) {
            return 'null;';
        }

        if ($body->getType() !== null && $api->getType($body->getType()) !== null) {
            $type = $api->getType($body->getType());
            if ($type instanceof ResultTypeDefinition) {
                return sprintf('new Entities\%s($data, \'%s\');', $body->getType(), $type->getDataKey());
            }
            return sprintf('new Entities\%s($data);', $body->getType());
        }

        return 'null;';
    }

    public function isRawResponse(Method $method)
    {
        return $this->bodyResolver->isRawResponse($method);
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
        if (preg_match_all(ResourcePatterns::PATTERN_IDENTIFIER_RESOURCE, $uri, $matches) !== false) {
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
        $name = $this->methodNameBuilder->getNamePrefix($method->getType());
        $nameParts = $this->methodNameBuilder->getNameParts($resource->getUri());

        if ($this->resourceTypeDetector->isBinaryResource($resource, $method, $nameParts)) {
            return $this->methodNameBuilder->buildBinaryMethodName($resource->getUri());
        }

        if ($this->resourceTypeDetector->isSingularResource($resource, $method)) {
            return $this->methodNameBuilder->buildSingularMethodName($resource->getUri(), $name);
        }

        if ($this->resourceTypeDetector->isPluralResource($resource, $method)) {
            return $this->methodNameBuilder->buildPluralMethodName($resource->getUri(), $name);
        }

        throw new InvalidDefinitionException(sprintf(
            'Unable to resolve method name from uri "%s" and method "%s"',
            $resource->getUri(),
            $method->getType()
        ));
    }
}
