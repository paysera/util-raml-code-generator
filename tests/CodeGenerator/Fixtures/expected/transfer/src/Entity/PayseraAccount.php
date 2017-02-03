<?php

namespace Paysera\Test\TestClient\Entity;

use Paysera\Component\RestClientCommon\Entity\Entity;

class PayseraAccount extends Entity
{
    /**
     * @return string|null
     */
    public function getAccountNumber()
    {
        return $this->get('account_number');
    }
    /**
     * @param string $accountNumber
     * @return $this
     */
    public function setAccountNumber($accountNumber)
    {
        $this->set('account_number', $accountNumber);
        return $this;
    }
    /**
     * @return string|null
     */
    public function getEmail()
    {
        return $this->get('email');
    }
    /**
     * @param string $email
     * @return $this
     */
    public function setEmail($email)
    {
        $this->set('email', $email);
        return $this;
    }
    /**
     * @return string|null
     */
    public function getPhone()
    {
        return $this->get('phone');
    }
    /**
     * @param string $phone
     * @return $this
     */
    public function setPhone($phone)
    {
        $this->set('phone', $phone);
        return $this;
    }
}
