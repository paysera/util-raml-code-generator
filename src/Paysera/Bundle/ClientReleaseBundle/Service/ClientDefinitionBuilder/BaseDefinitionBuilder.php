<?php
declare(strict_types=1);

namespace Paysera\Bundle\ClientReleaseBundle\Service\ClientDefinitionBuilder;

use Paysera\Bundle\ClientReleaseBundle\Entity\ClientDefinition;

class BaseDefinitionBuilder
{
    public function addBaseData(array $data, ClientDefinition $definition)
    {
        if (isset($data['repository'])) {
            $definition->setRepository($data['repository']);
        }
        if (isset($data['library_name'])) {
            $definition->setLibraryName($data['library_name']);
        }
    }
}
