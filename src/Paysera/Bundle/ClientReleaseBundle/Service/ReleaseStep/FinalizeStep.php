<?php
declare(strict_types=1);

namespace Paysera\Bundle\ClientReleaseBundle\Service\ReleaseStep;

use Paysera\Bundle\ClientReleaseBundle\Entity\ReleaseStepData;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class FinalizeStep implements ReleaseStepInterface
{
    public function processStep(ReleaseStepData $releaseStepData, InputInterface $input, OutputInterface $output)
    {
        $output->writeln('');
        $output->writeln(sprintf(
            "<success>\n\n   Congratulations - '%s' Client for Api '%s' successfully released!\n</success>",
            $releaseStepData->getClientDefinition()->getClientType(),
            $releaseStepData->getApiConfig()->getApiName()
        ));
        $output->writeln('');
    }
}
