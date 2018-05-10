<?php
declare(strict_types=1);

namespace Paysera\Bundle\CodeGeneratorBundle\Twig;

use Paysera\Bundle\CodeGeneratorBundle\Entity\Definition\ApiDefinition;
use Paysera\Bundle\CodeGeneratorBundle\Entity\Definition\ArgumentDefinition;
use Paysera\Bundle\CodeGeneratorBundle\Entity\Definition\ArrayPropertyDefinition;
use Paysera\Bundle\CodeGeneratorBundle\Entity\Definition\PropertyDefinition;
use Paysera\Bundle\CodeGeneratorBundle\Entity\Definition\ResultTypeDefinition;
use Paysera\Bundle\CodeGeneratorBundle\Entity\Definition\TypeDefinition;
use Paysera\Bundle\CodeGeneratorBundle\Entity\LibraryConfiguration;
use Paysera\Bundle\CodeGeneratorBundle\Entity\TypeConfiguration;
use Paysera\Bundle\CodeGeneratorBundle\Exception\InvalidDefinitionException;
use Paysera\Bundle\CodeGeneratorBundle\ResourcePatterns;
use Paysera\Bundle\CodeGeneratorBundle\Service\BodyResolver;
use Paysera\Bundle\CodeGeneratorBundle\Service\ConstantBuilder;
use Paysera\Bundle\CodeGeneratorBundle\Service\MethodNameBuilder;
use Paysera\Bundle\CodeGeneratorBundle\Service\ResourceTypeDetector;
use Paysera\Bundle\CodeGeneratorBundle\Service\StringConverter;
use Paysera\Bundle\CodeGeneratorBundle\Service\TypeConfigurationProviderStorage;
use Paysera\Bundle\CodeGeneratorBundle\Service\UsedTypesResolver;
use Raml\Body;
use Raml\Method;
use Raml\Resource;
use Twig_Extension;
use Twig_SimpleFilter;
use Twig_SimpleFunction;

class BaseExtension extends Twig_Extension
{
    private $methodNameBuilder;
    private $resourceTypeDetector;
    private $bodyResolver;
    private $stringConverter;
    private $constantBuilder;
    private $typeConfigurationProviderStorage;
    private $usedTypesResolver;

    public function __construct(
        MethodNameBuilder $methodNameBuilder,
        ResourceTypeDetector $resourceTypeDetector,
        BodyResolver $bodyResolver,
        StringConverter $stringConverter,
        ConstantBuilder $constantBuilder,
        TypeConfigurationProviderStorage $typeConfigurationProviderStorage,
        UsedTypesResolver $usedTypesResolver
    ) {
        $this->methodNameBuilder = $methodNameBuilder;
        $this->resourceTypeDetector = $resourceTypeDetector;
        $this->bodyResolver = $bodyResolver;
        $this->stringConverter = $stringConverter;
        $this->constantBuilder = $constantBuilder;
        $this->typeConfigurationProviderStorage = $typeConfigurationProviderStorage;
        $this->usedTypesResolver = $usedTypesResolver;
    }

    public function getFilters()
    {
        return [
            new Twig_SimpleFilter('to_variable_name', [$this->stringConverter, 'convertSlugToVariableName']),
            new Twig_SimpleFilter('to_class_name', [$this->stringConverter, 'convertSlugToClassName']),
            new Twig_SimpleFilter('extract_type_name', [$this, 'extractTypeName']),

        ];
    }

