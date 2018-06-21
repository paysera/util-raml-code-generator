<?php

namespace Vendor\Test\UserRiskLevelApiBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;

class RiskLevel
{
    const LEVEL_LOW = 'low';
    const LEVEL_MEDIUM = 'medium';
    const LEVEL_HIGH = 'high';

    private $id;
    private $userId;
    private $level;
    private $calculatedAt;
    private $riskRules;

    public function __construct()
    {
                        
        $this->riskRules = new ArrayCollection();
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
    public function getUserId()
    {
        return $this->userId;
    }
    /**
     * @param string $userId
     * @return $this
     */
    public function setUserId($userId)
    {
        $this->userId = $userId;
        return $this;
    }
    /**
     * @return string|null
     */
    public function getLevel()
    {
        return $this->level;
    }
    /**
     * @param string $level
     * @return $this
     */
    public function setLevel($level)
    {
        $this->level = $level;
        return $this;
    }
    /**
     * @return \DateTime
     */
    public function getCalculatedAt()
    {
        return $this->calculatedAt;
    }
    /**
     * @param \DateTimeInterface $calculatedAt
     * @return $this
     */
    public function setCalculatedAt(\DateTimeInterface $calculatedAt)
    {
        $this->calculatedAt = $calculatedAt;
        return $this;
    }
    /**
     * @return RiskRule[]|ArrayCollection
     */
    public function getRiskRules()
    {
        return $this->riskRules;
    }
        /**
     * @param RiskRule[] $riskRules
     * @return $this
     */
    public function setRiskRules(array $riskRules)
    {
        foreach($this->riskRules as $item) {
            $this->removeRiskRule($item);
        }
        foreach($riskRules as $item) {
            $this->addRiskRule($item);
        }
        return $this;
    }
    /**
     * @param RiskRule $riskRule
     * @return $this
     */
    public function addRiskRule($riskRule)
    {
        if(!$this->riskRules->contains($riskRule)) {
            $this->riskRules->add($riskRule);
        }
        return $this;
    }
    /**
     * @param RiskRule $riskRule
     * @return $this
     */
    public function removeRiskRule($riskRule)
    {
        $this->riskRules->removeElement($riskRule);
        return $this;
    }
    
}
