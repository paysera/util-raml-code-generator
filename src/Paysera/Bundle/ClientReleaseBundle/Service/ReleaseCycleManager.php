<?php
declare(strict_types=1);

namespace Paysera\Bundle\ClientReleaseBundle\Service;

use Paysera\Bundle\ClientReleaseBundle\Entity\ApiConfig;
use Paysera\Bundle\ClientReleaseBundle\Entity\ReleaseData;
use Paysera\Bundle\ClientReleaseBundle\Entity\ReleaseStepData;
use Paysera\Bundle\ClientReleaseBundle\Exception\InvalidConfigurationException;
use Paysera\Bundle\ClientReleaseBundle\Exception\ReleaseCycleException;
use Paysera\Bundle\ClientReleaseBundle\Service\ReleaseStep\ReleaseStepInterface;
use Paysera\Bundle\ClientReleaseBundle\Service\ReleaseStep\RemoveTempDirStep;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class ReleaseCycleManager
{
    /**
     * @var ReleaseStepInterface[][]
     */
    private $releaseSteps;
    private $removeTempDirStep;

    public function __construct(
        RemoveTempDirStep $removeTempDirStep
    ) {
        $this->releaseSteps = [];
        $this->removeTempDirStep = $removeTempDirStep;
    }

    public function addReleaseStep(ReleaseStepInterface $step, string $type, string $position)
    {
        if (!isset($this->releaseSteps[$type])) {
            $this->releaseSteps[$type] = [];
        }
        $this->releaseSteps[$type][$position] = $step;
        ksort($this->releaseSteps[$type]);
    }

    public function releaseApi(ApiConfig $config, ReleaseData $releaseData, InputInterface $input, OutputInterface $output)
    {
        foreach ($config->getClients() as $client) {
            $stepData = new ReleaseStepData();
            $stepData
                ->setApiConfig($config)
                ->setReleaseData($releaseData)
                ->setClientDefinition($client)
            ;

            if (!isset($this->releaseSteps[$client->getClientType()])) {
                throw new InvalidConfigurationException(sprintf(
                    'No ReleaseSteps configured for client "%s"',
                    $client->getClientType()
                ));
            }

            pcntl_signal(SIGINT, function ($signo, $siginfo) use ($stepData, $input, $output) {
                $output->writeln('');
                $output->writeln('<error>User aborted process</error>');
                $output->writeln('');
                $this->removeTempDirStep->processStep($stepData, $input, $output);
                exit();
            });

            try {
                foreach ($this->releaseSteps[$client->getClientType()] as $releaseStep) {
                    $releaseStep->processStep($stepData, $input, $output);
                }
            } catch (ReleaseCycleException $releaseCycleException) {
                $output->writeln(sprintf("\n<error>%s</error>\n", $releaseCycleException->getMessage()));
                if ($releaseCycleException->getDebugMessage() !== null) {
                    $output->writeln("Debug message:\n");
                    $output->writeln($releaseCycleException->getDebugMessage());
                }
                $this->removeTempDirStep->processStep($stepData, $input, $output);
            }
        }
    }
}
