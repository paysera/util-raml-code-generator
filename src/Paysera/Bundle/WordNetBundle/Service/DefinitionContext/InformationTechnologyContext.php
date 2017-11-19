<?php

namespace Paysera\Bundle\WordNetBundle\Service\DefinitionContext;

class InformationTechnologyContext implements DefinitionContextInterface
{
    public function resolveContext($definition)
    {
        if (strpos($definition, 'database') !== false) {
            return DefinitionContextInterface::CONTEXT_NOUN;
        }

        return null;
    }
}
