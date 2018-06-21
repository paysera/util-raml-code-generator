<?php

namespace Paysera\Bundle\PhpGeneratorBundle\Command;

use Paysera\Bundle\CodeGeneratorBundle\Service\CodeGenerator;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
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
            ->setHelp('You must provide the API name and its namespace')
        ;
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $this->twigEnvironment->addGlobal('code_type', self::CODE_TYPE);

        $namespaceParts = explode('\\', $input->getArgument('namespace'));
        $outputDir = $input->getArgument('output_dir');

        $this->codeGenerator->generateCode(
            self::CODE_TYPE,
            end($namespaceParts),
            $input->getArgument('namespace'),
            $input->getArgument('raml_file'),
            $outputDir
        );

        $output->writeln('');
        $output->writeln(sprintf(
            '<info>Code successfully generated to <comment>%s</comment> directory</info>',
            $outputDir
        ));
        $output->writeln('');
    }
}
