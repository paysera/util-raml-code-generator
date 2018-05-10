<?php
declare(strict_types=1);

namespace Paysera\Bundle\PhpGeneratorBundle\Twig;

use Paysera\Bundle\CodeGeneratorBundle\Entity\Definition\ApiDefinition;
use Paysera\Bundle\CodeGeneratorBundle\Entity\Definition\ArgumentDefinition;
use Paysera\Bundle\CodeGeneratorBundle\Entity\Definition\ResultTypeDefinition;
use Paysera\Bundle\CodeGeneratorBundle\ResourcePatterns;
use Paysera\Bundle\CodeGeneratorBundle\Service\BodyResolver;
use Paysera\Bundle\CodeGeneratorBundle\Service\StringConverter;
use Paysera\Bundle\CodeGeneratorBundle\Service\TypeConfigurationProvider;
use Paysera\Bundle\CodeGeneratorBundle\Twig\BaseExtension;
use Paysera\Bundle\PhpGeneratorBundle\Service\NamespaceHelper;
use Paysera\Component\TypeHelper;
use Raml\Method;
use Raml\Resource;
use Twig_Extension;
use Twig_SimpleFunction;

class ApiMethodExtension extends Twig_Extension
{
    private $bodyResolver;
    private $baseExtension;
    private $namespaceHelper;
    private $typeConfigurationProvider;
    private $stringConverter;

    public function __construct(
        BodyResolver $bodyResolver,
        BaseExtension $baseExtension,
        NamespaceHelper $namespaceHelper,
        TypeConfigurationProvider $typeConfigurationProvider,
        StringConverter $stringConverter
    ) {
        $this->bodyResolver = $bodyResolver;
        $this->baseExtension = $baseExtension;
        $this->namespaceHelper = $namespaceHelper;
        $this->typeConfigurationProvider = $typeConfigurationProvider;
        $this->stringConverter = $stringConverter;
    }

    public function getFunctions()
    {
        return [
            new Twig_SimpleFunction('php_generate_uri', [$this, 'generateUri'], ['is_safe' => ['html']]),
            new Twig_SimpleFunction('php_generate_result_populator', [$this, 'generateResultPopulator'], ['is_safe' => ['html']]),
            new Twig_SimpleFunction('php_inline_arguments', [$this, 'inlineArguments']),
            new Twig_SimpleFunction('php_get_return_type', [$this, 'getReturnType']),
            new Twig_SimpleFunction('php_generate_method_arguments', [$this, 'generateMethodArguments']),
            new Twig_SimpleFunction('php_inline_argument_names', [$this, 'getInlineArgumentNames']),
        ];
    }

    public function getReturnType(Method $method, ApiDefinition $api): string
    {
        $body = $this->bodyResolver->getResponseBody($method);

        if ($body === null) {
            return 'null';
        }

        $bodyType = $body->getType()->getName();

        if ($body->getType() !== null) {
            if ($api->getType($bodyType) !== null) {
                return sprintf('Entities\%s', $bodyType);
            }
            if (TypeHelper::isPrimitiveType($bodyType)) {
                return $bodyType;
            }
        }

        return 'null';
    }

    /**
     * @param Method $method
     * @param Resource $resource
     * @param ApiDefinition $api
     * @return ArgumentDefinition[]
     */
    public function generateMethodArguments(Method $method, Resource $resource, ApiDefinition $api) : array
    {
        $arguments = $this->baseExtension->generateMethodArguments($method, $resource, $api);
        foreach ($arguments as $argument) {
            $typeConfig = $this->typeConfigurationProvider->getTypeConfiguration($argument->getType());
            if ($typeConfig->getImportString() !== null) {
                $argument->setNamespacedType('\\' . $typeConfig->getImportString());
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
                    $argument->getNamespacedType(),
                    $this->stringConverter->convertSlugToVariableName($argument->getName())
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
            $arguments[$key] = sprintf('urlencode($%s)', $argument->getName());
        }

        if (empty($arguments)) {
            return sprintf("'%s'", $replaced);
        }

        return sprintf("sprintf('%s', %s)", $replaced, implode(", ", $arguments));
    }

    public function generateResultPopulator(Method $method, ApiDefinition $api): string
    {
        $body = $this->bodyResolver->getResponseBody($method);

        if ($body === null) {
            return 'null;';
        }

        $bodyType = $body->getType()->getName();

        if ($body->getType() !== null && $api->getType($bodyType) !== null) {
            $type = $api->getType($bodyType);
            if ($type instanceof ResultTypeDefinition) {
                return sprintf('new Entities\%s($data, \'%s\');', $bodyType, $type->getDataKey());
            }
            return sprintf('new Entities\%s($data);', $bodyType);
        }

        return 'null;';
    }
}
