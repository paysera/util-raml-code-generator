<?php

declare(strict_types=1);

namespace Paysera\Bundle\ClientReleaseBundle\Service;

use Symfony\Component\Process\Exception\RuntimeException;
use Symfony\Component\Process\ExecutableFinder;

class BinaryPathResolver
{
    private $additionalLookupDirectories;

    public function __construct(array $additionalLookupDirectories)
    {
        $this->additionalLookupDirectories = $additionalLookupDirectories;
    }

    public function getPath(array $possibleBinaryNames): string
    {
        foreach ($possibleBinaryNames as $binary) {
            $path = (new ExecutableFinder())
                ->find($binary, null, $this->additionalLookupDirectories)
            ;

            if ($path !== null) {
                return $path;
            }
        }

        throw new RuntimeException(
            sprintf(
                'Failed to find any of %s phar binary',
                implode(',', $possibleBinaryNames)
            )
        );
    }
}
