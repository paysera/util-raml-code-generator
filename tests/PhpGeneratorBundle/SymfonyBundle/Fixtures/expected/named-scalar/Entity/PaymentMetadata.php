<?php

namespace Vendor\Test\NamedScalarApiBundle\Entity;

class PaymentMetadata
{
    private $id;
    private $source;
    private $channel;

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
     * @return string
     */
    public function getSource()
    {
        return $this->source;
    }
    /**
     * @param string $source
     * @return $this
     */
    public function setSource($source)
    {
        $this->source = $source;
        return $this;
    }
    /**
     * @return string|null
     */
    public function getChannel()
    {
        return $this->channel;
    }
    /**
     * @param string $channel
     * @return $this
     */
    public function setChannel($channel)
    {
        $this->channel = $channel;
        return $this;
    }

}
