<?php
declare(strict_types=1);

namespace Paysera\Bundle\ClientReleaseBundle\Service\ReleaseStep;

use Paysera\Bundle\ClientReleaseBundle\Entity\ReleaseStepData;
use Paysera\Bundle\ClientReleaseBundle\Exception\ReleaseCycleException;
use Paysera\Bundle\ClientReleaseBundle\Service\RepositoryResolver;
use Paysera\Bundle\ClientReleaseBundle\Service\SemanticVersionManipulator;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Process\Process;

class PushTagToRepositoryStep implements ReleaseStepInterface
{
    private $versionManipulator;
    private $repositoryResolver;

    public function __construct(
        SemanticVersionManipulator $versionManipulator,
        RepositoryResolver $repositoryResolver
    ) {
        $this->versionManipulator = $versionManipulator;
        $this->repositoryResolver = $repositoryResolver;
    }

    public function processStep(ReleaseStepData $releaseStepData, InputInterface $input, OutputInterface $output)
    {
        $output->writeln('<info>*</info> Pushing tag to repository...');
        if ($this->repositoryResolver->isMonoRepo($releaseStepData->getClientDefinition()->getRepository())) {
            $output->writeln('<comment>MonoRepo detected, skipping</comment>');
            return;
        }

        $repositoryDir = $releaseStepData->getTempDir() . '/' . CloneRepositoryStep::TARGET_DIR;
        $currentVersion = $this->versionManipulator->resolveCurrentVersion($releaseStepData);
        if ($currentVersion === null) {
            throw new ReleaseCycleException(sprintf(
                'Failed to get latest tag from git for Api "%s" "%s" Client',
                $releaseStepData->getApiConfig()->getApiName(),
                $releaseStepData->getClientDefinition()->getClientType()
            ));
        }

        $pushProcess = new Process(
            sprintf(
                'git tag %s -am "" && git push --tags',
                    $this->versionManipulator->increase($currentVersion, $releaseStepData->getReleaseData()->getVersion())
            ),
            $repositoryDir
        );
        $pushProcess->setTty(true);

        if ($pushProcess->run() !== 0) {
            throw new ReleaseCycleException(sprintf(
                'Failed to push tag to Api "%s" "%s" client repository, error: %s',
                $releaseStepData->getApiConfig()->getApiName(),
                $releaseStepData->getClientDefinition()->getClientType(),
                !empty($pushProcess->getOutput()) ? $pushProcess->getOutput() : $pushProcess->getErrorOutput()
            ));
        }
        $output->writeln(sprintf(
            '<info>*</info> Tag <comment>%s</comment> pushed to repository'
        ));
    }
}
