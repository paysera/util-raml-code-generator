<?php

namespace Paysera\Test\TestClient\Entity;

use Paysera\Component\RestClientCommon\Entity\Entity;

class TransfersBatchResult extends Entity
{
    public function __construct(array $data = [])
    {
        parent::__construct($data);
    }

    /**
     * @return TransferOutput[]
     */
    public function getRevokedTransfers()
    {
        $items = $this->getByReference('revoked_transfers');
        if ($items === null) {
            return [];
        }

        $list = [];
        foreach($items as &$item) {
            $list[] = (new TransferOutput())->setDataByReference($item);
        }

        return $list;
    }
    /**
     * @param TransferOutput[] $revokedTransfers
     * @return $this
     */
    public function setRevokedTransfers(array $revokedTransfers)
    {
        $data = [];
        foreach($revokedTransfers as $item) {
            $data[] = $item->getDataByReference();
        }
        $this->setByReference('revoked_transfers', $data);
        return $this;
    }
    /**
     * @return TransferOutput[]
     */
    public function getReservedTransfers()
    {
        $items = $this->getByReference('reserved_transfers');
        if ($items === null) {
            return [];
        }

        $list = [];
        foreach($items as &$item) {
            $list[] = (new TransferOutput())->setDataByReference($item);
        }

        return $list;
    }
    /**
     * @param TransferOutput[] $reservedTransfers
     * @return $this
     */
    public function setReservedTransfers(array $reservedTransfers)
    {
        $data = [];
        foreach($reservedTransfers as $item) {
            $data[] = $item->getDataByReference();
        }
        $this->setByReference('reserved_transfers', $data);
        return $this;
    }
}
