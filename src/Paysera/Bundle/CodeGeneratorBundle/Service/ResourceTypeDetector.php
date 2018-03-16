<?php

namespace Paysera\Bundle\CodeGeneratorBundle\Service;

use Doctrine\Common\Util\Inflector;
use Fig\Http\Message\RequestMethodInterface;
use Paysera\Bundle\CodeGeneratorBundle\Entity\UriNameParts;
use Paysera\Bundle\WordNetBundle\Service\PartOfSpeechResolver;
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

    public function __construct(PartOfSpeechResolver $partOfSpeechResolver)
    {
        $this->partOfSpeechResolver = $partOfSpeechResolver;
    }

    public function isBinaryResource(Resource $resource, Method $method, UriNameParts $nameParts)
    {
        return
            $method->getType() === RequestMethodInterface::METHOD_PUT
            && preg_match(self::PATTERN_SINGULAR_RESOURCE, $resource->getUri()) === 0
            && (
                preg_match(self::PATTERN_WORD_SEPARATOR, $nameParts->getLastPart()->getPartName()) === 0
                || $this->firstWordIsVerb($nameParts->getLastPart()->getPartName())
            )
        ;
    }

    public function isPluralResource(Resource $resource, Method $method)
    {
        return
            preg_match(self::PATTERN_SINGULAR_RESOURCE, $resource->getUri()) === 0
            && $method->getType() === RequestMethodInterface::METHOD_GET
        ;
    }

    public function isSingularResource(Resource $resource, Method $method)
    {
        return
            preg_match(self::PATTERN_SINGULAR_RESOURCE, $resource->getUri()) === 1
            || $method->getType() !== RequestMethodInterface::METHOD_GET
        ;
    }

    private function firstWordIsVerb($part)
    {
        $words = preg_split(self::PATTERN_WORD_SEPARATOR, $part);
        return $this->partOfSpeechResolver->isVerb($words[0]);
    }
}
