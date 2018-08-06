<?php
declare(strict_types=1);

namespace Paysera\Bundle\ClientReleaseBundle\Service\ClientDefinitionBuilder;

use Paysera\Bundle\ClientReleaseBundle\Entity\ClientDefinition;

interface ClientDefinitionBuilderInterface
{
    public function buildClientDefinition(array $data): ClientDefinition;
}
