<?php

namespace Vendor\Test\TransferApiBundle\Entity;

class PayseraAccount
{
    private $id;
    private $accountNumber;
    private $email;
    private $phone;

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
     * @return string|null
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
    public function getEmail()
    {
        return $this->email;
    }
    /**
     * @param string $email
     * @return $this
     */
    public function setEmail($email)
    {
        $this->email = $email;
        return $this;
    }
    /**
     * @return string|null
     */
    public function getPhone()
    {
        return $this->phone;
    }
    /**
     * @param string $phone
     * @return $this
     */
    public function setPhone($phone)
    {
        $this->phone = $phone;
        return $this;
    }

}
