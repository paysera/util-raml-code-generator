<?php

namespace Vendor\Test\TransferApiBundle\Entity;

use Paysera\Component\Serializer\Entity\Filter;

class TransfersFilter extends Filter
{
    private $createdDateFrom;
    private $createdDateTo;
    private $creditAccountNumber;
    private $debitAccountNumber;
    private $statuses;

    /**
     * @return \DateTime|null
     */
    public function getCreatedDateFrom()
    {
        return $this->createdDateFrom;
    }
    /**
     * @param \DateTimeInterface $createdDateFrom
     * @return $this
     */
    public function setCreatedDateFrom(\DateTimeInterface $createdDateFrom)
    {
        $this->createdDateFrom = $createdDateFrom;
        return $this;
    }
    /**
     * @return \DateTime|null
     */
    public function getCreatedDateTo()
    {
        return $this->createdDateTo;
    }
    /**
     * @param \DateTimeInterface $createdDateTo
     * @return $this
     */
    public function setCreatedDateTo(\DateTimeInterface $createdDateTo)
    {
        $this->createdDateTo = $createdDateTo;
        return $this;
    }
    /**
     * @return string|null
     */
    public function getCreditAccountNumber()
    {
        return $this->creditAccountNumber;
    }
    /**
     * @param string $creditAccountNumber
     * @return $this
     */
    public function setCreditAccountNumber($creditAccountNumber)
    {
        $this->creditAccountNumber = $creditAccountNumber;
        return $this;
    }
    /**
     * @return string|null
     */
    public function getDebitAccountNumber()
    {
        return $this->debitAccountNumber;
    }
    /**
     * @param string $debitAccountNumber
     * @return $this
     */
    public function setDebitAccountNumber($debitAccountNumber)
    {
        $this->debitAccountNumber = $debitAccountNumber;
        return $this;
    }
    /**
     * @return string[]
     */
    public function getStatuses()
    {
        return $this->statuses;
    }
    /**
     * @param string[] $statuses
     * @return $this
     */
    public function setStatuses(array $statuses)
    {
        $this->statuses = $statuses;
        return $this;
    }
}
