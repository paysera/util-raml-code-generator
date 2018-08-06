<?php
declare(strict_types=1);

namespace Paysera\Bundle\ClientReleaseBundle\Entity;

class PhpClientDefinition extends ClientDefinition
{
    private $namespace;

    public function getNamespace(): string
    {
        return $this->namespace;
    }

    public function setNamespace(string $namespace): self
    {
        $this->namespace = $namespace;
        return $this;
    }
}
