<?php

declare(strict_types=1);

namespace Paysera\Bundle\ClientReleaseBundle\Service\VersionResolver;

use Paysera\Bundle\ClientReleaseBundle\Entity\ReleaseStepData;

interface VersionResolverInterface
{
    const VERSION_DEFAULT = '0.0.0';

    public function resolveCurrentVersion(ReleaseStepData $releaseStepData): string;
}
