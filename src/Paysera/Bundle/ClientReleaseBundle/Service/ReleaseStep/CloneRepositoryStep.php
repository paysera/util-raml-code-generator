<?php
declare(strict_types=1);

namespace Paysera\Bundle\ClientReleaseBundle\Service\ReleaseStep;

use Paysera\Bundle\ClientReleaseBundle\Entity\ReleaseStepData;
use Paysera\Bundle\ClientReleaseBundle\Exception\ReleaseCycleException;
use Paysera\Bundle\ClientReleaseBundle\Service\RepositoryResolver;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Filesystem\Filesystem;
use Symfony\Component\Process\Process;

class CloneRepositoryStep implements ReleaseStepInterface
{
    const TARGET_DIR = 'source';

    private $repositoryResolver;
    private $filesystem;

    public function __construct(
        RepositoryResolver $repositoryResolver,
        Filesystem $filesystem
    ) {
        $this->repositoryResolver = $repositoryResolver;
        $this->filesystem = $filesystem;
    }

    public function processStep(ReleaseStepData $releaseStepData, InputInterface $input, OutputInterface $output)
    {
        $repository = $releaseStepData->getClientDefinition()->getRepository();
        $repositoryUrl = $this->repositoryResolver->extractRepositoryUrl($repository);

        if ($repositoryUrl === null) {
            throw new ReleaseCycleException(sprintf(
                'Cannot resolve RepositoryUrl from repository data for Api "%s" "%s" Client',
                $releaseStepData->getApiConfig()->getApiName(),
                $releaseStepData->getClientDefinition()->getClientType()
            ));
        }

        $cloneProcess = new Process(
            [
                'git',
                'clone',
                $repositoryUrl,
                self::TARGET_DIR,
            ],
            $releaseStepData->getTempDir()
        );

        $output->writeln('<info>*</info> Cloning repository...');
        $exitCode = $cloneProcess->run();
        if ($exitCode !== 0) {
            throw new ReleaseCycleException(sprintf(
                'Failed to clone repository "%s", got error: %s',
                $repositoryUrl,
                $cloneProcess->getOutput()
            ));
        }

        $sourceDir = $releaseStepData->getTempDir() . '/' . self::TARGET_DIR . $this->repositoryResolver->extractTargetPath($repository);
        if (!$this->filesystem->exists($sourceDir)) {
            $this->filesystem->mkdir($sourceDir);
        }

        $releaseStepData->setSourceDir($sourceDir);
        $output->writeln('<info>*</info> Cloned Repository into temporary dir.');
    }
}
