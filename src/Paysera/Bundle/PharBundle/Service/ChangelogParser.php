<?php
declare(strict_types=1);

namespace Paysera\Bundle\PharBundle\Service;

class ChangelogParser
{
    private $packageName;
    private $version;

    public function __construct(
        string $packageName,
        string $version
    ) {
        $this->packageName = $packageName;
        $this->version = $version;
    }

    public function getParsedChangelog()
    {
        $contents = file_get_contents(sprintf(
            'https://raw.githubusercontent.com/%s/%s/CHANGELOG.md',
            $this->packageName,
            $this->version
        ));
        if ($contents === false) {
            return null;
        }

        $contents = preg_replace('/(^#+.+$)/m', '<info>$1</info>', $contents);
        $contents = preg_replace('/(`.*?`)/', '<comment>$1</comment>', $contents);

        return $contents;
    }
}
