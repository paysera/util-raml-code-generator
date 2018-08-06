<?php
declare(strict_types=1);

namespace Paysera\Bundle\ClientReleaseBundle\Service\ReleaseStep;

use Paysera\Bundle\ClientReleaseBundle\Entity\ReleaseStepData;
use Paysera\Bundle\ClientReleaseBundle\Exception\ReleaseCycleException;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Filesystem\Exception\IOException;
use Symfony\Component\Filesystem\Filesystem;

class RemoveTempDirStep implements ReleaseStepInterface
{
    private $filesystem;

    public function __construct(Filesystem $filesystem)
    {
        $this->filesystem = $filesystem;
    }

    public function processStep(ReleaseStepData $releaseStepData, InputInterface $input, OutputInterface $output)
    {
        try {
            $this->filesystem->remove($releaseStepData->getTempDir());
        } catch (IOException $exception) {
            throw new ReleaseCycleException(
                sprintf(
                    'Failed to remove temp dir for Api "%s" "%s" Client',
                    $releaseStepData->getApiConfig()->getApiName(),
                    $releaseStepData->getClientDefinition()->getClientType()
                ),
                0,
                $exception
            );
        }

        $output->writeln(sprintf(
            '<info>*</info> Removed temporary dir <comment>%s</comment>',
            $releaseStepData->getTempDir()
        ));
    }
}
