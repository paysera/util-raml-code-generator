<?php
declare(strict_types=1);

namespace Paysera\Bundle\CodeGeneratorBundle\Twig;

use Paysera\Bundle\CodeGeneratorBundle\Entity\Definition\ApiDefinition;
use Paysera\Bundle\CodeGeneratorBundle\Entity\Definition\ArgumentDefinition;
use Paysera\Bundle\CodeGeneratorBundle\Entity\Definition\TypeDefinition;
use Paysera\Bundle\CodeGeneratorBundle\Exception\InvalidDefinitionException;
use Paysera\Bundle\CodeGeneratorBundle\ResourcePatterns;
use Paysera\Bundle\CodeGeneratorBundle\Service\ArgumentsHelper;
use Paysera\Bundle\CodeGeneratorBundle\Service\BodyResolver;
use Paysera\Bundle\CodeGeneratorBundle\Service\ConstantBuilder;
use Paysera\Bundle\CodeGeneratorBundle\Service\MethodNameBuilder;
use Paysera\Bundle\CodeGeneratorBundle\Service\ResourceTypeDetector;
use Paysera\Bundle\PhpGeneratorBundle\Service\StringConverter;
use Raml\Body;
use Raml\Method;
use Raml\Resource;
use Twig_Extension;
use Twig_SimpleFunction;

class BaseExtension extends Twig_Extension
{
    private $methodNameBuilder;
    private $resourceTypeDetector;
    private $bodyResolver;
    private $argumentsHelper;
    private $stringConverter;
    private $constantBuilder;

    public function __construct(
        MethodNameBuilder $methodNameBuilder,
        ResourceTypeDetector $resourceTypeDetector,
        BodyResolver $bodyResolver,
        ArgumentsHelper $argumentsHelper,
        StringConverter $stringConverter,
        ConstantBuilder $constantBuilder
    ) {
        $this->methodNameBuilder = $methodNameBuilder;
        $this->resourceTypeDetector = $resourceTypeDetector;
        $this->bodyResolver = $bodyResolver;
        $this->argumentsHelper = $argumentsHelper;
        $this->stringConverter = $stringConverter;
        $this->constantBuilder = $constantBuilder;
    }

    public function getFunctions()
    {
        return [
            new Twig_SimpleFunction('get_parent_class', [$this, 'getParentClass']),
            new Twig_SimpleFunction('is_discriminated', [$this, 'isDiscriminated']),
            new Twig_SimpleFunction('get_constant_name', [$this, 'getConstantName']),

            new Twig_SimpleFunction('generate_method_name', [$this, 'generateMethodName']),
            new Twig_SimpleFunction('generate_method_arguments', [$this, 'generateMethodArguments']),
            new Twig_SimpleFunction('generate_body', [$this, 'generateBody']),
            new Twig_SimpleFunction('is_raw_response', [$this, 'isRawResponse']),
            new Twig_SimpleFunction('get_argument_names', [$this, 'getArgumentNames']),
        ];
    }

    public function getConstantName(string $name, string $value): string
    {
        return $this->constantBuilder->buildName($name, $value);
    }

    public function isDiscriminated(TypeDefinition $typeDefinition): bool
    {
        return $typeDefinition->getParent() !== null && $typeDefinition->getDiscriminatorValue() !== null;
    }

    public function getParentClass(TypeDefinition $typeDefinition): string
    {
        if ($this->isDiscriminated($typeDefinition)) {
            return $typeDefinition->getParent()->getName();
        }

        return 'Entity';
    }

    /**
     * @param ArgumentDefinition[] $arguments
     * @return string[]
     */
    public function getArgumentNames(array $arguments) : array
    {
        $parts = [];
        foreach ($arguments as $argument) {
            $parts[] = $argument->getName();
        }

        return $parts;
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

    public function generateBody(Method $method, ApiDefinition $api)
    {
        /** @var ArgumentDefinition[] $arguments */
        $arguments = array_merge(
            $this->extractTraitArguments($method, $api),
            $this->extractBodyTypeArguments($method, $api)
        );

        return $this->argumentsHelper->resolveArgumentName($arguments);
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

    /**
     * @param string $uri
     * @return ArgumentDefinition[]
     */
    public function extractUriArguments(string $uri)
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
            $traitType = $trait->getName();
            if ($api->getType($traitType) !== null) {
                $arguments[] = (
                new ArgumentDefinition(sprintf('%s', lcfirst($traitType))))->setType($traitType);
            }
        }

        return $arguments;
    }

    private function extractBodyTypeArguments(Method $method, ApiDefinition $api) : array
    {
        $arguments = [];

        /** @var Body $body */
        foreach ($method->getBodies() as $body) {
            $bodyType = $body->getType()->getName();
            if ($body->getType() !== null && $api->getType($bodyType) !== null) {
                $arguments[] = (new ArgumentDefinition(sprintf('%s', lcfirst($bodyType))))->setType($bodyType);
            }
        }

        return $arguments;
    }
}
