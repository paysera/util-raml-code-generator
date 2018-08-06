<?php

namespace Paysera\Bundle\ClientReleaseBundle\Entity;

class ApiConfigList
{
    private $items;

    public function __construct()
    {
        $this->items = [];
    }

    /**
     * @return ApiConfig[]
     */
    public function getItems(): array
    {
        return $this->items;
    }

    public function addItem(string $name, ApiConfig $item): self
    {
        $this->items[$name] = $item;
        return $this;
    }
}
