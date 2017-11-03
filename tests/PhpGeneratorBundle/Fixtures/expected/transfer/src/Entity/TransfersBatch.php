<?php

namespace Paysera\Test\TestClient\Entity;

use Paysera\Component\RestClientCommon\Entity\Entity;

class TransfersBatch extends Entity
{
    /**
     * @return string[]|null
     */
    public function getRevokedTransfers()
    {
        return $this->get('revoked_transfers');
    }
    /**
     * @param string[] $revokedTransfers
     * @return $this
     */
    public function setRevokedTransfers(array $revokedTransfers)
    {
        $this->set('revoked_transfers', $revokedTransfers);
        return $this;
    }
    /**
     * @return string[]|null
     */
    public function getReservedTransfers()
    {
        return $this->get('reserved_transfers');
    }
    /**
     * @param string[] $reservedTransfers
     * @return $this
     */
    public function setReservedTransfers(array $reservedTransfers)
    {
        $this->set('reserved_transfers', $reservedTransfers);
        return $this;
    }
    /**
     * @return ConvertCurrency[]
     */
    public function getConvertCurrency()
    {
        $items = $this->getByReference('convert_currency');
        if ($items === null) {
            return [];
        }

        $list = [];
        foreach($items as &$item) {
            $list[] = (new ConvertCurrency())->setDataByReference($item);
        }

        return $list;
    }
    /**
     * @param ConvertCurrency[] $convertCurrency
     * @return $this
     */
    public function setConvertCurrency(array $convertCurrency)
    {
        $data = [];
        foreach($convertCurrency as $item) {
            $data[] = $item->getDataByReference();
        }
        $this->setByReference('convert_currency', $data);
        return $this;
    }
}
