<?php

namespace Paysera\Bundle\PhpGeneratorBundle\Command;

use Paysera\Bundle\CodeGeneratorBundle\Service\CodeGenerator;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;
use Twig_Environment;

class GenerateRestClientCommand extends Command
{
    const CODE_TYPE = 'php_client';

    private $codeGenerator;
    private $twigEnvironment;

    public function __construct(
        CodeGenerator $codeGenerator,
        Twig_Environment $twigEnvironment
    ) {
        parent::__construct();

        $this->codeGenerator = $codeGenerator;
        $this->twigEnvironment = $twigEnvironment;
    }

    protected function configure()
    {
        parent::configure();

        $this
            ->setName('php-generator:rest-client')
            ->setDescription('Generates RESTful Php Client from given RAML definition')
            ->addArgument('raml_file', InputArgument::REQUIRED, 'Full path to RAML file')
            ->addArgument('output_dir', InputArgument::REQUIRED, 'Where to put generated code')
            ->addArgument('namespace', InputArgument::REQUIRED, 'Namespace of generated library, i.e.: Acme\\\\Client\\\\AcmeClient')
            ->addOption('library_name', null, InputOption::VALUE_OPTIONAL, 'Optional library name in composer.json')
        ;
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $this->twigEnvironment->addGlobal('code_type', self::CODE_TYPE);

        $namespaceParts = explode('\\', $input->getArgument('namespace'));
        $outputDir = $input->getArgument('output_dir');

        $options = [];
        if ($input->getOption('library_name') !== null) {
            $options['library_name'] = $input->getOption('library_name');
        }

        $this->codeGenerator->generateCode(
            self::CODE_TYPE,
            end($namespaceParts),
            $input->getArgument('namespace'),
            $input->getArgument('raml_file'),
            $outputDir,
            $options
        );

        $output->writeln('');
        $output->writeln(sprintf(
            '<info>Code successfully generated to <comment>%s</comment> directory</info>',
            $outputDir
        ));
        $output->writeln('');
    }
}
