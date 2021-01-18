<?php
declare(strict_types=1);

namespace Paysera\Bundle\ClientReleaseBundle\Entity;

use Paysera\Bundle\ClientReleaseBundle\Service\VersionResolver\VersionResolverInterface;

class ClientDefinition
{
    private $repository;
    private $libraryName;
    private $clientType;
    private $versionResolver;

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

    public function getVersionResolver(): VersionResolverInterface
    {
        return $this->versionResolver;
    }

    public function setVersionResolver(VersionResolverInterface $versionResolver): self
    {
        $this->versionResolver = $versionResolver;
        return $this;
    }
}
