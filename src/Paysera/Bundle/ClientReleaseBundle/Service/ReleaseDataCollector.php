<?php

namespace Paysera\Bundle\ClientReleaseBundle\Service;

use Paysera\Bundle\ClientReleaseBundle\Console\MultilineQuestion;
use Paysera\Bundle\ClientReleaseBundle\Console\MultilineQuestionHelper;
use Paysera\Bundle\ClientReleaseBundle\Entity\ReleaseData;
use Paysera\Bundle\ClientReleaseBundle\Exception\ReleaseCycleException;
use Paysera\Component\ChangelogParser\Entity\ChangeEntry;
use Paysera\Component\ChangelogParser\Service\ChangelogParser;
use Paysera\Component\ChangelogParser\Service\ValueExtractor;
use Symfony\Component\Console\Helper\QuestionHelper;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Question\ChoiceQuestion;
use Symfony\Component\Console\Question\Question;

class ReleaseDataCollector
{
    private $changelogExtractor;
    private $changelogParser;

    public function __construct(
        ValueExtractor $changelogExtractor,
        ChangelogParser $changelogParser
    ) {
        $this->changelogExtractor = $changelogExtractor;
        $this->changelogParser = $changelogParser;
    }

    public function collectReleaseData(InputInterface $input, OutputInterface $output): ReleaseData
    {
        $questionHelper = new MultilineQuestionHelper();

        $quiet = $input->getOption('no_interaction');
        $version = $this->getVersionConstraint($input, $output, $questionHelper, $quiet);
        $message = $this->getCommitMessage($input, $output, $questionHelper, $quiet);
        $changeEntries = $this->getChangeEntries($input, $output, $questionHelper, $quiet);

        $releaseData = new ReleaseData();
        $releaseData
            ->setQuiet($quiet)
            ->setVersion($version)
            ->setCommitMessage($message)
            ->setChangeEntries($changeEntries)
        ;

        return $releaseData;
    }

    /**
     * @param InputInterface $input
     * @param OutputInterface $output
     * @param QuestionHelper $questionHelper
     * @param bool $quiet
     *
     * @return ChangeEntry[]
     */
    private function getChangeEntries(
        InputInterface $input,
        OutputInterface $output,
        QuestionHelper $questionHelper,
        bool $quiet
    ): array
    {
        $entries = [];
        if ($input->getOption('changelog_entry') !== null) {
            $entries = $this->parseChangelogEntries($input->getOption('changelog_entry'));
        } elseif (!$quiet) {
            $question = new MultilineQuestion(
                "<info>Please enter changelog entry without version block:</info> <comment>(submit question by hitting [ENTER][ENTER])</comment>\n"
            );
            $question->setNormalizer(function ($answer) { return empty($answer) ? '' : $answer; });
            $entries = $this->parseChangelogEntries($questionHelper->ask($input, $output, $question));
            $output->writeln('');
        }

        return $entries;
    }

    /**
     * @param string $contents
     * @return ChangeEntry[]
     */
    private function parseChangelogEntries(string $contents): array
    {
        $list = [];
        if (strlen($contents) === 0) {
            return $list;
        }

        foreach ($this->changelogExtractor->extractChangeEntryBlocks($contents) as $changeEntryBlock) {
            $list[] = $this->changelogParser->parseChangeEntry($changeEntryBlock);
        }

        return $list;
    }

    private function getCommitMessage(
        InputInterface $input,
        OutputInterface $output,
        QuestionHelper $questionHelper,
        bool $quiet
    ): string
    {
        $message = null;
        if ($input->getOption('commit_message') !== null) {
            $message = $input->getOption('commit_message');
        } elseif (!$quiet) {
            $question = new Question("<info>Please enter commit message:</info>\n");
            $question->setValidator(function ($answer) {
                if (empty($answer)) {
                    throw new \RuntimeException('Commit message is required');
                }
                return $answer;
            });
            $message = $questionHelper->ask($input, $output, $question);
            $output->writeln('');
        }

        if ($message === null) {
            throw new ReleaseCycleException('Missing "commit_message"');
        }

        return $message;
    }

    private function getVersionConstraint(
        InputInterface $input,
        OutputInterface $output,
        QuestionHelper $questionHelper,
        bool $quiet
    ): string
    {
        $version = null;
        $availableVersions = [
            SemanticVersionManipulator::VERSION_MAJOR,
            SemanticVersionManipulator::VERSION_MINOR,
            SemanticVersionManipulator::VERSION_PATCH,
        ];

        if ($input->getOption('version_constraint') !== null) {
            $version = $input->getOption('version');
        } elseif (!$quiet) {
            $question = new ChoiceQuestion(
                '<info>Please enter version constraint for generated code:</info>',
                $availableVersions
            );
            $version = $questionHelper->ask($input, $output, $question);
            $output->writeln('');
        }

        if (!in_array($version, $availableVersions, true)) {
            throw new ReleaseCycleException('Missing "version" constraint');
        }

        return $version;
    }
}
