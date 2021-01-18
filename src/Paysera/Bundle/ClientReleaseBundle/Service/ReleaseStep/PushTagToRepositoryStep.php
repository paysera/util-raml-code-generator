<?php
declare(strict_types=1);

namespace Paysera\Bundle\ClientReleaseBundle\Service\ReleaseStep;

use Paysera\Bundle\ClientReleaseBundle\Entity\ReleaseStepData;
use Paysera\Bundle\ClientReleaseBundle\Exception\ReleaseCycleException;
use Paysera\Bundle\ClientReleaseBundle\Service\RepositoryResolver;
use Paysera\Bundle\ClientReleaseBundle\Service\SemanticVersionManipulator;
use Paysera\Bundle\ClientReleaseBundle\Service\VersionResolver\VersionResolverInterface;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Process\Process;

class PushTagToRepositoryStep implements ReleaseStepInterface
{
    private $versionManipulator;
    private $repositoryResolver;
    private $versionResolver;

    public function __construct(
        SemanticVersionManipulator $versionManipulator,
        RepositoryResolver $repositoryResolver,
        VersionResolverInterface $versionResolver
    ) {
        $this->versionManipulator = $versionManipulator;
        $this->repositoryResolver = $repositoryResolver;
        $this->versionResolver = $versionResolver;
    }

    public function processStep(ReleaseStepData $releaseStepData, InputInterface $input, OutputInterface $output)
    {
        $output->writeln('<info>*</info> Pushing tag to repository...');
        if ($this->repositoryResolver->isMonoRepo($releaseStepData->getClientDefinition()->getRepository())) {
            $output->writeln('<comment>MonoRepo detected, skipping</comment>');
            return;
        }

        $repositoryDir = $releaseStepData->getTempDir() . '/' . CloneRepositoryStep::TARGET_DIR;
        $tag = $this->versionManipulator->increase(
            $this->versionResolver->resolveCurrentVersion($releaseStepData),
            $releaseStepData->getReleaseData()->getVersion()
        );
        $pushProcess = new Process(
            sprintf('git tag %s -am "" && git push --tags', $tag),
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
            '<info>*</info> Tag <comment>%s</comment> pushed to repository', $tag
        ));
    }
}
