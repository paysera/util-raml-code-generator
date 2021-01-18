<?php

declare(strict_types=1);

namespace Paysera\Bundle\ClientReleaseBundle\Service\VersionResolver;

use Paysera\Bundle\ClientReleaseBundle\Entity\ReleaseStepData;
use Paysera\Bundle\ClientReleaseBundle\Service\ReleaseStep\CloneRepositoryStep;
use Symfony\Component\Process\Process;

class GitTagVersionResolver implements VersionResolverInterface
{
    public function resolveCurrentVersion(ReleaseStepData $releaseStepData): string
    {
        $sourceDir = $releaseStepData->getTempDir() . '/' . CloneRepositoryStep::TARGET_DIR;
        $process = new Process('git describe --tags', $sourceDir);

        if ($process->run() === 0) {
            return trim($process->getOutput());
        }

        return VersionResolverInterface::VERSION_DEFAULT;
    }
}
