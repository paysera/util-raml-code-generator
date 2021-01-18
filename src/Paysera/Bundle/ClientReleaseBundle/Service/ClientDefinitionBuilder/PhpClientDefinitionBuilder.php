<?php
declare(strict_types=1);

namespace Paysera\Bundle\ClientReleaseBundle\Service\ClientDefinitionBuilder;

use Paysera\Bundle\ClientReleaseBundle\Entity\ClientDefinition;
use Paysera\Bundle\ClientReleaseBundle\Entity\PhpClientDefinition;
use Paysera\Bundle\ClientReleaseBundle\Service\VersionResolver\VersionResolverInterface;

class PhpClientDefinitionBuilder implements ClientDefinitionBuilderInterface
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
        $definition = new PhpClientDefinition();
        $this->baseDefinitionBuilder->addBaseData($data, $definition);

        if (isset($data['namespace'])) {
            $definition->setNamespace($data['namespace']);
        }

        $definition->setVersionResolver($this->versionResolver);

        return $definition;
    }
}
