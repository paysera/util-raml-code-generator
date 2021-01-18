<?php
declare(strict_types=1);

namespace Paysera\Bundle\ClientReleaseBundle\Service\ClientDefinitionBuilder;

use Paysera\Bundle\ClientReleaseBundle\Entity\ClientDefinition;
use Paysera\Bundle\ClientReleaseBundle\Entity\JavascriptClientDefinition;
use Paysera\Bundle\ClientReleaseBundle\Service\VersionResolver\VersionResolverInterface;

class JavascriptClientDefinitionBuilder implements ClientDefinitionBuilderInterface
{
    private $baseDefinitionBuilder;
    private $versionResolver;

    public function __construct(BaseDefinitionBuilder $baseDefinitionBuilder, VersionResolverInterface $versionResolver)
    {
        $this->baseDefinitionBuilder = $baseDefinitionBuilder;
        $this->versionResolver = $versionResolver;
    }

    public function buildClientDefinition(array $data): ClientDefinition
    {
        $definition = new JavascriptClientDefinition();
        $this->baseDefinitionBuilder->addBaseData($data, $definition);

        if (isset($data['client_name'])) {
            $definition->setClientName($data['client_name']);
        }

        $definition->setVersionResolver($this->versionResolver);

        return $definition;
    }
}
