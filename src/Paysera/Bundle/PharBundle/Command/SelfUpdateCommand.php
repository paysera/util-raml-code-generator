<?php

namespace Paysera\Bundle\PharBundle\Command;

use Humbug\SelfUpdate\Updater;
use Paysera\Bundle\PharBundle\Service\ChangelogParser;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;

class SelfUpdateCommand extends Command
{
    private $updater;
    private $changelogParser;

    public function __construct(
        Updater $updater,
        ChangelogParser $changelogParser
    ) {
        parent::__construct();

        $this->updater = $updater;
        $this->changelogParser = $changelogParser;
    }

    protected function configure()
    {
        $this
            ->setName('selfupdate')
            ->setDescription('Updates utility to latest version')
            ->addOption('rollback', null, InputOption::VALUE_NONE, 'Restores previous release')
        ;
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        if ($input->getOption('rollback')) {
            return $this->rollback($output);
        }

        if (!$this->updater->hasUpdate()) {
            $output->writeln('<comment>No new version at the moment. Check again later</comment>');
            return 0;
        }

        return $this->update($output);
    }

    private function update(OutputInterface $output)
    {
        $newVersion = $this->updater->getNewVersion();
        $output->writeln(sprintf('Preparing to update to <info>%s</info> version', $newVersion));

        try {
            if ($this->updater->update()) {
                $output->writeln(sprintf('Successfully updated to <info>%s</info> version', $newVersion));
                $output->writeln($this->changelogParser->getParsedChangelog());
                return 0;
            }
            $output->writeln('<error>Failed to update</error>');
            return 1;
        } catch (\RuntimeException $exception) {
            $output->writeln('<error>Failed to update:</error> ' . $exception->getMessage());
            return 1;
        }
    }

    private function rollback(OutputInterface $output)
    {
        try {
            if ($this->updater->rollback()) {
                $output->writeln('<info>Successfully rolled back</info>');
                return 0;
            }
            $output->writeln('<error>Failed to rollback</error>');
            return 1;
        } catch (\RuntimeException $exception) {
            $output->writeln('<error>Failed to rollback:</error> ' . $exception->getMessage());
            return 1;
        }
    }
}
