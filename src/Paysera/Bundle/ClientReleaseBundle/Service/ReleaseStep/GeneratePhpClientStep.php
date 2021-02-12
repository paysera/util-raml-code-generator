<?php
declare(strict_types=1);

namespace Paysera\Bundle\ClientReleaseBundle\Service\ReleaseStep;

use Paysera\Bundle\ClientReleaseBundle\Entity\PhpClientDefinition;
use Paysera\Bundle\ClientReleaseBundle\Entity\ReleaseStepData;
use Paysera\Bundle\ClientReleaseBundle\Exception\ReleaseCycleException;
use Paysera\Bundle\ClientReleaseBundle\Service\BinaryPathResolver;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Process\Process;

class GeneratePhpClientStep implements ReleaseStepInterface
{
    const PHAR_FILE_NAME = 'raml-code-generator';

    private $binaryPathResolver;

    public function __construct(BinaryPathResolver $binaryPathResolver)
    {
        $this->binaryPathResolver = $binaryPathResolver;
    }

    public function processStep(ReleaseStepData $releaseStepData, InputInterface $input, OutputInterface $output)
    {
        /** @var PhpClientDefinition $clientDefinition */
        $clientDefinition = $releaseStepData->getClientDefinition();
        $releaseStepData->setGeneratedDir($releaseStepData->getTempDir() . '/generated');

        $args = [
            $this->binaryPathResolver->getPath(
                [
                    self::PHAR_FILE_NAME,
                    self::PHAR_FILE_NAME . '.phar',
                ]
            ),
            'php-generator:rest-client',
            'raml_file' => $releaseStepData->getApiConfig()->getRamlFile(),
            'output_dir' => $releaseStepData->getGeneratedDir(),
            'namespace' => $clientDefinition->getNamespace(),
        ];
        if ($clientDefinition->getLibraryName() !== null) {
            $args['library_name'] = '--library_name=' . $clientDefinition->getLibraryName();
        }
        $generateProcess = new Process($args);

        $output->writeln(sprintf('<info>*</info> Generated PHP code...'));
        $exitCode = $generateProcess->run();
        if ($exitCode !== 0) {
            throw new ReleaseCycleException(sprintf(
                'Failed to generate PHP client for Api "%s", error: %s',
                $releaseStepData->getApiConfig()->getApiName(),
                $generateProcess->getOutput() . $generateProcess->getErrorOutput()
            ));
        }

        $output->writeln(sprintf(
            '<info>*</info> Generated PHP code for Api "%s"',
            $releaseStepData->getApiConfig()->getApiName()
        ));
    }
}
