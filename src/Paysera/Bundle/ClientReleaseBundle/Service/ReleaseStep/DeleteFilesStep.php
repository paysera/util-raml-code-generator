<?php

namespace Paysera\Bundle\ClientReleaseBundle\Service\ReleaseStep;

use Paysera\Bundle\ClientReleaseBundle\Entity\ReleaseStepData;
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

        $filesToDelete = [];
        foreach ($iterator as $sourceFile) {
            $generatedFilename = str_replace(
                $releaseStepData->getSourceDir(),
                $releaseStepData->getGeneratedDir(),
                $sourceFile->getPathname()
            );
            if (!($this->filesystem->exists($generatedFilename))) {
                $filesToDelete[] = $sourceFile;
            }
        }
        $output->writeln('');
        if (count($filesToDelete) === 0) {
            $output->writeln('<info>There are no old source files to be deleted.</info>');

            return;
        }

        $output->writeln('<notice>Files to be deleted:</notice>');
        foreach ($filesToDelete as $fileToDelete) {
            $output->writeln($fileToDelete->getRelativePathname());
        }

        $questionHelper = new QuestionHelper();
        $question = new ConfirmationQuestion(
            sprintf(
                '<info>Do you want to delete these old source files (%d found)? (Y|n) </info>',
                count($filesToDelete)
            )
        );
        if (!$questionHelper->ask($input, $output, $question)) {
            return;
        }
        $output->writeln('');

        $this->filesystem->remove($filesToDelete);
    }
}
