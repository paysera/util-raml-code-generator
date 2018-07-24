<?php

namespace Paysera\Component\Console;

use Symfony\Bundle\FrameworkBundle\Console\Application as BaseApplication;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputDefinition;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\HttpKernel\KernelInterface;

class Application extends BaseApplication
{
    public function __construct(KernelInterface $kernel)
    {
        parent::__construct($kernel);

        $this->setName('raml-code-generator');
        $this->setVersion('@package_version@');

        $this->setDefinition(
            new InputDefinition(array(
                new InputArgument('command', InputArgument::REQUIRED, 'The command to execute'),

                new InputOption('--help', '-h', InputOption::VALUE_NONE, 'Display this help message'),
                new InputOption('--version', '-V', InputOption::VALUE_NONE, 'Display this application version'),
            ))
        );
    }

    public function getLongVersion()
    {
        return sprintf('%s <info>%s</info>', $this->getName(), $this->getVersion());
    }


    public function add(Command $command)
    {
        if (in_array(
            $command->getName(),
            [
                'list',
                'help',

                'selfupdate',

                'js-generator:package',
                'php-generator:rest-client',
                'php-generator:symfony-bundle',
            ],
            true
        )) {
            parent::add($command);
        };
    }
}
