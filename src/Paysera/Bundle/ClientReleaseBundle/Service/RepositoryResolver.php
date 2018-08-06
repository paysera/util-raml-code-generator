<?php
declare(strict_types=1);

namespace Paysera\Bundle\ClientReleaseBundle\Service;

class RepositoryResolver
{
    public function isMonoRepo(string $repository): bool
    {
        return $this->extractTargetPath($repository) !== null;
    }

    /**
     * @param string $repository
     * @return string|null
     */
    public function extractRepositoryUrl(string $repository)
    {
        if (preg_match('#(.+\.git)#', $repository, $matches) === 1) {
            return $matches[1];
        }

        return null;
    }

    /**
     * @param string $repository
     * @return string|null
     */
    public function extractTargetPath(string $repository)
    {
        if (preg_match('#\.git(.+)#', $repository, $matches) === 1) {
            return $matches[1];
        }

        return null;
    }
}
