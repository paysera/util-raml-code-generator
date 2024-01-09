<?php
declare(strict_types=1);

namespace Paysera\Bundle\JavascriptGeneratorBundle\Twig;

use Doctrine\Common\Inflector\Inflector;
use Paysera\Bundle\CodeGeneratorBundle\Entity\Definition\ApiDefinition;
use Paysera\Bundle\CodeGeneratorBundle\Entity\Definition\ArrayPropertyDefinition;
use Paysera\Bundle\CodeGeneratorBundle\Entity\Definition\PropertyDefinition;
use Paysera\Bundle\CodeGeneratorBundle\Entity\Definition\ResultTypeDefinition;
use Paysera\Bundle\CodeGeneratorBundle\Entity\Definition\TypeDefinition;
use Paysera\Bundle\CodeGeneratorBundle\ResourcePatterns;
use Paysera\Bundle\CodeGeneratorBundle\Service\BodyResolver;
use Paysera\Bundle\CodeGeneratorBundle\Service\TypeConfigurationProviderStorage;
use Paysera\Bundle\CodeGeneratorBundle\Twig\BaseExtension;
use Paysera\Bundle\CodeGeneratorBundle\Service\StringConverter;
use Paysera\Component\StringHelper;
use Paysera\Component\TypeHelper;
use Raml\Method;
use Raml\Resource;
use Raml\Types\ArrayType;
use Twig_Extension;
use Twig_SimpleFunction;

class ApiMethodExtension extends Twig_Extension
{
    private $stringConverter;
    private $bodyResolver;
    private $baseExtension;
    private $typeConfigurationProviderStorage;

    public function __construct(
        StringConverter $stringConverter,
        BodyResolver $bodyResolver,
        BaseExtension $baseExtension,
        TypeConfigurationProviderStorage $typeConfigurationProviderStorage
    ) {
        $this->stringConverter = $stringConverter;
        $this->bodyResolver = $bodyResolver;
        $this->baseExtension = $baseExtension;
        $this->typeConfigurationProviderStorage = $typeConfigurationProviderStorage;
    }

    public function getFunctions()
    {
        return [
            new Twig_SimpleFunction('js_get_client_name', [$this, 'getClientName']),
            new Twig_SimpleFunction('js_get_package_name', [$this, 'getPackageName']),
            new Twig_SimpleFunction('js_get_package_version', [$this, 'getPackageVersion']),
            new Twig_SimpleFunction('js_get_platform_version', [$this, 'getPlatformVersion']),
            new Twig_SimpleFunction('js_get_angular_module_name', [$this, 'getAngularJsModuleName'], ['is_safe' => ['js']]),
            new Twig_SimpleFunction('js_get_angular_client_factory_name', [$this, 'getAngularJsFactoryClassName']),
            new Twig_SimpleFunction('js_generate_uri', [$this, 'generateUri'], ['is_safe' => ['html']]),
            new Twig_SimpleFunction('js_generate_result_populator', [$this, 'generateResultPopulator'], [
                'is_safe' => ['html'],
                'needs_context' => true,
            ]),
            new Twig_SimpleFunction('js_get_return_type', [$this, 'getReturnType']),
            new Twig_SimpleFunction('js_get_related_types', [$this, 'getRelatedTypes']),
        ];
    }

    public function getClientName(ApiDefinition $api): string
    {
        return sprintf('%s', $this->stringConverter->convertSlugToClassName($api->getName()));
    }

    public function getPackageName(string $vendor, ApiDefinition $api): string
    {
        if (isset($api->getOptions()['library_name'])) {
            return $api->getOptions()['library_name'];
        }
        return sprintf('@%s/%s', $vendor, StringHelper::kebabCase($api->getName()));
    }

    public function getPackageVersion(ApiDefinition $api): string
    {
        return $api->getOptions()['library_version'] ?? '0.0.1';
    }

    public function getPlatformVersion(ApiDefinition $api): ?string
    {
        return $api->getOptions()['platform_version'] ?? null;
    }

    public function getAngularJsModuleName(string $vendor, string $apiName) : string
    {
        return sprintf('%s.http.%s', $vendor, StringHelper::kebabCase($apiName));
    }

    public function getAngularJsFactoryClassName(string $vendor, string $apiName) : string
    {
        return sprintf('%sHttp%sFactory', $vendor, ucfirst(Inflector::classify($apiName)));
    }

    public function generateUri(Resource $resource) : string
    {
        $replaced = preg_replace(ResourcePatterns::PATTERN_IDENTIFIER_RESOURCE, '%s', ltrim($resource->getUri(), '/'));
        $arguments = $this->baseExtension->extractUriArguments($resource->getUri());

        foreach ($arguments as $key => $argument) {
            $arguments[$key] = sprintf('${encodeURIComponent(%s)}', $argument->getName());
        }

        if (empty($arguments)) {
            return $replaced;
        }

        return vsprintf($replaced, $arguments);
    }

    public function generateResultPopulator(array $context, Method $method, ApiDefinition $api) : string
    {
        $body = $this->bodyResolver->getResponseBody($method);

        if ($body === null) {
            return 'null';
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
                return sprintf(
                    'new %s(data, \'%s\')',
                    $this->stringConverter->extractTypeName($bodyTypeName),
                    $type->getDataKey()
                );
            }
            return sprintf(
                'new %s(data)',
                $this->stringConverter->extractTypeName($bodyTypeName)
            );
        }
        if ($bodyType instanceof ArrayType) {
            if ($api->getType($bodyType->getItems()->getName()) !== null) {
                return sprintf(
                    'data.map(item => new %s(item))',
                    $this->stringConverter->extractTypeName($bodyType->getItems()->getName())
                );
            } else {
                return 'data';
            }
        }

        return 'null';
    }

    public function getReturnType(Method $method, ApiDefinition $api) : string
    {
        $body = $this->bodyResolver->getResponseBody($method);

        if ($body === null) {
            return 'null';
        }

        $bodyType = $body->getType();
        $bodyTypeName = $bodyType->getName();

        if ($api->getType($bodyTypeName) !== null) {
            return $bodyTypeName;
        }
        if ($bodyType instanceof ArrayType) {
            return sprintf('%s[]', $bodyType->getItems()->getName());
        }
        if (TypeHelper::isPrimitiveType($bodyTypeName)) {
            return $bodyTypeName;
        }

        return 'null';
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
        if ($type->getParent() !== null) {
            $relatedTypes[] = $api->getType($type->getParent()->getName());
        }

        return array_unique($relatedTypes, SORT_REGULAR);
    }

    private function getTypeConfigurationProvider(array $context)
    {
        return $this->typeConfigurationProviderStorage->getTypeConfigurationProvider($context['code_type']);
    }
}
