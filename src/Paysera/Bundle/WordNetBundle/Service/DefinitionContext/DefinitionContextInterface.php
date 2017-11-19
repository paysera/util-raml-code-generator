<?php

namespace Paysera\Bundle\WordNetBundle\Service\DefinitionContext;

interface DefinitionContextInterface
{
    const CONTEXT_NOUN = 'noun';

    /**
     * @param string $definition
     * @return string|null
     */
    public function resolveContext($definition);
}
