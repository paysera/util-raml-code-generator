<?php

declare(strict_types=1);

namespace Paysera\Bundle\ClientReleaseBundle\Service\VersionResolver;

use Paysera\Bundle\ClientReleaseBundle\Entity\ReleaseStepData;
use Paysera\Bundle\ClientReleaseBundle\Service\PackageJsonHelper;

class PackageJsonVersionResolver implements VersionResolverInterface
{
    private $packageJsonHelper;

    public function __construct(PackageJsonHelper $packageJsonHelper)
    {
        $this->packageJsonHelper = $packageJsonHelper;
    }

    public function resolveCurrentVersion(ReleaseStepData $releaseStepData): string
    {
        $packageJsonVersion = $this->packageJsonHelper->getPackageVersion($releaseStepData);
        if ($packageJsonVersion !== null) {
            return $packageJsonVersion;
        }

        return VersionResolverInterface::VERSION_DEFAULT;
    }
}
