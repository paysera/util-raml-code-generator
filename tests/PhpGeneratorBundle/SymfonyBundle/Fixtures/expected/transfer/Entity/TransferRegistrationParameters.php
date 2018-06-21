<?php

namespace Vendor\Test\TransferApiBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;

class TransferRegistrationParameters
{
    private $id;
    private $convertCurrency;

    public function __construct()
    {
        
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
