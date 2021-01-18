<?php
declare(strict_types=1);

namespace Paysera\Bundle\ClientReleaseBundle\Service\ClientDefinitionBuilder;

use Paysera\Bundle\ClientReleaseBundle\Entity\ClientDefinition;
use Paysera\Bundle\ClientReleaseBundle\Entity\PhpClientDefinition;

class PhpClientDefinitionBuilder implements ClientDefinitionBuilderInterface
{
    private $baseDefinitionBuilder;

    public function __construct(BaseDefinitionBuilder $baseDefinitionBuilder)
    {
        $this->baseDefinitionBuilder = $baseDefinitionBuilder;
    }

    public function buildClientDefinition(array $data): ClientDefinition
    {
        $definition = new PhpClientDefinition();
        $this->baseDefinitionBuilder->addBaseData($data, $definition);

        if (isset($data['namespace'])) {
            $definition->setNamespace($data['namespace']);
        }

        return $definition;
    }
}
