<?php
declare(strict_types=1);

namespace Paysera\Bundle\PharBundle\Service;

class ChangelogParser
{
    private $pharName;

    public function __construct(string $pharName)
    {
        $this->pharName = $pharName;
    }

    public function getParsedChangelog()
    {
        $contents = file_get_contents(sprintf('phar://%s/CHANGELOG.md', $this->pharName));
        if ($contents === false) {
            return null;
        }

        $contents = preg_replace('/(^#+.+$)/m', '<info>$1</info>', $contents);
        $contents = preg_replace('/(`.*?`)/', '<comment>$1</comment>', $contents);

        return $contents;
    }
}
