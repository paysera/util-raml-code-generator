<?php

namespace Paysera\Bundle\ClientReleaseBundle\Entity;

class ReleaseStepData
{
    private $tempDir;
    private $sourceDir;
    private $generatedDir;

    private $apiConfig;
    private $clientDefinition;
    private $releaseData;

    public function getTempDir(): string
    {
        return $this->tempDir;
    }

    public function setTempDir(string $tempDir): self
    {
        $this->tempDir = $tempDir;
        return $this;
    }

    public function getSourceDir(): string
    {
        return $this->sourceDir;
    }

    public function setSourceDir(string $sourceDir): self
    {
        $this->sourceDir = $sourceDir;
        return $this;
    }

    public function getGeneratedDir(): string
    {
        return $this->generatedDir;
    }

    public function setGeneratedDir(string $generatedDir): self
    {
        $this->generatedDir = $generatedDir;
        return $this;
    }

    public function getApiConfig(): ApiConfig
    {
        return $this->apiConfig;
    }

    public function setApiConfig(ApiConfig $apiConfig): self
    {
        $this->apiConfig = $apiConfig;
        return $this;
    }

    public function getClientDefinition(): ClientDefinition
    {
        return $this->clientDefinition;
    }

    public function setClientDefinition(ClientDefinition $clientDefinition): self
    {
        $this->clientDefinition = $clientDefinition;
        return $this;
    }

    public function getReleaseData(): ReleaseData
    {
        return $this->releaseData;
    }

    public function setReleaseData(ReleaseData $releaseData): self
    {
        $this->releaseData = $releaseData;
        return $this;
    }
}
