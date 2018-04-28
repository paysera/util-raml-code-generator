<?php

namespace Paysera\Test\TestClient\Entity;

class UserLegal extends User
{
    public function __construct(array $data = [])
    {
        parent::__construct($data);
    }

    /**
     * @return string
     */
    public function getCompanyName()
    {
        return $this->get('company_name');
    }
    /**
     * @param string $companyName
     * @return $this
     */
    public function setCompanyName($companyName)
    {
        $this->set('company_name', $companyName);
        return $this;
    }
    /**
     * @return string
     */
    public function getCompanyCode()
    {
        return $this->get('company_code');
    }
    /**
     * @param string $companyCode
     * @return $this
     */
    public function setCompanyCode($companyCode)
    {
        $this->set('company_code', $companyCode);
        return $this;
    }
    /**
     * @return string|null
     */
    public function getVatCode()
    {
        return $this->get('vat_code');
    }
    /**
     * @param string $vatCode
     * @return $this
     */
    public function setVatCode($vatCode)
    {
        $this->set('vat_code', $vatCode);
        return $this;
    }
}
