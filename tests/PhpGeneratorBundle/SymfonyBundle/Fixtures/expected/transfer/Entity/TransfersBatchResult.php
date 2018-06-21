<?php

namespace Vendor\Test\TransferApiBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;

class TransfersBatchResult
{
    private $id;
    private $revokedTransfers;
    private $reservedTransfers;

    public function __construct()
    {
        
        $this->revokedTransfers = new ArrayCollection();    
        $this->reservedTransfers = new ArrayCollection();
    }

    /**
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }
    /**
     * @return TransferOutput[]|ArrayCollection
     */
    public function getRevokedTransfers()
    {
        return $this->revokedTransfers;
    }
        /**
     * @param TransferOutput[] $revokedTransfers
     * @return $this
     */
    public function setRevokedTransfers(array $revokedTransfers)
    {
        foreach($this->revokedTransfers as $item) {
            $this->removeRevokedTransfer($item);
        }
        foreach($revokedTransfers as $item) {
            $this->addRevokedTransfer($item);
        }
        return $this;
    }
    /**
     * @param TransferOutput $revokedTransfer
     * @return $this
     */
    public function addRevokedTransfer($revokedTransfer)
    {
        if(!$this->revokedTransfers->contains($revokedTransfer)) {
            $this->revokedTransfers->add($revokedTransfer);
        }
        return $this;
    }
    /**
     * @param TransferOutput $revokedTransfer
     * @return $this
     */
    public function removeRevokedTransfer($revokedTransfer)
    {
        $this->revokedTransfers->removeElement($revokedTransfer);
        return $this;
    }
        /**
     * @return TransferOutput[]|ArrayCollection
     */
    public function getReservedTransfers()
    {
        return $this->reservedTransfers;
    }
        /**
     * @param TransferOutput[] $reservedTransfers
     * @return $this
     */
    public function setReservedTransfers(array $reservedTransfers)
    {
        foreach($this->reservedTransfers as $item) {
            $this->removeReservedTransfer($item);
        }
        foreach($reservedTransfers as $item) {
            $this->addReservedTransfer($item);
        }
        return $this;
    }
    /**
     * @param TransferOutput $reservedTransfer
     * @return $this
     */
    public function addReservedTransfer($reservedTransfer)
    {
        if(!$this->reservedTransfers->contains($reservedTransfer)) {
            $this->reservedTransfers->add($reservedTransfer);
        }
        return $this;
    }
    /**
     * @param TransferOutput $reservedTransfer
     * @return $this
     */
    public function removeReservedTransfer($reservedTransfer)
    {
        $this->reservedTransfers->removeElement($reservedTransfer);
        return $this;
    }
    
}
