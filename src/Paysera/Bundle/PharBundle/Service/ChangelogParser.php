<?php
declare(strict_types=1);

namespace Paysera\Bundle\PharBundle\Service;

class ChangelogParser
{
    private $packageName;

    public function __construct(
        string $packageName
    ) {
        $this->packageName = $packageName;
    }

    public function getParsedChangelog(string $version)
    {
        $contents = file_get_contents(sprintf(
            'https://raw.githubusercontent.com/%s/%s/CHANGELOG.md',
            $this->packageName,
            $version
        ));
        if ($contents === false) {
            return null;
        }

        $contents = preg_replace('/(^#+.+$)/m', '<info>$1</info>', $contents);
        $contents = preg_replace('/(`.*?`)/', '<comment>$1</comment>', $contents);

        return $contents;
    }
}
