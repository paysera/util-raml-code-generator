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

class PublishJavascriptPackageStep implements ReleaseStepInterface
{
    private $envHelper;

    public function __construct(
        EnvHelper $envHelper
    ) {
        $this->envHelper = $envHelper;
    }

    public function processStep(ReleaseStepData $releaseStepData, InputInterface $input, OutputInterface $output)
    {
        $publishProcess = new Process(['npm', 'publish'], $releaseStepData->getGeneratedDir());

        if (
            $this->envHelper->hasProjectDir()
            && $this->envHelper->hasDockerInstalled()
        ) {
            if (!$this->envHelper->hasContainerStarted('node')) {
                if (!$releaseStepData->getReleaseData()->isQuiet()) {
                    $questionHelper = new QuestionHelper();
                    $output->writeln('');
                    $question = new ConfirmationQuestion('<info>Docker found, but "node" container is not running, publish JS package with local node? (Y|n) </info>');
                    if (!$questionHelper->ask($input, $output, $question)) {
                        throw new ReleaseCycleException(sprintf(
                            'User declined JS package publish with local node for Api "%s"',
                            $releaseStepData->getApiConfig()->getApiName()
                        ));
                    }
                }
            } else {
                $publishProcess = new Process(sprintf(
                    'docker exec -it node sudo -u app -i bash -c "cd src/%s && npm publish"',
                    substr($releaseStepData->getGeneratedDir(), strlen($_SERVER['HOME'] . '/Projects') + 1)
                ));
                $publishProcess->setPty(true);
            }
        }

        $publishProcess->setTimeout(120);

        $output->writeln('<info>*</info> Publishing JS package...');
        if ($publishProcess->run() !== 0) {
            throw new ReleaseCycleException(sprintf(
                'Failed to publish JS package for Api "%s"',
                $releaseStepData->getApiConfig()->getApiName()
            ));
        }
    }
}
