<?php
declare(strict_types=1);

namespace Paysera\Bundle\JavascriptGeneratorBundle\Command;

use Doctrine\Common\Inflector\Inflector;
use Paysera\Bundle\CodeGeneratorBundle\Service\CodeGenerator;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Filesystem\Filesystem;
use Twig_Environment;

class GeneratePackageCommand extends Command
{
    const CODE_TYPE = 'js_package';

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
            ->addOption('library_name', null, InputOption::VALUE_OPTIONAL, 'Optional package name in package.json')
        ;
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $this->twigEnvironment->addGlobal('code_type', self::CODE_TYPE);

        $outputDir = $input->getArgument('output_dir');
        $options = [];

        if ($input->getOption('library_name') !== null) {
            $options['library_name'] = $input->getOption('library_name');
        }

        $this->codeGenerator->generateCode(
            self::CODE_TYPE,
            $input->getArgument('client_name'),
            $input->getArgument('client_name'),
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
