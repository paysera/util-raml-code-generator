<?php
declare(strict_types=1);

namespace Paysera\Bundle\PhpGeneratorBundle\Twig;

use Fig\Http\Message\RequestMethodInterface;
use Paysera\Bundle\CodeGeneratorBundle\Entity\Definition\ApiDefinition;
use Paysera\Bundle\CodeGeneratorBundle\Entity\Definition\ArgumentDefinition;
use Paysera\Bundle\CodeGeneratorBundle\Entity\Definition\ArrayPropertyDefinition;
use Paysera\Bundle\CodeGeneratorBundle\Entity\Definition\PropertyDefinition;
use Paysera\Bundle\CodeGeneratorBundle\Entity\Definition\ResultTypeDefinition;
use Paysera\Bundle\CodeGeneratorBundle\Entity\Definition\TypeDefinition;
use Paysera\Bundle\CodeGeneratorBundle\Entity\TypeConfiguration;
use Paysera\Bundle\CodeGeneratorBundle\Service\BodyResolver;
use Paysera\Bundle\CodeGeneratorBundle\Service\MethodNameBuilder;
use Paysera\Bundle\CodeGeneratorBundle\Service\StringConverter;
use Paysera\Bundle\CodeGeneratorBundle\Service\TypeConfigurationProvider;
use Paysera\Bundle\CodeGeneratorBundle\Service\UsedTypesResolver;
use Paysera\Bundle\CodeGeneratorBundle\Twig\BaseExtension;
use Paysera\Bundle\PhpGeneratorBundle\Service\NamespaceHelper;
use Paysera\Bundle\RestBundle\Repository\ResultProvider;
use Paysera\Component\Serializer\Entity\Result;
use Paysera\Component\Serializer\Normalizer\ArrayNormalizer;
use Paysera\Component\StringHelper;
use Paysera\Component\TypeHelper;
use Raml\Method;
use Raml\Resource;
use Symfony\Component\HttpFoundation\Response;
use Twig_Extension;
use Twig_SimpleFilter;
use Twig_SimpleFunction;

class BundleExtension extends Twig_Extension
{
    private $typeConfigurationProvider;
    private $bodyResolver;
    private $usedTypesResolver;
    private $methodNameBuilder;
    private $apiMethodExtension;
    private $namespaceHelper;
    private $stringConverter;
    private $baseExtension;

    public function __construct(
        TypeConfigurationProvider $typeConfigurationProvider,
        BodyResolver $bodyResolver,
        UsedTypesResolver $usedTypesResolver,
        MethodNameBuilder $methodNameBuilder,
        ApiMethodExtension $apiMethodExtension,
        NamespaceHelper $namespaceHelper,
        StringConverter $stringConverter,
        BaseExtension $baseExtension
    ) {
        $this->typeConfigurationProvider = $typeConfigurationProvider;
        $this->bodyResolver = $bodyResolver;
        $this->usedTypesResolver = $usedTypesResolver;
        $this->methodNameBuilder = $methodNameBuilder;
        $this->apiMethodExtension = $apiMethodExtension;
        $this->namespaceHelper = $namespaceHelper;
        $this->stringConverter = $stringConverter;
        $this->baseExtension = $baseExtension;
    }

    public function getFunctions()
    {
        return [
            new Twig_SimpleFunction('symfony_bundle_get_normalizer_constructor_args', [$this, 'getNormalizerConstructorArguments']),
            new Twig_SimpleFunction('symfony_bundle_type_has_collection', [$this, 'typeHasCollection']),
            new Twig_SimpleFunction('symfony_bundle_get_return_type', [$this, 'getReturnType']),
            new Twig_SimpleFunction('symfony_bundle_get_response_type', [$this, 'getResponseType']),
            new Twig_SimpleFunction('symfony_bundle_get_directly_used_types_in_sub_resource', [$this, 'getDirectlyUsedTypesInSubResource']),
            new Twig_SimpleFunction('symfony_bundle_get_controller_constructor_args', [$this, 'getControllerConstructorArgs']),
            new Twig_SimpleFunction('symfony_bundle_generate_method_arguments', [$this, 'generateMethodArguments'], ['needs_context' => true]),

        ];
    }

    public function getFilters()
    {
        return [
            new Twig_SimpleFilter('symfony_bundle_unique_arguments', [$this, 'getUniqueArguments']),
            new Twig_SimpleFilter('symfony_bundle_unique_array_types', [$this, 'getUniqueArrayTypes']),
        ];
    }

