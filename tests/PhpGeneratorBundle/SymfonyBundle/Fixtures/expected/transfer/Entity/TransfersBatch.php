<?php

namespace Vendor\Test\TransferApiBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;

class TransfersBatch
{
    private $id;
    private $revokedTransfers;
    private $reservedTransfers;
    private $convertCurrency;

    public function __construct()
    {
        
        $this->revokedTransfers = [];    
        $this->reservedTransfers = [];    
        $this->convertCurrency = new ArrayCollection();
    }

    /**
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }
    /**
     * @return string[]
     */
    public function getRevokedTransfers()
    {
        return $this->revokedTransfers;
    }
    /**
     * @param string[] $revokedTransfers
     * @return $this
     */
    public function setRevokedTransfers(array $revokedTransfers)
    {
        $this->revokedTransfers = $revokedTransfers;
        return $this;
    }
    /**
     * @return string[]
     */
    public function getReservedTransfers()
    {
        return $this->reservedTransfers;
    }
    /**
     * @param string[] $reservedTransfers
     * @return $this
     */
    public function setReservedTransfers(array $reservedTransfers)
    {
        $this->reservedTransfers = $reservedTransfers;
        return $this;
    }
    /**
     * @return ConvertCurrency[]|ArrayCollection
     */
    public function getConvertCurrency()
    {
        return $this->convertCurrency;
    }
        /**
     * @param ConvertCurrency[] $convertCurrency
     * @return $this
     */
    public function setConvertCurrency(array $convertCurrency)
    {
        foreach($this->convertCurrency as $item) {
            $this->removeConvertCurrency($item);
        }
        foreach($convertCurrency as $item) {
            $this->addConvertCurrency($item);
        }
        return $this;
    }
    /**
     * @param ConvertCurrency $convertCurrency
     * @return $this
     */
    public function addConvertCurrency($convertCurrency)
    {
        if(!$this->convertCurrency->contains($convertCurrency)) {
            $this->convertCurrency->add($convertCurrency);
        }
        return $this;
    }
    /**
     * @param ConvertCurrency $convertCurrency
     * @return $this
     */
    public function removeConvertCurrency($convertCurrency)
    {
        $this->convertCurrency->removeElement($convertCurrency);
        return $this;
    }
    
}
