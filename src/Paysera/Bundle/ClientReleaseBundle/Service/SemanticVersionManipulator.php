<?php

namespace Paysera\Bundle\ClientReleaseBundle\Service;

class SemanticVersionManipulator
{
    const VERSION_MAJOR = 'major';
    const VERSION_MINOR = 'minor';
    const VERSION_PATCH = 'patch';

    public function increase(string $current, string $constraint)
    {
        if (preg_match('#(\d+)\.(\d+)\.(\d+)#', $current, $matches) !== 1) {
            return null;
        }

        switch ($constraint) {
            case self::VERSION_MAJOR:
                return sprintf('%d.%d.%d', ++$matches[1], 0, 0);
            case self::VERSION_MINOR:
                return sprintf('%d.%d.%d', $matches[1], ++$matches[2], 0);
            case self::VERSION_PATCH:
                return sprintf('%d.%d.%d', $matches[1], $matches[2], ++$matches[3]);
            default:
                return null;
        }
    }
}
