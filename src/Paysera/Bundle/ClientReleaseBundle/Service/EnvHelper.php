<?php
declare(strict_types=1);

namespace Paysera\Bundle\ClientReleaseBundle\Service;

use Symfony\Component\Process\Process;

class EnvHelper
{
    public function hasProjectDir(): bool
    {
        return file_exists($_SERVER['HOME'] . '/Projects');
    }

    public function hasDockerInstalled(): bool
    {
        return (new Process('docker'))->run() === 0;
    }

    public function hasContainerStarted(string $name): bool
    {
        $process = new Process(sprintf(
            'docker ps --filter="name=%s" --format="{{.Names}}"',
            $name
        ));

        return $process->run() === 0 && trim($process->getOutput()) === $name;
    }
}
