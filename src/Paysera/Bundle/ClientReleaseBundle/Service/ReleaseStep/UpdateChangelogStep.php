<?php
declare(strict_types=1);

namespace Paysera\Bundle\ClientReleaseBundle\Service\ReleaseStep;

use Paysera\Bundle\ClientReleaseBundle\Entity\ReleaseStepData;
use Paysera\Bundle\ClientReleaseBundle\Exception\ReleaseCycleException;
use Paysera\Bundle\ClientReleaseBundle\Service\SemanticVersionManipulator;
use Paysera\Component\ChangelogParser\Entity\Changelog;
use Paysera\Component\ChangelogParser\Entity\VersionInfo;
use Paysera\Component\ChangelogParser\Service\ChangelogDumper;
use Paysera\Component\ChangelogParser\Service\ChangelogParser;
use Symfony\Component\Console\Helper\QuestionHelper;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Question\ConfirmationQuestion;

class UpdateChangelogStep implements ReleaseStepInterface
{
    private $parser;
    private $dumper;
    private $versionManipulator;

    public function __construct(
        ChangelogParser $parser,
        ChangelogDumper $dumper,
        SemanticVersionManipulator $versionManipulator
    ) {
        $this->parser = $parser;
        $this->dumper = $dumper;
        $this->versionManipulator = $versionManipulator;
    }

    public function processStep(ReleaseStepData $releaseStepData, InputInterface $input, OutputInterface $output)
    {
        $questionHelper = new QuestionHelper();
        $existingChangelog = $releaseStepData->getSourceDir() . '/CHANGELOG.md';
        if (
            file_exists($existingChangelog)
            && count($releaseStepData->getReleaseData()->getChangeEntries()) > 0
            && !$releaseStepData->getReleaseData()->isQuiet()
        ) {
            $output->writeln('');
            $question = new ConfirmationQuestion('<info>CHANGELOG.md file found, but no Changelog entry provided, continue without providing changes? (y|N) </info>', false);
            if (!$questionHelper->ask($input, $output, $question)) {
                throw new ReleaseCycleException(sprintf(
                    'User declined to continue without providing changes to Api "%s" "%s" Client',
                    $releaseStepData->getApiConfig()->getApiName(),
                    $releaseStepData->getClientDefinition()->getClientType()
                ));
            }
            $output->writeln('');
        }

        if (
            !file_exists($existingChangelog)
            && count($releaseStepData->getReleaseData()->getChangeEntries()) === 0
        ) {
            return;
        }

        $output->writeln('<info>*</info> Processing CHANGELOG.md...');
        $changelog = new Changelog();
        if (file_exists($existingChangelog)) {
            $changelog = $this->parser->parse(file_get_contents($existingChangelog));
        }
        $changelog->unshiftVersion($this->buildVersionInfo($releaseStepData));

        file_put_contents(
            $releaseStepData->getGeneratedDir() . '/CHANGELOG.md',
            $this->dumper->dump($changelog)
        );
    }

    private function buildVersionInfo(ReleaseStepData $releaseStepData): VersionInfo
    {
        $currentVersion = $this->versionManipulator->resolveCurrentVersion($releaseStepData);
        $futureVersion = $this->versionManipulator->increase(
            $currentVersion,
            $releaseStepData->getReleaseData()->getVersion()
        );

        $versionInfo = new VersionInfo();
        $versionInfo
            ->setVersion($futureVersion)
            ->setChangeEntries($releaseStepData->getReleaseData()->getChangeEntries())
        ;

        return $versionInfo;
    }
}
