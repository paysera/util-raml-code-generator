<?php

namespace Paysera\Bundle\PhpGeneratorBundle\Command;

use Paysera\Bundle\CodeGeneratorBundle\Service\CodeGenerator;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class GenerateRestClientCommand extends Command
{
    const LANGUAGE = 'php';

    private $codeGenerator;
    private $ramlDir;
    private $outputDir;

    public function __construct(
        CodeGenerator $codeGenerator,
        string $ramlDir,
        string $outputDir
    ) {
        parent::__construct();

        $this->codeGenerator = $codeGenerator;
        $this->ramlDir = $ramlDir;
        $this->outputDir = $outputDir;
    }

    protected function configure()
    {
        parent::configure();

        $this
            ->setName('paysera:php-generator:rest-client')
            ->setDescription('Generates RESTful Php Client from given RAML definition')
            ->addArgument('api_name', InputArgument::REQUIRED, 'The name of API definition to look for')
            ->addArgument('namespace', InputArgument::REQUIRED, 'Namespace of generated library')
            ->setHelp('You must provide the API name and its namespace (with escaped slashes, i.e. Acme\\Client\\AcmeClient)')
        ;
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $this->codeGenerator->generateCode(
            self::LANGUAGE,
            $input->getArgument('api_name'),
            $input->getArgument('namespace'),
            $this->ramlDir,
            $this->outputDir
        );

        $output->writeln('');
        $output->writeln(sprintf(
            '<info>Code successfully generated to "%s%s%s" directory</info>',
            $this->outputDir,
            DIRECTORY_SEPARATOR,
            $input->getArgument('api_name')
        ));
        $output->writeln('');
    }
}
