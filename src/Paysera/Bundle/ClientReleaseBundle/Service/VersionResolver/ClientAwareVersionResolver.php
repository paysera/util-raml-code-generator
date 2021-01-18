<?php

declare(strict_types=1);

namespace Paysera\Bundle\ClientReleaseBundle\Service\VersionResolver;

use Paysera\Bundle\ClientReleaseBundle\Entity\JavascriptClientDefinition;
use Paysera\Bundle\ClientReleaseBundle\Entity\ReleaseStepData;

class ClientAwareVersionResolver implements VersionResolverInterface
{
    private $gitTagVersionResolver;
    private $packageJsonVersionResolver;

    public function __construct(
        GitTagVersionResolver $gitTagVersionResolver,
        PackageJsonVersionResolver $packageJsonVersionResolver
    ) {
        $this->gitTagVersionResolver = $gitTagVersionResolver;
        $this->packageJsonVersionResolver = $packageJsonVersionResolver;
    }

    public function resolveCurrentVersion(ReleaseStepData $releaseStepData): string
    {
        if ($releaseStepData->getClientDefinition() instanceof JavascriptClientDefinition) {
            return $this->packageJsonVersionResolver->resolveCurrentVersion($releaseStepData);
        }

        return $this->gitTagVersionResolver->resolveCurrentVersion($releaseStepData);
    }
}
