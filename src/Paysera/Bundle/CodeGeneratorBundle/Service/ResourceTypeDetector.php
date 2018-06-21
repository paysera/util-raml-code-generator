<?php

namespace Paysera\Bundle\CodeGeneratorBundle\Service;

use Fig\Http\Message\RequestMethodInterface;
use Paysera\Bundle\CodeGeneratorBundle\Entity\Definition\ApiDefinition;
use Paysera\Bundle\CodeGeneratorBundle\Entity\UriNameParts;
use Paysera\Bundle\WordNetBundle\Service\PartOfSpeechResolver;
use Paysera\Component\StringHelper;
use Raml\Method;
use Raml\Resource;

class ResourceTypeDetector
{
    // /categories/{id}
    const PATTERN_SINGULAR_RESOURCE = '#{(\w+)}$#';

    // /categories/{id}/*
    const PATTERN_IDENTIFIER_RESOURCE = '#{(\w+)}#';

    const PATTERN_WORD_SEPARATOR = '#_|-#';

    private $partOfSpeechResolver;
    private $bodyResolver;

    public function __construct(
        PartOfSpeechResolver $partOfSpeechResolver,
        BodyResolver $bodyResolver
    ) {
        $this->partOfSpeechResolver = $partOfSpeechResolver;
        $this->bodyResolver = $bodyResolver;
    }

    public function isBinaryResource(Resource $resource, Method $method, UriNameParts $nameParts)
    {
        $lastPartName = $nameParts->getLastPart()->getPartName();
        if ($method->getType() === RequestMethodInterface::METHOD_PUT) {
            if (preg_match(self::PATTERN_SINGULAR_RESOURCE, $resource->getUri()) === 0) {
                if (preg_match(self::PATTERN_WORD_SEPARATOR, $lastPartName) === 0) {
                    if (count($this->getWords($lastPartName)) === 1) {
                        return $this->partOfSpeechResolver->canBeVerb($lastPartName);
                    }
                    return false;
                }
                return $this->firstWordIsVerb($lastPartName);
            }
        }
        return false;
    }

    public function isPluralResource(Resource $resource, Method $method)
    {
        return
            preg_match(self::PATTERN_SINGULAR_RESOURCE, $resource->getUri()) === 0
            && $method->getType() === RequestMethodInterface::METHOD_GET
        ;
    }

    public function isSingularResource(Resource $resource, Method $method, ApiDefinition $api, UriNameParts $nameParts)
    {
        return
            preg_match(self::PATTERN_SINGULAR_RESOURCE, $resource->getUri()) === 1
            || $method->getType() !== RequestMethodInterface::METHOD_GET
            || (
                !$this->bodyResolver->isIterableResponse($method, $api)
                && !StringHelper::isPlural($nameParts->getLastPart()->getPartName())
            )
        ;
    }

    private function firstWordIsVerb($part)
    {
        $words = $this->getWords($part);
        return $this->partOfSpeechResolver->isVerb($words[0]);
    }

    private function getWords($string)
    {
        return preg_split(self::PATTERN_WORD_SEPARATOR, $string);
    }
}
