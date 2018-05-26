<?php

namespace Paysera\Test\TransferClient\Entity;

use Paysera\Component\RestClientCommon\Entity\Entity;

class TransferRegistrationParameters extends Entity
{
    public function __construct(array $data = [])
    {
        parent::__construct($data);
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
