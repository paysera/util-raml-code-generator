<?php

namespace Paysera\Bundle\ClientReleaseBundle\Service;

use Paysera\Bundle\ClientReleaseBundle\Entity\ReleaseStepData;

class PackageJsonHelper
{
    /**
     * @param ReleaseStepData $releaseStepData
     * @return string|null
     */
    public function getPackageVersion(ReleaseStepData $releaseStepData)
    {
        $packageJson = $this->getSourceContents($releaseStepData);

        if ($packageJson === null || !isset($packageJson['version'])) {
            return null;
        }

        return $packageJson['version'];
    }

    public function getSourceContents(ReleaseStepData $releaseStepData)
    {
        return json_decode(
            file_get_contents($releaseStepData->getSourceDir() . '/package.json'),
            true
        );
    }

    public function getGeneratedContents(ReleaseStepData $releaseStepData)
    {
        return json_decode(
            file_get_contents($releaseStepData->getGeneratedDir() . '/package.json'),
            true
        );
    }
}
