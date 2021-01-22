<?php
declare(strict_types=1);

namespace Paysera\Bundle\PhpGeneratorBundle\Twig;

use Paysera\Bundle\CodeGeneratorBundle\Entity\Definition\ApiDefinition;
use Paysera\Bundle\CodeGeneratorBundle\Entity\Definition\ArgumentDefinition;
use Paysera\Bundle\CodeGeneratorBundle\Entity\Definition\ResultTypeDefinition;
use Paysera\Bundle\CodeGeneratorBundle\ResourcePatterns;
use Paysera\Bundle\CodeGeneratorBundle\Service\BodyResolver;
use Paysera\Bundle\CodeGeneratorBundle\Service\StringConverter;
use Paysera\Bundle\CodeGeneratorBundle\Service\TypeConfigurationProviderStorage;
use Paysera\Bundle\CodeGeneratorBundle\Twig\BaseExtension;
use Paysera\Bundle\PhpGeneratorBundle\Service\NamespaceHelper;
use Paysera\Component\StringHelper;
use Paysera\Component\TypeHelper;
use Psr\Http\Message\StreamInterface;
use Raml\Method;
use Raml\Resource;
use Raml\Types\ArrayType;
use Twig_Extension;
use Twig_SimpleFilter;
use Twig_SimpleFunction;

class ApiMethodExtension extends Twig_Extension
{
    private $bodyResolver;
    private $baseExtension;
    private $namespaceHelper;
    private $typeConfigurationProviderStorage;
    private $stringConverter;

    public function __construct(
        BodyResolver $bodyResolver,
        BaseExtension $baseExtension,
        NamespaceHelper $namespaceHelper,
        TypeConfigurationProviderStorage $typeConfigurationProviderStorage,
        StringConverter $stringConverter
    ) {
        $this->bodyResolver = $bodyResolver;
        $this->baseExtension = $baseExtension;
        $this->namespaceHelper = $namespaceHelper;
        $this->typeConfigurationProviderStorage = $typeConfigurationProviderStorage;
        $this->stringConverter = $stringConverter;
    }

    public function getFunctions()
    {
        return [
            new Twig_SimpleFunction('php_generate_uri', [$this, 'generateUri'], ['is_safe' => ['html']]),
            new Twig_SimpleFunction('php_generate_result_populator', [$this, 'generateResultPopulator'], [
                'is_safe' => ['html'],
                'needs_context' => true,
            ]),
            new Twig_SimpleFunction('php_inline_arguments', [$this, 'inlineArguments']),
            new Twig_SimpleFunction('php_inline_arguments_no_typehint', [$this, 'inlineArgumentsNoTypehint']),
            new Twig_SimpleFunction('php_get_return_type', [$this, 'getReturnType'], ['needs_context' => true]),
            new Twig_SimpleFunction('php_generate_method_arguments', [$this, 'generateMethodArguments'], ['needs_context' => true]),
            new Twig_SimpleFunction('php_inline_argument_names', [$this, 'getInlineArgumentNames']),
            new Twig_SimpleFunction('php_get_library_name', [$this, 'getLibraryName']),
            new Twig_SimpleFunction('php_generate_entity_converter', [$this, 'generateEntityFromArgument'], ['needs_context' => true, 'is_safe' => ['html']]),
        ];
    }

    public function getFilters()
    {
        return [
            new Twig_SimpleFilter('php_unique_arguments_by_namespace', [$this, 'getUniqueArgumentsByNamespace']),
        ];
    }

    public function getLibraryName(string $vendor, ApiDefinition $api): string
    {
        if (isset($api->getOptions()['library_name'])) {
            return $api->getOptions()['library_name'];
        }
        return sprintf('%s/lib-%s', $vendor, StringHelper::kebabCase($api->getName()));
    }

    /**
     * @param ArgumentDefinition[] $arguments
     * @return ArgumentDefinition[]
     */
    public function getUniqueArgumentsByNamespace(array $arguments)
    {
        $unique = [];
        foreach ($arguments as $argument) {
            $key = $argument->getNamespacedType() !== null ? $argument->getNamespacedType() : $argument->getType();
            $unique[$key] = $argument;
        }

        return $unique;
    }

    public function getReturnType(array $context, Method $method, ApiDefinition $api): string
    {
        $body = $this->bodyResolver->getResponseBody($method);

        if ($body === null) {
            return 'null';
        }

        if ($this->bodyResolver->isStreamResponse($method)) {
            return '\\' . StreamInterface::class;
        }

        $bodyType = $body->getType();
        $bodyTypeName = $bodyType->getName();

        $configurationProvider = $this->getTypeConfigurationProvider($context);
        if ($configurationProvider->hasTypeConfiguration($bodyTypeName)) {
            $typeConfiguration = $configurationProvider->getTypeConfiguration($bodyTypeName);
            if ($typeConfiguration->getApiMethodReturnType() !== null) {
                return $typeConfiguration->getApiMethodReturnType();
            }
        }

        if ($api->getType($bodyTypeName) !== null) {
            return sprintf('Entities\%s', $bodyTypeName);
        }
        if ($bodyType instanceof ArrayType) {
            if ($api->getType($bodyType->getItems()->getName()) !== null) {
                return sprintf('Entities\%s[]', $bodyType->getItems()->getName());
            } else {
                return sprintf('%s[]', $bodyType->getItems()->getName());
            }
        }
        if (TypeHelper::isPrimitiveType($bodyTypeName)) {
            return $bodyTypeName;
        }

        return 'null';
    }

