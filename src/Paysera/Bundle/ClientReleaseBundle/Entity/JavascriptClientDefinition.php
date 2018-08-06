<?php
declare(strict_types=1);

namespace Paysera\Bundle\ClientReleaseBundle\Entity;

class JavascriptClientDefinition extends ClientDefinition
{
    private $clientName;

    public function getClientName(): string
    {
        return $this->clientName;
    }

    public function setClientName(string $clientName): self
    {
        $this->clientName = $clientName;
        return $this;
    }
}
