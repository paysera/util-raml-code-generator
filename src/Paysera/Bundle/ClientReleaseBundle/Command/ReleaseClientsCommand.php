<?php
declare(strict_types=1);

namespace Paysera\Bundle\ClientReleaseBundle\Command;

use Paysera\Bundle\ClientReleaseBundle\Entity\ApiConfigList;
use Paysera\Bundle\ClientReleaseBundle\Service\ApiConfigBuilder;
use Paysera\Bundle\ClientReleaseBundle\Service\ReleaseCycleManager;
use Paysera\Bundle\ClientReleaseBundle\Service\ReleaseDataCollector;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Formatter\OutputFormatterStyle;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Validator\ConstraintViolationInterface;
use Symfony\Component\Validator\Validator\ValidatorInterface;

class ReleaseClientsCommand extends Command
{
    private $apiConfigBuilder;
    private $validator;
    private $releaseCycleManager;
    private $releaseDataCollector;

    public function __construct(
        ApiConfigBuilder $apiConfigBuilder,
        ValidatorInterface $validator,
        ReleaseCycleManager $releaseCycleManager,
        ReleaseDataCollector $releaseDataCollector
    ) {
        parent::__construct();
        $this->apiConfigBuilder = $apiConfigBuilder;
        $this->validator = $validator;
        $this->releaseCycleManager = $releaseCycleManager;
        $this->releaseDataCollector = $releaseDataCollector;
    }

    protected function configure()
    {
        $this
            ->setName('release:clients')
            ->setDescription('Command reads config.json, generates defined clients and releases them')
            ->addArgument('config_file', InputArgument::REQUIRED, 'path to configuration file')

            ->addOption('version_constraint', null, InputOption::VALUE_OPTIONAL, 'version constraint for generated code according to semantic versioning')
            ->addOption('commit_message', null, InputOption::VALUE_OPTIONAL, 'commit message')
            ->addOption('changelog_entry', null, InputOption::VALUE_OPTIONAL, 'entry in changelog')
            ->addOption('no_interaction', null, InputOption::VALUE_NONE, 'should not ask any questions')
        ;
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $list = $this->apiConfigBuilder->buildApiConfigs($input->getArgument('config_file'));
        if (!$this->isValidApiConfigList($input->getArgument('config_file'), $list, $output)) {
            return 1;
        }

        $noticeStyle = new OutputFormatterStyle('red');
        $successStyle = new OutputFormatterStyle('white', 'green');
        $output->getFormatter()->setStyle('notice', $noticeStyle);
        $output->getFormatter()->setStyle('success', $successStyle);

        $releaseData = $this->releaseDataCollector->collectReleaseData($input, $output);

        foreach ($list->getItems() as $item) {
            $this->releaseCycleManager->releaseApi($item, $releaseData, $input, $output);
        }

        return 0;
    }

    private function isValidApiConfigList(string $configFile, ApiConfigList $apiConfigList, OutputInterface $output): bool
    {
        $violationList = $this->validator->validate($apiConfigList);

        if (count($violationList) > 0) {
            $output->writeln('');
            $output->writeln(sprintf(
                'Invalid configuration file <comment>%s</comment> provided:',
                $configFile
            ));
            /** @var ConstraintViolationInterface $item */
            foreach ($violationList as $item) {
                $output->writeln(sprintf(
                    '<comment>%s</comment>: <error>%s</error>',
                    $item->getPropertyPath(),
                    $item->getMessage()
                ));
            }
            $output->writeln('');
            return false;
        }

        return true;
    }
}
