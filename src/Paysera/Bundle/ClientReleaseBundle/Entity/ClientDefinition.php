<?php
declare(strict_types=1);

namespace Paysera\Bundle\ClientReleaseBundle\Entity;

class ClientDefinition
{
    private $repository;
    private $libraryName;
    private $clientType;

    public function getRepository(): string
    {
        return $this->repository;
    }

    public function setRepository(string $repository): self
    {
        $this->repository = $repository;
        return $this;
    }

    public function getLibraryName(): string
    {
        return $this->libraryName;
    }

    public function setLibraryName(string $libraryName): self
    {
        $this->libraryName = $libraryName;
        return $this;
    }

    public function getClientType(): string
    {
        return $this->clientType;
    }

    public function setClientType(string $clientType): self
    {
        $this->clientType = $clientType;
        return $this;
    }
}
