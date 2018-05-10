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
    private $outputDir;
    private $vendorPrefix;
    private $filesystem;
    private $ramlDir;
    private $twigEnvironment;

    public function __construct(
        CodeGenerator $codeGenerator,
        Filesystem $filesystem,
        string $ramlDir,
        string $outputDir,
        string $vendorPrefix,
        Twig_Environment $twigEnvironment
    ) {
        parent::__construct();

        $this->codeGenerator = $codeGenerator;
        $this->filesystem = $filesystem;
        $this->ramlDir = $ramlDir;
        $this->outputDir = $outputDir;
        $this->vendorPrefix = $vendorPrefix;
        $this->twigEnvironment = $twigEnvironment;
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
        $this->twigEnvironment->addGlobal('language', self::LANGUAGE);

        $directory = $this->outputDir . DIRECTORY_SEPARATOR . $input->getArgument('api_name');
        if (!$this->filesystem->exists($directory)) {
            $this->filesystem->mkdir($directory);
        }

        $directory = realpath($directory);

        $this->codeGenerator->generateCode(
            self::LANGUAGE,
            $input->getArgument('api_name'),
            $input->getArgument('client_name'),
            $this->ramlDir,
            $this->outputDir
        );

        $output->writeln('');
        $output->writeln(sprintf('Code successfully generated to <info>%s</info> directory', $directory));

        if ($input->getOption('build-dependencies')) {
            $this->runNpmInstall($output, $directory);
            $this->runNpmBuild($output, $directory);
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
