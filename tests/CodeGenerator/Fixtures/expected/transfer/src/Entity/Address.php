<?php

namespace Paysera\Test\TestClient\Entity;

use Paysera\Component\RestClientCommon\Entity\Entity;

class Address extends Entity
{
    /**
     * @return string|null
     */
    public function getCountryCode()
    {
        return $this->get('country_code');
    }
    /**
     * @param string $countryCode
     * @return $this
     */
    public function setCountryCode($countryCode)
    {
        $this->set('country_code', $countryCode);
        return $this;
    }
    /**
     * @return string|null
     */
    public function getAddressLine()
    {
        return $this->get('address_line');
    }
    /**
     * @param string $addressLine
     * @return $this
     */
    public function setAddressLine($addressLine)
    {
        $this->set('address_line', $addressLine);
        return $this;
    }
}
