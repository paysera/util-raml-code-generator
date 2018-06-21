<?php

namespace Vendor\Test\TransferApiBundle\Entity;

class TransferNotifications
{
    private $id;
    private $done;

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
     * @return TransferNotifcation|null
     */
    public function getDone()
    {
        return $this->done;
    }
    /**
     * @param TransferNotifcation $done
     * @return $this
     */
    public function setDone(TransferNotifcation $done)
    {
        $this->done = $done;
        return $this;
    }

}
