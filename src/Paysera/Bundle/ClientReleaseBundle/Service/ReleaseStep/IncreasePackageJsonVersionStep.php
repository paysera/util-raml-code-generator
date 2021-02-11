<?php
declare(strict_types=1);

namespace Paysera\Bundle\ClientReleaseBundle\Service\ReleaseStep;

use Paysera\Bundle\ClientReleaseBundle\Entity\ReleaseStepData;
use Paysera\Bundle\ClientReleaseBundle\Service\PackageJsonHelper;
use Paysera\Bundle\ClientReleaseBundle\Service\SemanticVersionManipulator;
use Paysera\Bundle\ClientReleaseBundle\Service\VersionResolver\PackageJsonVersionResolver;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class IncreasePackageJsonVersionStep implements ReleaseStepInterface
{
    private $versionManipulator;
    private $packageJsonHelper;
    private $packageJsonVersionResolver;

    public function __construct(
        SemanticVersionManipulator $versionManipulator,
        PackageJsonHelper $packageJsonHelper,
        PackageJsonVersionResolver $packageJsonVersionResolver
    ) {
        $this->versionManipulator = $versionManipulator;
        $this->packageJsonHelper = $packageJsonHelper;
        $this->packageJsonVersionResolver = $packageJsonVersionResolver;
    }

    public function processStep(ReleaseStepData $releaseStepData, InputInterface $input, OutputInterface $output)
    {
        $packageJson = $this->packageJsonHelper->getSourceContents($releaseStepData);
        $generatedPackageJson = $this->packageJsonHelper->getGeneratedContents($releaseStepData);
        if ($packageJson === null) {
            $packageJson = $generatedPackageJson;
        }

        $packageJson['version'] = $this->versionManipulator->increase(
            $this->packageJsonVersionResolver->resolveCurrentVersion($releaseStepData),
            $releaseStepData->getReleaseData()->getVersion()
        );
        $packageJson['main'] = $generatedPackageJson['main'];
        $packageJson['module'] = $generatedPackageJson['module'];
        $packageJson['files'] = $generatedPackageJson['files'];
        $packageJson['scripts'] = $generatedPackageJson['scripts'];
        $packageJson['dependencies'] = $generatedPackageJson['dependencies'];
        $packageJson['devDependencies'] = $generatedPackageJson['devDependencies'];

        file_put_contents(
            $releaseStepData->getGeneratedDir() . '/package.json',
            json_encode($packageJson, JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES)
        );

        $output->writeln(sprintf(
            '<info>*</info> Increased <comment>package.json</comment> version to <comment>%s</comment>',
            $packageJson['version']
        ));
    }
}
