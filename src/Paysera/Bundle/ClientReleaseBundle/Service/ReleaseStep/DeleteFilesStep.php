<?php

namespace Paysera\Bundle\ClientReleaseBundle\Service\ReleaseStep;

use Paysera\Bundle\ClientReleaseBundle\Entity\ReleaseStepData;
use Paysera\Bundle\ClientReleaseBundle\Exception\ReleaseCycleException;
use Symfony\Component\Console\Helper\QuestionHelper;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Question\ConfirmationQuestion;
use Symfony\Component\Filesystem\Filesystem;
use Symfony\Component\Finder\Finder;

class DeleteFilesStep implements ReleaseStepInterface
{
    private $filesystem;

    public function __construct(Filesystem $filesystem)
    {
        $this->filesystem = $filesystem;
    }

    public function processStep(ReleaseStepData $releaseStepData, InputInterface $input, OutputInterface $output)
    {
        $iterator = Finder::create()
            ->in($releaseStepData->getSourceDir())
            ->getIterator()
        ;

        $deletedFiles = [];
        foreach ($iterator as $sourceFile) {
            $generatedFilename = str_replace(
                $releaseStepData->getSourceDir(),
                $releaseStepData->getGeneratedDir(),
                $sourceFile->getPathname()
            );
            if (!($this->filesystem->exists($generatedFilename))) {
                $deletedFiles[] = $sourceFile;
            }
        }
        if (count($deletedFiles) === 0) {
            $output->writeln('<info>There are no old source files to be deleted.</info>');
            return;
        }

        $questionHelper = new QuestionHelper();
        $output->writeln('');
        $question = new ConfirmationQuestion(
            sprintf(
                '<info>Do you want to delete old source files (%d found)? (Y|n) </info>',
                count($deletedFiles)
            )
        );
        if (!$questionHelper->ask($input, $output, $question)) {
            return;
        }
        $output->writeln('');


        $output->writeln('<notice>Files to be deleted:</notice>');
        foreach ($deletedFiles as $deletedFile) {
            $output->writeln($deletedFile->getRelativePathname());
        }

        $output->writeln('');
        $question = new ConfirmationQuestion('<info>Do you accept? (Y|n) </info>');
        if (!$questionHelper->ask($input, $output, $question)) {
            throw new ReleaseCycleException('User did not accept file deletion.');
        }
        $output->writeln('');

        $this->filesystem->remove($deletedFiles);
    }
}
