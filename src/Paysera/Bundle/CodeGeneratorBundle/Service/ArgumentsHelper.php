<?php
declare(strict_types=1);

namespace Paysera\Bundle\CodeGeneratorBundle\Service;

use Paysera\Bundle\CodeGeneratorBundle\Entity\Definition\ArgumentDefinition;
use Paysera\Bundle\CodeGeneratorBundle\Entity\Definition\FilterTypeDefinition;
use Paysera\Bundle\CodeGeneratorBundle\Exception\InvalidDefinitionException;

class ArgumentsHelper
{
    /**
     * @param ArgumentDefinition[] $arguments
     * @return ArgumentDefinition[]
     */
    public function filterOutBaseFilter(array $arguments)
    {
        $filters = [];
        foreach ($arguments as $argument) {
            if (strpos($argument->getType(), FilterTypeDefinition::BASE_FILTER) !== false) {
                $filters[] = $argument;
            }
        }

        foreach ($arguments as $key => $argument) {
            if (count($filters) > 1 && $argument->getType() === FilterTypeDefinition::BASE_FILTER) {
                unset($arguments[$key]);
            }
        }

        return $arguments;
    }

    /**
     * @param ArgumentDefinition[] $arguments
     * @return string
     * @throws InvalidDefinitionException
     */
    public function resolveArgumentName(array $arguments): string
    {
        $containsBaseFilter = false;
        foreach ($arguments as $argument) {
            if ($argument->getType() === FilterTypeDefinition::BASE_FILTER) {
                $containsBaseFilter = true;
                break;
            }
        }

        if (
            (count($arguments) > 1 && !$containsBaseFilter)
            || (count($arguments) > 2 && $containsBaseFilter)
        ) {
            $argumentNames = [];
            foreach ($arguments as $argument) {
                $argumentNames[] = $argument->getName();
            }
            throw new InvalidDefinitionException(sprintf(
                'More than one body argument found: "%s"',
                implode(', ', $argumentNames)
            ));
        }

        if (!empty($arguments)) {
            if ($containsBaseFilter) {
                foreach ($arguments as $argument) {
                    if ($argument->getType() !== FilterTypeDefinition::BASE_FILTER) {
                        return $argument->getName();
                    }
                }
            }
            return reset($arguments)->getName();
        }

        return 'null';
    }
}
