<?php

namespace Paysera\Test\TestClient\Entity;

use Paysera\Component\RestClientCommon\Entity\Entity;

class Payer extends Entity
{
    public function __construct(array $data = [])
    {
        parent::__construct($data);
    }

    /**
     * @return string
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
    public function getReference()
    {
        return $this->get('reference');
    }
    /**
     * @param string $reference
     * @return $this
     */
    public function setReference($reference)
    {
        $this->set('reference', $reference);
        return $this;
    }
}
