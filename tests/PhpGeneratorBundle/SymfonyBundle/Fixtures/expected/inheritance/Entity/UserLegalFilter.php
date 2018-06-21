<?php

namespace Vendor\Test\InheritanceApiBundle\Entity;

class UserLegalFilter extends UserFilter
{
    private $companyName;

    /**
     * @return string|null
     */
    public function getCompanyName()
    {
        return $this->companyName;
    }
    /**
     * @param string $companyName
     * @return $this
     */
    public function setCompanyName($companyName)
    {
        $this->companyName = $companyName;
        return $this;
    }
}
