<?php
declare(strict_types=1);

namespace Paysera\Bundle\JavascriptGeneratorBundle\Command;

use Paysera\Bundle\JavascriptGeneratorBundle\Service\NameResolver;
use Symfony\Component\Process\Exception\ProcessFailedException;
use Paysera\Bundle\CodeGeneratorBundle\Service\CodeGenerator;
use Symfony\Component\Console\Question\ConfirmationQuestion;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Filesystem\Filesystem;
use Symfony\Component\Process\Process;

class GeneratePackageCommand extends Command
{
    const LANGUAGE = 'js';

    private $nameResolver;
    private $codeGenerator;
    private $outputDir;
    private $vendorPrefix;
    private $filesystem;

    public function __construct(
        CodeGenerator $codeGenerator,
        NameResolver $nameResolver,
        Filesystem $filesystem,
        string $outputDir,
        string $vendorPrefix
    ) {
        parent::__construct();

        $this->codeGenerator = $codeGenerator;
        $this->nameResolver = $nameResolver;
        $this->filesystem = $filesystem;
        $this->outputDir = $outputDir;
        $this->vendorPrefix = $vendorPrefix;
    }

    protected function configure()
    {
        parent::configure();

        $this
            ->setName('paysera:js-generator:package')
            ->setDescription('Generates Javascript package with Client from given RAML definition')
            ->addArgument('api_name', InputArgument::REQUIRED, 'The name of API definition to look for')
            ->addArgument('client_name', InputArgument::REQUIRED, 'Name of the main client class')
            ->addOption(
                'build-dependencies',
                'b',
                InputOption::VALUE_NONE,
                'Runs "npm install" and "npm run build" commands, downloads dependencies and transpiles code to ES5 syntax'
            )
        ;
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $directory = $this->outputDir . DIRECTORY_SEPARATOR . $input->getArgument('api_name');
        if (!$this->filesystem->exists($directory)) {
            $this->filesystem->mkdir($directory);
        }

        $directory = realpath($directory);

        if (!$this->confirm($input, $output, $directory, $input->getArgument('api_name'))) {
            return;
        }

        $this->codeGenerator->generateCode(
            self::LANGUAGE,
            $input->getArgument('api_name'),
            $input->getArgument('client_name')
        );

        $output->writeln('');
        $output->writeln(sprintf('Code successfully generated to <info>%s</info> directory', $directory));

        if ($input->getOption('build-dependencies')) {
            $this->runNpmInstall($output, $directory);
            $this->runNpmBuild($output, $directory);
        }

        $output->writeln('');
    }

    private function confirm(InputInterface $input, OutputInterface $output, string $directory, string $apiName) : bool
    {
        $question = new ConfirmationQuestion(sprintf(
            'Package <comment>%s</comment> with <comment>%s</comment> will be generated to <comment>%s</comment> directory, y/n?',
            $this->nameResolver->getPackageName($this->vendorPrefix, $apiName),
            $this->nameResolver->getClientName($apiName),
            $directory
        ));

        $helper = $this->getHelper('question');

        return $helper->ask($input, $output, $question);
    }

    private function runNpmInstall(OutputInterface $output, string $directory)
    {
        $command = sprintf('cd %s && npm i', $directory);

        $output->writeln(sprintf('Running <info>%s</info> command', $command));

        $process = new Process($command);
        $process->run();
        if (!$process->isSuccessful()) {
            throw new ProcessFailedException($process);
        }

        $output->write($process->getOutput());
    }

    private function runNpmBuild(OutputInterface $output, string $directory)
    {
        $command = sprintf('cd %s && npm run build', $directory);

        $output->writeln(sprintf('Running <info>%s</info> command', $command));

        $process = new Process($command);
        $process->run();
        if (!$process->isSuccessful()) {
            throw new ProcessFailedException($process);
        }

        $output->write($process->getOutput());
    }
}
