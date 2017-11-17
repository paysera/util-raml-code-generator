<?php

namespace Paysera\Bundle\WordNetBundle\Service;

use Paysera\Bundle\WordNetBundle\Repository\PartsOfSpeechRepository;

class PartOfSpeechResolver
{
    private $partOfSpeechRepository;

    public function __construct(PartsOfSpeechRepository $partOfSpeechRepository)
    {
        $this->partOfSpeechRepository = $partOfSpeechRepository;
    }

    /**
     * @param string $word
     * @return bool
     */
    public function isNoun($word)
    {
        $parts = $this->partOfSpeechRepository->getPartsOfSpeech($word);
        foreach ($parts->getNounDomains() as $definition) {
            if (strpos($definition, 'database') !== false) {
                return true;
            }
        }

        return count($parts->getNounDomains()) > count($parts->getVerbDomains());
    }
}