    /**
     * @param array $context
     * @param Method $method
     * @param Resource $resource
     * @param ApiDefinition $api
     * @return ArgumentDefinition[]
     */
    public function generateMethodArguments(array $context, Method $method, Resource $resource, ApiDefinition $api) : array
    {
        $arguments = $this->baseExtension->generateMethodArguments($method, $resource, $api);
        $configurationProvider = $this->getTypeConfigurationProvider($context);
        foreach ($arguments as $argument) {
            $typeConfig = $configurationProvider->getTypeConfiguration($argument->getType());
            if ($typeConfig->getImportString() !== null) {
                $argument
                    ->setNamespacedType('\\' . $typeConfig->getImportString())
                    ->setImportedType($typeConfig->getTypeName())

                ;
            } else {
                $argument->setNamespacedType($this->namespaceHelper->buildNamespace($argument->getType()));
            }
        }
        return $arguments;
    }

    /**
     * @param ArgumentDefinition[] $arguments
     * @return string
     */
    public function inlineArguments(array $arguments): string
    {
        $parts = [];
        foreach ($arguments as $argument) {
            if ($argument->getType() === ArgumentDefinition::TYPE_DEFAULT) {
                $parts[] = '$' . $argument->getName();
            } else {
                $parts[] = sprintf(
                    '%s $%s',
                    $argument->getImportedType() !== null ? $argument->getImportedType() : $argument->getNamespacedType(),
                    $this->stringConverter->convertSlugToVariableName(
                        $argument->getRenamedName() !== null ? $argument->getRenamedName() : $argument->getName()
                    )
                );
            }
        }

        return trim(implode(', ', $parts));
    }

    public function inlineArgumentsNoTypehint(array $arguments): string
    {
        $parts = [];
        foreach ($arguments as $argument) {
            if ($argument->getType() === ArgumentDefinition::TYPE_DEFAULT) {
                $parts[] = '$' . $argument->getName();
            } else {
                $parts[] = sprintf(
                    '$%s',
                    $this->stringConverter->convertSlugToVariableName(
                        $argument->getRenamedName() !== null ? $argument->getRenamedName() : $argument->getName()
                    )
                );
            }
        }

        return trim(implode(', ', $parts));
    }

    public function generateUri(Resource $resource): string
    {
        $replaced = preg_replace(ResourcePatterns::PATTERN_IDENTIFIER_RESOURCE, '%s', ltrim($resource->getUri(), '/'));
        $arguments = $this->baseExtension->extractUriArguments($resource->getUri());

        foreach ($arguments as $key => $argument) {
            $arguments[$key] = sprintf('rawurlencode($%s)', $argument->getName());
        }

        if (empty($arguments)) {
            return sprintf("'%s'", $replaced);
        }

        return sprintf("sprintf('%s', %s)", $replaced, implode(", ", $arguments));
    }

    public function generateEntityFromArgument(array $context, Method $method, ApiDefinition $api): string
    {
        $body = $this->bodyResolver->getRequestBody($method);

        if ($body !== null) {
            $bodyType = $body->getType();
            $bodyTypeName = $bodyType->getName();
            $configurationProvider = $this->getTypeConfigurationProvider($context);
            if ($configurationProvider->hasTypeConfiguration($bodyTypeName)) {
                $typeConfiguration = $configurationProvider->getTypeConfiguration($bodyTypeName);
                if ($typeConfiguration->getEntityConverterCode() !== null) {
                    return $typeConfiguration->getEntityConverterCode();
                }
            }
        }

        $generatedBody = $this->baseExtension->generateBody($method, $api);
        if ($generatedBody === null) {
            return 'null';
        }
        return sprintf('$%s', $this->baseExtension->getVariableNameByCodeType($context, $generatedBody));
    }

    public function generateResultPopulator(array $context, Method $method, ApiDefinition $api): string
    {
        $body = $this->bodyResolver->getResponseBody($method);

        if ($body === null) {
            return 'null;';
        }

        $bodyType = $body->getType();
        $bodyTypeName = $bodyType->getName();

        $configurationProvider = $this->getTypeConfigurationProvider($context);
        if ($configurationProvider->hasTypeConfiguration($bodyTypeName)) {
            $typeConfiguration = $configurationProvider->getTypeConfiguration($bodyTypeName);
            if ($typeConfiguration->getResultPopulatorCode() !== null) {
                return $typeConfiguration->getResultPopulatorCode();
            }
        }

        if ($api->getType($bodyTypeName) !== null) {
            $type = $api->getType($bodyTypeName);
            if ($type instanceof ResultTypeDefinition) {
                return sprintf('new Entities\%s($data, \'%s\');', $bodyTypeName, $type->getDataKey());
            }
            return sprintf('new Entities\%s($data);', $bodyTypeName);
        }

        if ($bodyType instanceof ArrayType) {
            if ($api->getType($bodyType->getItems()->getName()) !== null) {
                return sprintf(
                    'array_map(function ($item) { return new Entities\%s($item); }, $data);',
                    $bodyType->getItems()->getName()
                );
            } else {
                return '$data;';
            }
        }

        return 'null;';
    }

    private function getTypeConfigurationProvider(array $context)
    {
        return $this->typeConfigurationProviderStorage->getTypeConfigurationProvider($context['code_type']);
    }
}