    public function generateMethodArguments(array $context, Method $method, Resource $resource, ApiDefinition $api)
    {
        $nameParts = $this->methodNameBuilder->getNameParts($resource->getUri());
        $arguments = $this->apiMethodExtension->generateMethodArguments($context, $method, $resource, $api);
        if (!$nameParts->hasPlaceholder()) {
            return $arguments;
        }

        /** @var TypeDefinition[] $placeholderTypes */
        $placeholderTypes = [];
        foreach ($nameParts->getAllPlaceholders() as $placeholder) {
            $placeholderName = $this->stringConverter->convertSlugToVariableName(trim($placeholder, '{}'));
            $placeholderTypes[$placeholderName] = $this->resolveClosestTypeForPlaceholder($placeholder, $resource, $api);
        }
        foreach ($arguments as $key => $argument) {
            if (isset($placeholderTypes[$argument->getName()])) {
                $argType = $placeholderTypes[$argument->getName()];
                $argName = $argType->getName();
                $originalPlaceholder = $argument->getName();
                $renamedName = null;

                if ($method->getType() === RequestMethodInterface::METHOD_PUT) {
                    foreach ($arguments as $subKey => $subArgument) {
                        if (strtolower($subArgument->getName()) === strtolower($argType->getName())) {
                            $subArgument->setRenamedName('updated' . ucfirst($subArgument->getName()));
                            $renamedName = 'original' . ucfirst($argType->getName());
                        }
                    }
                }
                $namespacedType = null;
                $importedType = $this->namespaceHelper->buildNamespace($argType->getName());

                $typeConfig = $this->typeConfigurationProvider->getTypeConfiguration($argType->getType());
                if ($typeConfig->getImportString() !== null) {
                    $namespacedType = $typeConfig->getImportString();
                    $importedType = $typeConfig->getTypeName();
                }

                $arg = (new ArgumentDefinition($argName))
                    ->setNamespacedType($namespacedType)
                    ->setImportedType($importedType)
                    ->setType($argType->getType())
                    ->setOriginalPlaceholder($originalPlaceholder)
                    ->setRenamedName($renamedName)
                ;
                $arguments[$key] = $arg;
            }
        }

        return $arguments;
    }

    public function getDirectlyUsedTypesInSubResource(ApiDefinition $apiDefinition, string $subResourceName)
    {
        $types = [];
        foreach ($apiDefinition->getRamlDefinition()->getResources() as $resource) {
            $names = $this->methodNameBuilder->getNameParts($resource->getUri());
            if (StringHelper::singular($names->getPartName()) === $subResourceName) {
                $types = $this->usedTypesResolver->getDirectlyUsedTypes($resource, $types);
                return $this->processResolvedTypes($apiDefinition, $types);
            }
        }
        return $types;
    }

    public function getResponseType(Method $method, ApiDefinition $api)
    {
        $body = $this->bodyResolver->getResponseBody($method);
        if ($body === null) {
            return null;
        }
        $bodyType = $body->getType();
        return $api->getType($bodyType->getName());
    }

    public function getReturnType(Method $method, ApiDefinition $api)
    {
        $body = $this->bodyResolver->getResponseBody($method);

        if ($body === null) {
            return 'null';
        }

        $bodyType = $body->getType();
        $bodyTypeName = $bodyType->getName();
        $type = $api->getType($bodyType->getName());

        if ($type instanceof ResultTypeDefinition) {
            return sprintf('Result|Entities\\%s[]', $type->getItemsType());
        }
        if ($type !== null) {
            return sprintf('Entities\\%s', $bodyTypeName);
        }
        if (TypeHelper::isPrimitiveType($bodyTypeName)) {
            return 'Response';
        }

        return 'null';
    }

    /**
     * @param TypeDefinition[] $types
     * @return TypeDefinition[]
     */
    public function getUniqueArrayTypes(array $types)
    {
        $unique = [];
        foreach ($types as $type) {
            $args = $this->getNormalizerConstructorArguments($type);
            foreach ($args as $arg) {
                if ($arg->getType() === ArgumentDefinition::TYPE_ARRAY) {
                    $key = sprintf('%s-%s', $arg->getName(), $arg->getInnerType());
                    $unique[$key] = $arg;
                }
            }
        }

        return array_values($unique);
    }

    /**
     * @param ArgumentDefinition[] $arguments
     * @return ArgumentDefinition[]
     */
    public function getUniqueArguments(array $arguments)
    {
        $unique = [];
        foreach ($arguments as $arg) {
            $unique[$arg->getType()] = $arg;
        }

        return array_values($unique);
    }

    public function typeHasCollection(TypeDefinition $definition)
    {
        foreach ($definition->getProperties() as $property) {
            if (
                $property instanceof ArrayPropertyDefinition
                && !in_array($property->getItemsType(), PropertyDefinition::getScalarTypes(), true)
            ) {
                return true;
            }
        }

        return false;
    }

    /**
     * @param Resource $resource
     * @param ApiDefinition $definition
     * @return ArgumentDefinition[]
     */
    public function getControllerConstructorArgs(Resource $resource, ApiDefinition $definition)
    {
        $entities = $this->extractEntityNames($resource, $definition, []);

        $arguments = [];
        foreach ($entities as $entity) {
            if (strpos($entity->getType(), 'ResultProvider') !== false) {
                $arguments[] = (new ArgumentDefinition($entity->getName()))
                    ->setType($entity->getType())
                    ->setImportedType('ResultProvider')
                    ->setNamespacedType(ResultProvider::class)
                ;
            }
            if (strpos($entity->getType(), 'Manager') !== false) {
                $arguments[] = (new ArgumentDefinition($entity->getName()))
                    ->setType(ucfirst($entity->getType()))
                ;
            }
        }

        return $arguments;
    }

