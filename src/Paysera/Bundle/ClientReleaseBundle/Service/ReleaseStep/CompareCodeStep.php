<?php
declare(strict_types=1);

namespace Paysera\Bundle\ClientReleaseBundle\Service\ReleaseStep;

use Paysera\Bundle\ClientReleaseBundle\Entity\ReleaseStepData;
use Paysera\Bundle\ClientReleaseBundle\Exception\ReleaseCycleException;
use SebastianBergmann\Diff\Differ;
use SebastianBergmann\Diff\Output\DiffOnlyOutputBuilder;
use Symfony\Component\Console\Helper\QuestionHelper;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Question\ConfirmationQuestion;
use Symfony\Component\Finder\Finder;
use Symfony\Component\Finder\SplFileInfo;

class CompareCodeStep implements ReleaseStepInterface
{
    private $ignorePaths;

    public function __construct(array $ignorePaths)
    {
        $this->ignorePaths = $ignorePaths;
    }

    public function processStep(ReleaseStepData $releaseStepData, InputInterface $input, OutputInterface $output)
    {
        if ($releaseStepData->getReleaseData()->isQuiet()) {
            return;
        }
        $questionHelper = new QuestionHelper();
        $output->writeln('');
        $question = new ConfirmationQuestion('<info>Do you want to review changes between current and generated code? (Y|n) </info>');
        if (!$questionHelper->ask($input, $output, $question)) {
            return;
        }
        $output->writeln('');

        $diffHeader = "<notice>--- Original</notice>\n<info>+++ New</info>\n";
        $differ = new Differ(new DiffOnlyOutputBuilder($diffHeader));

        foreach ($this->buildChanges($releaseStepData) as $file => $changes) {
            $diff = $differ->diff($changes['original'], $changes['generated']);
            if ($diff === $diffHeader) {
                continue;
            }
            $output->write(sprintf('Changes in file <comment>%s</comment>: ', $file));
            if ($changes['original'] === '') {
                $output->writeln('<info>(this file will be added)</info>');
            }
            if ($changes['generated'] === '') {
                $output->writeln('<notice>(this file will be deleted)</notice>');
            }

            $output->writeln('');
            $formattedDiff = preg_replace(
                ['#(^\+[^\+].*$)#m', '#(^\-[^\-].*$)#m'],
                ['<info>${1}</info>', '<notice>${1}</notice>'],
                $diff
            );
            $output->writeln($formattedDiff);
            $output->writeln('');
        }

        $output->writeln('');
        $question = new ConfirmationQuestion('<info>Do you accept this diff? (Y|n) </info>');
        if (!$questionHelper->ask($input, $output, $question)) {
            throw new ReleaseCycleException('User did not accepted diff.');
        }
        $output->writeln('');
    }

    private function buildChanges(ReleaseStepData $releaseStepData)
    {
        $generated = $this->getAllFilesInDir($releaseStepData->getGeneratedDir());
        $source = $this->getAllFilesInDir($releaseStepData->getSourceDir());

        $removed = array_diff_key($source, $generated);
        $added = array_diff_key($generated, $source);

        $changes = [];
        foreach ($generated as $file => $content) {
            $data = [
                'generated' => $content,
                'original' => '',
            ];
            if (isset($source[$file])) {
                $data['original'] = $source[$file];
            }
            $changes[$file] = $data;
        }
        foreach ($removed as $file => $content) {
            $changes[$file] = [
                'generated' => '',
                'original' => $content,
            ];
        }
        foreach ($added as $file => $content) {
            $changes[$file] = [
                'generated' => $content,
                'original' => '',
            ];
        }

        return $changes;
    }

    private function getAllFilesInDir(string $directory)
    {
        $finder = new Finder();
        $finder
            ->files()
            ->in($directory)
            ->ignoreDotFiles(true)
            ->ignoreVCS(true)
        ;
        foreach ($this->ignorePaths as $path) {
            $finder->notPath($path);
        }

        $contents = [];
        /** @var SplFileInfo $file */
        foreach ($finder as $file) {
            $contents[$file->getRelativePathname()] = $file->getContents();
        }

        return $contents;
    }
}
