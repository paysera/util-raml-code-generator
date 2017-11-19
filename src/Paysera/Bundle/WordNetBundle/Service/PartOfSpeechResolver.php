<?php

namespace Paysera\Bundle\WordNetBundle\Service;

use Paysera\Bundle\WordNetBundle\Repository\PartsOfSpeechRepository;
use Paysera\Bundle\WordNetBundle\Service\DefinitionContext\DefinitionContextInterface;

class PartOfSpeechResolver
{
    private $partOfSpeechRepository;
    private $definitionContext;

    public function __construct(
        PartsOfSpeechRepository $partOfSpeechRepository,
        DefinitionContextInterface $definitionContext
    ) {
        $this->partOfSpeechRepository = $partOfSpeechRepository;
        $this->definitionContext = $definitionContext;
    }

    /**
     * @param string $word
     * @return bool
     */
    public function isNoun($word)
    {
        $parts = $this->partOfSpeechRepository->getPartsOfSpeech($word);
        foreach ($parts->getNounDomains() as $definition) {
            if ($this->definitionContext->resolveContext($definition) === DefinitionContextInterface::CONTEXT_NOUN) {
                return true;
            }
        }

        return count($parts->getNounDomains()) > count($parts->getVerbDomains());
    }
}
