<?php
declare(strict_types=1);

namespace Paysera\Bundle\JavascriptGeneratorBundle\Twig;

use Paysera\Bundle\CodeGeneratorBundle\Entity\Definition\ApiDefinition;
use Paysera\Bundle\CodeGeneratorBundle\Entity\Definition\ArgumentDefinition;
use Paysera\Bundle\CodeGeneratorBundle\Entity\Definition\ArrayPropertyDefinition;
use Paysera\Bundle\CodeGeneratorBundle\Entity\Definition\PropertyDefinition;
use Paysera\Bundle\CodeGeneratorBundle\Entity\Definition\ResultTypeDefinition;
use Paysera\Bundle\CodeGeneratorBundle\Entity\Definition\TypeDefinition;
use Paysera\Bundle\CodeGeneratorBundle\Exception\InvalidDefinitionException;
use Paysera\Bundle\CodeGeneratorBundle\ResourcePatterns;
use Paysera\Bundle\CodeGeneratorBundle\Service\ArgumentsHelper;
use Paysera\Bundle\CodeGeneratorBundle\Service\BodyResolver;
use Paysera\Bundle\CodeGeneratorBundle\Service\MethodNameBuilder;
use Paysera\Bundle\CodeGeneratorBundle\Service\ResourceTypeDetector;
use Paysera\Bundle\JavascriptGeneratorBundle\Service\NameResolver;
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
    private $nameResolver;
    private $methodNameBuilder;
    private $resourceTypeDetector;
    private $argumentsHelper;
    private $bodyResolver;

    public function __construct(
        StringConverter $stringConverter,
        NameResolver $nameResolver,
        MethodNameBuilder $methodNameBuilder,
        ResourceTypeDetector $resourceTypeDetector,
        ArgumentsHelper $argumentsHelper,
        BodyResolver $bodyResolver
    ) {
        $this->stringConverter = $stringConverter;
        $this->nameResolver = $nameResolver;
        $this->methodNameBuilder = $methodNameBuilder;
        $this->resourceTypeDetector = $resourceTypeDetector;
        $this->argumentsHelper = $argumentsHelper;
        $this->bodyResolver = $bodyResolver;
    }

    public function getFunctions()
    {
        return [
            new Twig_SimpleFunction('js_get_client_name', [$this->nameResolver, 'getClientName']),
            new Twig_SimpleFunction('js_get_package_name', [$this->nameResolver, 'getPackageName']),
            new Twig_SimpleFunction('js_get_angular_module_name', [$this->nameResolver, 'getAngularJsModuleName'], ['is_safe' => ['js']]),
            new Twig_SimpleFunction('js_get_angular_client_factory_name', [$this->nameResolver, 'getAngularJsFactoryClassName']),
            new Twig_SimpleFunction('js_generate_method_name', [$this, 'generateMethodName']),
            new Twig_SimpleFunction('js_generate_method_arguments', [$this, 'generateMethodArguments']),
            new Twig_SimpleFunction('js_generate_body', [$this, 'generateBody']),
            new Twig_SimpleFunction('js_generate_uri', [$this, 'generateUri'], ['is_safe' => ['html']]),
            new Twig_SimpleFunction('js_inline_arguments', [$this, 'getInlineArguments']),
            new Twig_SimpleFunction('js_generate_result_populator', [$this, 'generateResultPopulator'], ['is_safe' => ['html']]),
            new Twig_SimpleFunction('js_get_return_type', [$this, 'getReturnType']),
            new Twig_SimpleFunction('js_get_related_types', [$this, 'getRelatedTypes']),
            new Twig_SimpleFunction('js_is_raw_response', [$this, 'isRawResponse']),
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

        return $this->argumentsHelper->filterOutBaseFilter($arguments);
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

        return $this->argumentsHelper->resolveArgumentName($arguments);
    }

    public function generateResultPopulator(Method $method, ApiDefinition $api) : string
    {
        $body = $this->bodyResolver->getResponseBody($method);

        if ($body === null) {
            return 'null;';
        }

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
        $body = $this->bodyResolver->getResponseBody($method);

        if ($body === null) {
            return 'null';
        }

        if ($body->getType() !== null) {
            if ($api->getType($body->getType()) !== null) {
                return $body->getType();
            }
            if (TypeHelper::isPrimitiveType($body->getType())) {
                return $body->getType();
            }
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

    public function isRawResponse(Method $method)
    {
        return $this->bodyResolver->isRawResponse($method);
    }

    public function getRelatedTypes(ApiDefinition $api, TypeDefinition $type)
    {
        $relatedTypes = [];

        foreach ($type->getProperties() as $property) {
            if ($property instanceof ArrayPropertyDefinition && !$property->isSimpleType()) {
                $relatedTypes[] = $api->getType($property->getItemsType());
            } elseif ($property->getType() === PropertyDefinition::TYPE_REFERENCE) {
                $relatedTypes[] = $api->getType($property->getReference());
            }
        }

        return array_unique($relatedTypes, SORT_REGULAR);
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
        if (preg_match_all(ResourcePatterns::PATTERN_IDENTIFIER_RESOURCE, $uri, $matches) !== false) {
            foreach ($matches[1] as $match) {
                $arguments[] = new ArgumentDefinition(sprintf(
                    '%s',
                    $this->stringConverter->convertSlugToVariableName($match)
                ));
            }
        }

        return $arguments;
    }
}
