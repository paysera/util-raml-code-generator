<?php
declare(strict_types=1);

namespace Paysera\Bundle\ClientReleaseBundle\Service\ReleaseStep;

use Paysera\Bundle\ClientReleaseBundle\Entity\ReleaseStepData;
use Paysera\Bundle\ClientReleaseBundle\Exception\ReleaseCycleException;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

interface ReleaseStepInterface
{
    /**
     * @param ReleaseStepData $releaseStepData
     * @param InputInterface $input
     * @param OutputInterface $output
     *
     * @throws ReleaseCycleException
     */
    public function processStep(ReleaseStepData $releaseStepData, InputInterface $input, OutputInterface $output);
}
