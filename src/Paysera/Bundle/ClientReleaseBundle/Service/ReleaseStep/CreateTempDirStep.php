<?php
declare(strict_types=1);

namespace Paysera\Bundle\ClientReleaseBundle\Service\ReleaseStep;

use Paysera\Bundle\ClientReleaseBundle\Entity\ReleaseStepData;
use Paysera\Bundle\ClientReleaseBundle\Exception\ReleaseCycleException;
use Paysera\Bundle\ClientReleaseBundle\Service\EnvHelper;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Filesystem\Exception\IOException;
use Symfony\Component\Filesystem\Filesystem;

class CreateTempDirStep implements ReleaseStepInterface
{
    private $filesystem;
    private $envHelper;

    public function __construct(
        Filesystem $filesystem,
        EnvHelper $envHelper
    ) {
        $this->filesystem = $filesystem;
        $this->envHelper = $envHelper;
    }

    public function processStep(ReleaseStepData $stepData, InputInterface $input, OutputInterface $output)
    {
        $baseDir = sys_get_temp_dir();
        if ($this->envHelper->hasProjectDir()) {
            $baseDir = $_SERVER['HOME'] . '/Projects';
        }

        $tempDir = $baseDir . sprintf(
            '/%s_api_client_%s_%s',
            strtolower($stepData->getApiConfig()->getApiName()),
            $stepData->getClientDefinition()->getClientType(),
            time()
        );
        try {
            $this->filesystem->mkdir($tempDir);
        } catch (IOException $exception) {
            throw new ReleaseCycleException(
                sprintf(
                    'Failed to create temp dir for Api "%s" "%s" Client',
                    $stepData->getApiConfig()->getApiName(),
                    $stepData->getClientDefinition()->getClientType()
                ),
                0,
                $exception
            );
        }

        $output->writeln(sprintf('<info>*</info> Created temporary dir <comment>%s</comment>', $tempDir));
        $stepData->setTempDir($tempDir);
    }
}
