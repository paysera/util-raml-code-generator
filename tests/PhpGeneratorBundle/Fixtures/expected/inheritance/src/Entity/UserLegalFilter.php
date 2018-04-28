<?php

namespace Paysera\Test\TestClient\Entity;

class UserLegalFilter extends UserFilter
{
    /**
     * @return string|null
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
}
