<?php

namespace Vendor\Test\TransferApiBundle\Entity;

class Payer
{
    private $id;
    private $accountNumber;
    private $reference;

    public function __construct()
    {
            
    }

    /**
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }
    /**
     * @return string
     */
    public function getAccountNumber()
    {
        return $this->accountNumber;
    }
    /**
     * @param string $accountNumber
     * @return $this
     */
    public function setAccountNumber($accountNumber)
    {
        $this->accountNumber = $accountNumber;
        return $this;
    }
    /**
     * @return string|null
     */
    public function getReference()
    {
        return $this->reference;
    }
    /**
     * @param string $reference
     * @return $this
     */
    public function setReference($reference)
    {
        $this->reference = $reference;
        return $this;
    }

}