    public function getFunctions()
    {
        return [
            new Twig_SimpleFunction('is_discriminated', [$this, 'isDiscriminated']),
            new Twig_SimpleFunction('get_constant_name', [$this, 'getConstantName']),

            new Twig_SimpleFunction('generate_method_name', [$this, 'generateMethodName']),
            new Twig_SimpleFunction('generate_method_arguments', [$this, 'generateMethodArguments']),
            new Twig_SimpleFunction('generate_body', [$this, 'generateBody']),
            new Twig_SimpleFunction('is_raw_response', [$this, 'isRawResponse']),
            new Twig_SimpleFunction('get_argument_names', [$this, 'getArgumentNames']),

            new Twig_SimpleFunction('get_method_body_getter_template', [$this, 'getMethodBodyGetterTemplate'], ['needs_context' => true]),
            new Twig_SimpleFunction('get_method_body_setter_template', [$this, 'getMethodBodySetterTemplate'], ['needs_context' => true]),
            new Twig_SimpleFunction('get_method_return_type_template', [$this, 'getMethodReturnTypeTemplate'], ['needs_context' => true]),
            new Twig_SimpleFunction('get_method_argument_type_template', [$this, 'getMethodArgumentTypeTemplate'], ['needs_context' => true]),
            new Twig_SimpleFunction('get_method_argument_typehint_template', [$this, 'getMethodArgumentTypeHintTemplate'], ['needs_context' => true]),

            new Twig_SimpleFunction('get_type_definition', [$this, 'getTypeDefinition']),
            new Twig_SimpleFunction('get_parent_type_config', [$this, 'getParentTypeConfig'], ['needs_context' => true]),
            new Twig_SimpleFunction('get_related_types_config', [$this, 'getRelatedTypesConfig'], ['needs_context' => true]),
            new Twig_SimpleFunction('get_external_libraries', [$this, 'getExternalLibrariesConfig'], ['needs_context' => true]),
            new Twig_SimpleFunction('get_directly_used_types', [$this, 'getDirectlyUsedTypes'], ['needs_context' => true]),
            new Twig_SimpleFunction('get_all_used_types', [$this, 'getAllUsedTypes'], ['needs_context' => true]),
        ];
    }

    public function getAllUsedTypes(array $context, ApiDefinition $api)
    {
        $externalLibs = [];
        $configurationProvider = $this->typeConfigurationProviderStorage->getTypeConfigurationProvider($context['language']);
        $types = $this->usedTypesResolver->resolveUsedTypes($api);
        foreach ($types as $type) {
            if ($configurationProvider->hasTypeConfiguration($type)) {
                $externalLibs[] = $configurationProvider->getTypeConfiguration($type);
            } else {
                $externalLibs[] = (new TypeConfiguration())
                    ->setTypeName($type)
                ;
            }
        }
        $externalLibs[] = $configurationProvider->getEntityTypeConfiguration();

        return $externalLibs;
    }

    public function extractTypeName(string $name): string
    {
        return $this->stringConverter->extractTypeName($name);
    }

    public function getDirectlyUsedTypes(array $context, ApiDefinition $apiDefinition)
    {
        $config = [];
        $types = $this->usedTypesResolver->resolveDirectlyUsedTypes($apiDefinition);
        $configurationProvider = $this->typeConfigurationProviderStorage->getTypeConfigurationProvider($context['language']);
        foreach ($types as $type) {
            $typeConfig = $configurationProvider->getTypeConfiguration($type);
            if ($typeConfig->getImportString() !== null) {
                $config[] = $typeConfig;
            } else {
                $config[] = (new TypeConfiguration())
                    ->setTypeName($type)
                ;
            }
        }
        return $config;
    }

    /**
     * @param array $context
     * @param ApiDefinition $api
     * @return LibraryConfiguration[]
     */
    public function getExternalLibrariesConfig(array $context, ApiDefinition $api)
    {
        $externalLibs = [];
        $configurationProvider = $this->typeConfigurationProviderStorage->getTypeConfigurationProvider($context['language']);
        $types = $this->usedTypesResolver->resolveUsedTypes($api);

        foreach ($types as $type) {
            $typeConfig = $configurationProvider->getTypeConfiguration($type);
            if ($typeConfig->getLibraryConfiguration() !== null) {
                $externalLibs[$typeConfig->getLibraryConfiguration()->getName()] = $typeConfig->getLibraryConfiguration();
            }
        }
        $entityTypeConfig = $configurationProvider->getEntityTypeConfiguration();
        if ($entityTypeConfig->getLibraryConfiguration() !== null) {
            $externalLibs[$entityTypeConfig->getLibraryConfiguration()->getName()] = $entityTypeConfig->getLibraryConfiguration();
        }

        return $externalLibs;
    }

