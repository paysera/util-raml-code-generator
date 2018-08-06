<?php
declare(strict_types=1);

namespace Paysera\Bundle\ClientReleaseBundle\Entity;

class ApiConfig
{
    private $ramlFile;
    private $apiName;
    private $clients;

    public function __construct()
    {
        $this->clients = [];
    }

    public function getRamlFile(): string
    {
        return $this->ramlFile;
    }

    public function setRamlFile(string $ramlFile): self
    {
        $this->ramlFile = $ramlFile;
        return $this;
    }

    public function getApiName(): string
    {
        return $this->apiName;
    }

    public function setApiName(string $apiName): self
    {
        $this->apiName = $apiName;
        return $this;
    }

    /**
     * @return ClientDefinition[]
     */
    public function getClients(): array
    {
        return $this->clients;
    }

    /**
     * @param ClientDefinition[] $clients
     *
     * @return $this
     */
    public function setClients(array $clients): self
    {
        $this->clients = $clients;
        return $this;
    }

    public function addClient(string $type, ClientDefinition $client): self
    {
        $this->clients[$type] = $client;
        return $this;
    }
}
