<?php
declare(strict_types=1);

namespace Paysera\Bundle\ClientReleaseBundle\Service\ReleaseStep;

use Paysera\Bundle\ClientReleaseBundle\Entity\ReleaseStepData;
use Paysera\Bundle\ClientReleaseBundle\Exception\ReleaseCycleException;
use Paysera\Bundle\ClientReleaseBundle\Service\EnvHelper;
use Symfony\Component\Console\Helper\QuestionHelper;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Question\ConfirmationQuestion;
use Symfony\Component\Process\Process;

class BuildJavascriptDistFilesStep implements ReleaseStepInterface
{
    private $envHelper;

    public function __construct(
        EnvHelper $envHelper
    ) {
        $this->envHelper = $envHelper;
    }

    public function processStep(ReleaseStepData $releaseStepData, InputInterface $input, OutputInterface $output)
    {
        $installProcess = new Process(['npm', 'i'], $releaseStepData->getGeneratedDir());
        $buildProcess = new Process(['npm', 'run', 'build'], $releaseStepData->getGeneratedDir());

        if (
            $this->envHelper->hasProjectDir()
            && $this->envHelper->hasDockerInstalled()
        ) {
            if (!$this->envHelper->hasContainerStarted('node')) {
                if (!$releaseStepData->getReleaseData()->isQuiet()) {
                    $questionHelper = new QuestionHelper();
                    $output->writeln('');
                    $question = new ConfirmationQuestion('<info>Docker found, but "node" container is not running, generate dist files with local node? (Y|n) </info>');
                    if (!$questionHelper->ask($input, $output, $question)) {
                        throw new ReleaseCycleException(sprintf(
                            'User declined JS dist file generation with local node for Api "%s"',
                            $releaseStepData->getApiConfig()->getApiName()
                        ));
                    }
                }
            } else {
                $installProcess = new Process(sprintf(
                    'docker exec -it node sudo -u app -i bash -c "cd src/%s && npm i"',
                    substr($releaseStepData->getGeneratedDir(), strlen($_SERVER['HOME'] . '/Projects') + 1)
                ));
                $installProcess->setPty(true);

                $buildProcess = new Process(sprintf(
                    'docker exec -it node sudo -u app -i bash -c "cd src/%s && npm run build"',
                    substr($releaseStepData->getGeneratedDir(), strlen($_SERVER['HOME'] . '/Projects') + 1)
                ));
                $buildProcess->setPty(true);
            }
        }

        $installProcess->setTimeout(120);
        $buildProcess->setTimeout(120);

        $output->writeln('<info>*</info> Installing JS dependencies...');
        if ($installProcess->run() !== 0) {
            $exception = new ReleaseCycleException(sprintf(
                'Failed to install JS dependencies for Api "%s"',
                $releaseStepData->getApiConfig()->getApiName()
            ));
            $exception->setDebugMessage($installProcess->getErrorOutput());
            throw $exception;
        }

        $output->writeln('<info>*</info> Building JS dist files...');
        if ($buildProcess->run() !== 0) {
            $exception = new ReleaseCycleException(sprintf(
                'Failed to build JS dist for Api "%s"',
                $releaseStepData->getApiConfig()->getApiName()
            ));
            $exception->setDebugMessage($buildProcess->getErrorOutput());
            throw $exception;
        }
    }
}
