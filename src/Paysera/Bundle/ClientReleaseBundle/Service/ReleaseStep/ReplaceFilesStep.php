<?php
declare(strict_types=1);

namespace Paysera\Bundle\ClientReleaseBundle\Service\ReleaseStep;

use Paysera\Bundle\ClientReleaseBundle\Entity\ReleaseStepData;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Filesystem\Filesystem;

class ReplaceFilesStep implements ReleaseStepInterface
{
    private $filesystem;

    public function __construct(Filesystem $filesystem)
    {
        $this->filesystem = $filesystem;
    }

    public function processStep(ReleaseStepData $releaseStepData, InputInterface $input, OutputInterface $output)
    {
        $output->writeln(sprintf('<info>*</info> Mirroring generated files to source repository...'));

        $this->filesystem->mirror(
            $releaseStepData->getGeneratedDir(),
            $releaseStepData->getSourceDir(),
            null,
            [
                'delete' => true,
                'override' => true,
            ]
        );
    }
}
