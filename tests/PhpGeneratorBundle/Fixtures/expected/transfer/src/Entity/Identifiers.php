<?php

namespace Paysera\Test\TestClient\Entity;

use Paysera\Component\RestClientCommon\Entity\Entity;

class Identifiers extends Entity
{
    public function __construct(array $data = [])
    {
        parent::__construct($data);
    }

    /**
     * @return string|null
     */
    public function getGeneral()
    {
        return $this->get('general');
    }
    /**
     * @param string $general
     * @return $this
     */
    public function setGeneral($general)
    {
        $this->set('general', $general);
        return $this;
    }
    /**
     * @return string|null
     */
    public function getPersonalCode()
    {
        return $this->get('personal_code');
    }
    /**
     * @param string $personalCode
     * @return $this
     */
    public function setPersonalCode($personalCode)
    {
        $this->set('personal_code', $personalCode);
        return $this;
    }
    /**
     * @return string|null
     */
    public function getLegalCode()
    {
        return $this->get('legal_code');
    }
    /**
     * @param string $legalCode
     * @return $this
     */
    public function setLegalCode($legalCode)
    {
        $this->set('legal_code', $legalCode);
        return $this;
    }
    /**
     * @return string|null
     */
    public function getTaxCode()
    {
        return $this->get('tax_code');
    }
    /**
     * @param string $taxCode
     * @return $this
     */
    public function setTaxCode($taxCode)
    {
        $this->set('tax_code', $taxCode);
        return $this;
    }
    /**
     * @return string|null
     */
    public function getKppCode()
    {
        return $this->get('kpp_code');
    }
    /**
     * @param string $kppCode
     * @return $this
     */
    public function setKppCode($kppCode)
    {
        $this->set('kpp_code', $kppCode);
        return $this;
    }
}