    /**
     * @param TypeDefinition $definition
     * @return ArgumentDefinition[]
     */
    public function getNormalizerConstructorArguments(TypeDefinition $definition)
    {
        $arguments = [];
        foreach ($definition->getProperties() as $property) {
            $propertyConfiguration = $this->typeConfigurationProvider->getPropertyTypeConfiguration($property);
            if (
                $propertyConfiguration->getLibraryConfiguration() !== null
                && $propertyConfiguration->getNormalizerImportString() === null
            ) {
                continue;
            }
            if (
                $property instanceof ArrayPropertyDefinition
                && !in_array($property->getItemsType(), PropertyDefinition::getScalarTypes(), true)
            ) {
                $arguments[] = (new ArgumentDefinition($property->getName()))
                    ->setType(ArgumentDefinition::TYPE_ARRAY)
                    ->setNamespacedType(ArrayNormalizer::class)
                    ->setInnerType($property->getItemsType())
                ;
            }
            if ($property->getType() === PropertyDefinition::TYPE_REFERENCE) {
                $argument = (new ArgumentDefinition($property->getReference()))
                    ->setType($property->getReference())
                ;
                if ($propertyConfiguration->getNormalizerImportString() !== null) {
                    $parts = explode('\\',$propertyConfiguration->getNormalizerImportString());
                    $argument
                        ->setNamespacedType($propertyConfiguration->getNormalizerImportString())
                        ->setImportedType(array_pop($parts))
                    ;
                }
                $arguments[$property->getReference()] = $argument;
            }
        }

        return array_values($arguments);
    }

    /**
     * @param Resource $resource
     * @param ApiDefinition $api
     * @param array $entities
     * @return ArgumentDefinition[]
     */
    private function extractEntityNames(Resource $resource, ApiDefinition $api, array $entities)
    {
        $entityName = $this->methodNameBuilder->getMethodEntityName($resource);

        foreach ($resource->getMethods() as $method) {
            $args = $this->generateMethodArguments(['code_type' => 'symfony_bundle'], $method, $resource, $api);
            if (
                $this->methodNameBuilder->methodReturnsResult($method, $api)
                && $this->baseExtension->extractFilterFromArguments($args) !== null
            ) {
                $entities[$entityName . 'ResultProvider'] = (new ArgumentDefinition($entityName))
                    ->setType($entityName . 'ResultProvider')
                ;
            }
        }
        $entities[$entityName . 'Manager'] = (new ArgumentDefinition($entityName))
            ->setType($entityName . 'Manager')
        ;
        foreach ($resource->getResources() as $subResource) {
            $entities = $this->extractEntityNames($subResource, $api, $entities);
        }

        return $entities;
    }

    private function resolveClosestTypeForPlaceholder(string $placeholder, Resource $resource, ApiDefinition $api)
    {
        $nameParts = $this->methodNameBuilder->getNameParts($resource->getUri());
        $currentPlaceholder = $nameParts->getLastPart()->getPlaceholder();
        if ($currentPlaceholder === $placeholder) {
            $parent = $resource->getParentResource();
            if ($parent === null) {
                return null;
            }
            try {
                $postMethod = $parent->getMethod(RequestMethodInterface::METHOD_POST);
            } catch (\Exception $exception) {
                if ($parent->getParentResource() !== null) {
                    return $this->resolveClosestTypeForPlaceholder($placeholder, $parent->getParentResource(), $api);
                }
                return null;
            }
            $body = $this->bodyResolver->getRequestBody($postMethod);
            if ($body === null) {
                return null;
            }
            return $api->getType($body->getType()->getName());
        }

        $parent = $resource->getParentResource();
        if ($parent === null) {
            return null;
        }
        return $this->resolveClosestTypeForPlaceholder($placeholder, $parent, $api);
    }

    private function processResolvedTypes(ApiDefinition $apiDefinition, array $types)
    {
        $config = [];
        foreach ($types as $typeName) {
            if ($typeName === null) {
                $config['Response'] = (new TypeConfiguration())
                    ->setTypeName('Response')
                    ->setImportString(Response::class)
                ;
                continue;
            }
            $typeConfig = $this->typeConfigurationProvider->getTypeConfiguration($typeName);
            if ($typeConfig->getImportString() !== null) {
                $config[$typeName] = $typeConfig;
            } else {
                $type = $apiDefinition->getType($typeName);
                if ($type instanceof ResultTypeDefinition) {
                    $config['Result'] = (new TypeConfiguration())
                        ->setTypeName('Result')
                        ->setImportString(Result::class)
                    ;
                }
                if ($type !== null) {
                    $config[$typeName] = (new TypeConfiguration())
                        ->setTypeName($type)
                    ;
                }
                if ($type === null) {
                    $config['Response'] = (new TypeConfiguration())
                        ->setTypeName('Response')
                        ->setImportString(Response::class)
                    ;
                    continue;
                }
            }
        }

        return $config;
    }
}
