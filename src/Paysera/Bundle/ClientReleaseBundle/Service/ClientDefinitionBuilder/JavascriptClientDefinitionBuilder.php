<?php
declare(strict_types=1);

namespace Paysera\Bundle\ClientReleaseBundle\Service\ClientDefinitionBuilder;

use Paysera\Bundle\ClientReleaseBundle\Entity\ClientDefinition;
use Paysera\Bundle\ClientReleaseBundle\Entity\JavascriptClientDefinition;

class JavascriptClientDefinitionBuilder implements ClientDefinitionBuilderInterface
{
    private $baseDefinitionBuilder;

    public function __construct(BaseDefinitionBuilder $baseDefinitionBuilder)
    {
        $this->baseDefinitionBuilder = $baseDefinitionBuilder;
    }

    public function buildClientDefinition(array $data): ClientDefinition
    {
        $definition = new JavascriptClientDefinition();
        $this->baseDefinitionBuilder->addBaseData($data, $definition);

        if (isset($data['client_name'])) {
            $definition->setClientName($data['client_name']);
        }

        return $definition;
    }
}
