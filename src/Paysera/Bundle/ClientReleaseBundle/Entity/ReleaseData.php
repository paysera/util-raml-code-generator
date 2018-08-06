<?php
declare(strict_types=1);

namespace Paysera\Bundle\ClientReleaseBundle\Entity;

use Paysera\Component\ChangelogParser\Entity\ChangeEntry;

class ReleaseData
{
    private $version;
    private $commitMessage;
    private $changeEntries;
    private $quiet;

    public function __construct()
    {
        $this->changeEntries = [];
    }

    public function getVersion(): string
    {
        return $this->version;
    }

    public function setVersion(string $version): self
    {
        $this->version = $version;
        return $this;
    }

    public function getCommitMessage(): string
    {
        return $this->commitMessage;
    }

    public function setCommitMessage(string $commitMessage): self
    {
        $this->commitMessage = $commitMessage;
        return $this;
    }

    /**
     * @return ChangeEntry[]
     */
    public function getChangeEntries()
    {
        return $this->changeEntries;
    }

    /**
     * @param ChangeEntry[] $changeEntries
     * @return $this
     */
    public function setChangeEntries($changeEntries): self
    {
        $this->changeEntries = $changeEntries;
        return $this;
    }

    public function isQuiet(): bool
    {
        return $this->quiet;
    }

    public function setQuiet(bool $quiet): self
    {
        $this->quiet = $quiet;
        return $this;
    }
}
