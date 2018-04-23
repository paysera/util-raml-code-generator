<?php

namespace Paysera\Test\TestClient\Entity;

use Paysera\Component\RestClientCommon\Entity\Entity;

class SystemTokenRequest extends Entity
{
    public function __construct(array $data = [])
    {
        parent::__construct($data);
    }

    /**
     * @return string
     */
    public function getScope()
    {
        return $this->get('scope');
    }
    /**
     * @param string $scope
     * @return $this
     */
    public function setScope($scope)
    {
        $this->set('scope', $scope);
        return $this;
    }
    /**
     * @return string
     */
    public function getAudience()
    {
        return $this->get('audience');
    }
    /**
     * @param string $audience
     * @return $this
     */
    public function setAudience($audience)
    {
        $this->set('audience', $audience);
        return $this;
    }
}
