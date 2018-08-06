<?php
declare(strict_types=1);

namespace Paysera\Bundle\ClientReleaseBundle\Service\ReleaseStep;

use Paysera\Bundle\ClientReleaseBundle\Entity\ReleaseStepData;
use Paysera\Bundle\ClientReleaseBundle\Exception\ReleaseCycleException;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Process\Process;

class PushCodeToRepositoryStep implements ReleaseStepInterface
{
    public function processStep(ReleaseStepData $releaseStepData, InputInterface $input, OutputInterface $output)
    {
        $output->writeln('<info>*</info> Pushing changes to repository...');
        $repositoryDir = $releaseStepData->getTempDir() . '/' . CloneRepositoryStep::TARGET_DIR;

        $pushProcess = new Process(
            sprintf(
                'git add -A && git commit -am "%s" && git push',
                    $releaseStepData->getReleaseData()->getCommitMessage()
            ),
            $repositoryDir
        );
        $pushProcess->setTty(true);

        if ($pushProcess->run() !== 0) {
            throw new ReleaseCycleException(sprintf(
                'Failed to push changes to Api "%s" "%s" client repository, error: %s',
                $releaseStepData->getApiConfig()->getApiName(),
                $releaseStepData->getClientDefinition()->getClientType(),
                !empty($pushProcess->getOutput()) ? $pushProcess->getOutput() : $pushProcess->getErrorOutput()
            ));
        }
        $output->writeln('<info>*</info> Changes pushed to repository');
    }
}