    /**
     * @param array $context
     * @param TypeDefinition $type
     * @param ApiDefinition $api
     * @return TypeConfiguration[]
     */
    public function getRelatedTypesConfig(array $context, TypeDefinition $type, ApiDefinition $api)
    {
        $relatedTypes = [];
        $configurationProvider = $this->typeConfigurationProviderStorage->getTypeConfigurationProvider($context['language']);
        $types = $this->usedTypesResolver->resolveRelatedTypes($type, $api);
        foreach ($types as $typeName) {
            if ($configurationProvider->hasTypeConfiguration($typeName)) {
                    $relatedTypes[] = $configurationProvider->getTypeConfiguration($typeName);
                } else {
                    $relatedTypes[] = (new TypeConfiguration())
                        ->setTypeName($typeName);
                }
        }
        $relatedTypes[] = $this->getParentTypeConfig($context, $type);
        return array_unique($relatedTypes, SORT_REGULAR);
    }

    public function getParentTypeConfig(array $context, TypeDefinition $type)
    {
        $parent = $type->getParent();
        $configurationProvider = $this->typeConfigurationProviderStorage->getTypeConfigurationProvider($context['language']);
        if ($parent === null) {
            return $configurationProvider->getEntityTypeConfiguration();
        }
        if (!$configurationProvider->hasTypeConfiguration($parent->getName())) {
            return (new TypeConfiguration())
                ->setTypeName($parent->getName())
            ;
        }

        return $configurationProvider->getTypeConfiguration($parent->getName());
    }

    /**
     * @param ArgumentDefinition $argumentDefinition
     * @param ApiDefinition $api
     * @return TypeDefinition|null
     */
    public function getTypeDefinition(ArgumentDefinition $argumentDefinition, ApiDefinition $api)
    {
        return $api->getType($argumentDefinition->getType());
    }

    public function getMethodArgumentTypeHintTemplate(array $context, PropertyDefinition $definition)
    {
        $configurationProvider = $this->typeConfigurationProviderStorage->getTypeConfigurationProvider($context['language']);
        return $configurationProvider->getPropertyTypeConfiguration($definition)->getArgumentTypeHintTemplate();
    }

    public function getMethodArgumentTypeTemplate(array $context, PropertyDefinition $definition)
    {
        $configurationProvider = $this->typeConfigurationProviderStorage->getTypeConfigurationProvider($context['language']);
        return $configurationProvider->getPropertyTypeConfiguration($definition)->getArgumentTypeTemplate();
    }

    public function getMethodReturnTypeTemplate(array $context, PropertyDefinition $definition)
    {
        $configurationProvider = $this->typeConfigurationProviderStorage->getTypeConfigurationProvider($context['language']);
        return $configurationProvider->getPropertyTypeConfiguration($definition)->getReturnTypeTemplate();
    }

    public function getMethodBodySetterTemplate(array $context, PropertyDefinition $definition)
    {
        $configurationProvider = $this->typeConfigurationProviderStorage->getTypeConfigurationProvider($context['language']);
        return $configurationProvider->getPropertyTypeConfiguration($definition)->getSetterTemplate();
    }

    public function getMethodBodyGetterTemplate(array $context, PropertyDefinition $definition)
    {
        $configurationProvider = $this->typeConfigurationProviderStorage->getTypeConfigurationProvider($context['language']);
        return $configurationProvider->getPropertyTypeConfiguration($definition)->getGetterTemplate();
    }

    public function getConstantName(string $name, string $value): string
    {
        return $this->constantBuilder->buildName($name, $value);
    }

    public function isDiscriminated(TypeDefinition $typeDefinition): bool
    {
        return $typeDefinition->getParent() !== null && $typeDefinition->getDiscriminatorValue() !== null;
    }

    /**
     * @param ArgumentDefinition[] $arguments
     * @return string[]
     */
    public function getArgumentNames(array $arguments) : array
    {
        $parts = [];
        foreach ($arguments as $argument) {
            $parts[] = $this->stringConverter->convertSlugToVariableName($argument->getName());
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

        if (count($arguments) > 0) {
            return reset($arguments)->getName();
        }
        return null;
    }

    /**
     * @param Method $method
     * @param Resource $resource
     * @param ApiDefinition $api
     * @return ArgumentDefinition[]
     */
    public function generateMethodArguments(Method $method, Resource $resource, ApiDefinition $api) : array
    {
        return array_merge(
            $this->extractUriArguments($resource->getUri()),
            $this->extractTraitArguments($method, $api),
            $this->extractBodyTypeArguments($method, $api)
        );
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
