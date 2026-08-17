<?php

namespace Paysera\Test\NamedScalarClient\Entity;

use Paysera\Component\RestClientCommon\Entity\Entity;

class PaymentMetadata extends Entity
{
    public function __construct(array $data = [])
    {
        parent::__construct($data);
    }

    /**
     * @return string
     */
    public function getSource()
    {
        return $this->get('source');
    }
    /**
     * @param string $source
     * @return $this
     */
    public function setSource($source)
    {
        $this->set('source', $source);
        return $this;
    }
    /**
     * @return string|null
     */
    public function getChannel()
    {
        return $this->get('channel');
    }
    /**
     * @param string $channel
     * @return $this
     */
    public function setChannel($channel)
    {
        $this->set('channel', $channel);
        return $this;
    }
}
