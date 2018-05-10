<?php

namespace Paysera\Test\TestClient\Entity;

use Paysera\Component\RestClientCommon\Entity\Entity;

class TransferNotifications extends Entity
{
    public function __construct(array $data = [])
    {
        parent::__construct($data);
    }

    /**
     * @return TransferNotifcation|null
     */
    public function getDone()
    {
        if ($this->get('done') === null) {
            return null;
        }
        return (new TransferNotifcation())->setDataByReference($this->getByReference('done'));
    }
    /**
     * @param TransferNotifcation $done
     * @return $this
     */
    public function setDone(TransferNotifcation $done)
    {
        $this->setByReference('done', $done->getDataByReference());
        return $this;
    }
}
