<?php

namespace Paysera\Bundle\ClientReleaseBundle\Service;

use Paysera\Bundle\ClientReleaseBundle\Entity\ReleaseStepData;
use Paysera\Bundle\ClientReleaseBundle\Service\ReleaseStep\CloneRepositoryStep;
use Symfony\Component\Process\Process;

class SemanticVersionManipulator
{
    const VERSION_MAJOR = 'major';
    const VERSION_MINOR = 'minor';
    const VERSION_PATCH = 'patch';

    const VERSION_DEFAULT = '0.0.0';

    private $packageJsonHelper;

    public function __construct(PackageJsonHelper $packageJsonHelper)
    {
        $this->packageJsonHelper = $packageJsonHelper;
    }

    public function increase(string $current, string $constraint)
    {
        if (preg_match('#(\d+)\.(\d+)\.(\d+)#', $current, $matches) !== 1) {
            return null;
        }

        switch ($constraint) {
            case self::VERSION_MAJOR:
                return sprintf('%d.%d.%d', ++$matches[1], 0, 0);
            case self::VERSION_MINOR:
                return sprintf('%d.%d.%d', $matches[1], ++$matches[2], 0);
            case self::VERSION_PATCH:
                return sprintf('%d.%d.%d', $matches[1], $matches[2], ++$matches[3]);
            default:
                return null;
        }
    }

    public function resolveCurrentVersion(ReleaseStepData $releaseStepData)
    {
        $sourceDir = $releaseStepData->getTempDir() . '/' . CloneRepositoryStep::TARGET_DIR;
        $process = new Process('git describe --tags', $sourceDir);

        if ($process->run() === 0) {
            return trim($process->getOutput());
        }

        $packageJsonVersion = $this->packageJsonHelper->getPackageVersion($releaseStepData);
        if ($packageJsonVersion === null) {
            return self::VERSION_DEFAULT;
        }

        return $packageJsonVersion;
    }
}
