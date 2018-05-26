<?php
declare(strict_types=1);

namespace Paysera\Bundle\JavascriptGeneratorBundle\Command;

use Symfony\Component\Process\Exception\ProcessFailedException;
use Paysera\Bundle\CodeGeneratorBundle\Service\CodeGenerator;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Filesystem\Filesystem;
use Symfony\Component\Process\Process;
use Twig_Environment;

class GeneratePackageCommand extends Command
{
    const LANGUAGE = 'js';

    private $codeGenerator;
    private $vendorPrefix;
    private $filesystem;
    private $twigEnvironment;

    public function __construct(
        CodeGenerator $codeGenerator,
        Filesystem $filesystem,
        string $vendorPrefix,
        Twig_Environment $twigEnvironment
    ) {
        parent::__construct();

        $this->codeGenerator = $codeGenerator;
        $this->filesystem = $filesystem;
        $this->vendorPrefix = $vendorPrefix;
        $this->twigEnvironment = $twigEnvironment;
    }

    protected function configure()
    {
        parent::configure();

        $this
            ->setName('js-generator:package')
            ->setDescription('Generates Javascript package with Client from given RAML definition')
            ->addArgument('raml_file', InputArgument::REQUIRED, 'Full path to RAML file')
            ->addArgument('output_dir', InputArgument::REQUIRED, 'Where to put generated code')
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
        $this->twigEnvironment->addGlobal('language', self::LANGUAGE);

        $outputDir = $input->getArgument('output_dir');

        $this->codeGenerator->generateCode(
            self::LANGUAGE,
            $input->getArgument('client_name'),
            $input->getArgument('client_name'),
            $input->getArgument('raml_file'),
            $outputDir
        );

        $output->writeln('');
        $output->writeln(sprintf(
            '<info>Code successfully generated to <comment>%s</comment> directory</info>',
            $outputDir
        ));

        if ($input->getOption('build-dependencies')) {
            $this->runNpmInstall($output, $outputDir);
            $this->runNpmBuild($output, $outputDir);
        }

        $output->writeln('');
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
