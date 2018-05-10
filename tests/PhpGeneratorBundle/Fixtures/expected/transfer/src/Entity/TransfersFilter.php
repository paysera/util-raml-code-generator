<?php

namespace Paysera\Test\TestClient\Entity;

use Paysera\Component\RestClientCommon\Entity\Entity;

class TransfersFilter extends Entity
{
    /**
     * @return \DateTimeImmutable|null
     */
    public function getCreatedDateFrom()
    {
        if ($this->get('created_date_from') === null) {
            return null;
        }
        return (new \DateTimeImmutable())->setTimestamp($this->get('created_date_from'));
    }
    /**
     * @param \DateTimeInterface $createdDateFrom
     * @return $this
     */
    public function setCreatedDateFrom(\DateTimeInterface $createdDateFrom)
    {
        $this->set('created_date_from', $createdDateFrom->getTimestamp());
        return $this;
    }
    /**
     * @return \DateTimeImmutable|null
     */
    public function getCreatedDateTo()
    {
        if ($this->get('created_date_to') === null) {
            return null;
        }
        return (new \DateTimeImmutable())->setTimestamp($this->get('created_date_to'));
    }
    /**
     * @param \DateTimeInterface $createdDateTo
     * @return $this
     */
    public function setCreatedDateTo(\DateTimeInterface $createdDateTo)
    {
        $this->set('created_date_to', $createdDateTo->getTimestamp());
        return $this;
    }
    /**
     * @return string|null
     */
    public function getCreditAccountNumber()
    {
        return $this->get('credit_account_number');
    }
    /**
     * @param string $creditAccountNumber
     * @return $this
     */
    public function setCreditAccountNumber($creditAccountNumber)
    {
        $this->set('credit_account_number', $creditAccountNumber);
        return $this;
    }
    /**
     * @return string|null
     */
    public function getDebitAccountNumber()
    {
        return $this->get('debit_account_number');
    }
    /**
     * @param string $debitAccountNumber
     * @return $this
     */
    public function setDebitAccountNumber($debitAccountNumber)
    {
        $this->set('debit_account_number', $debitAccountNumber);
        return $this;
    }
    /**
     * @return string|null
     */
    public function getStatuses()
    {
        return $this->get('statuses');
    }
    /**
     * @param string $statuses
     * @return $this
     */
    public function setStatuses($statuses)
    {
        $this->set('statuses', $statuses);
        return $this;
    }
}
