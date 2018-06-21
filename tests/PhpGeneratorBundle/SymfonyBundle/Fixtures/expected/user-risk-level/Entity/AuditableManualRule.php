<?php

namespace Vendor\Test\UserRiskLevelApiBundle\Entity;

class AuditableManualRule
{
    private $id;
    private $manualRule;
    private $auditRecord;

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
     * @return ManualRule
     */
    public function getManualRule()
    {
        return $this->manualRule;
    }
    /**
     * @param ManualRule $manualRule
     * @return $this
     */
    public function setManualRule(ManualRule $manualRule)
    {
        $this->manualRule = $manualRule;
        return $this;
    }
    /**
     * @return AuditRecord
     */
    public function getAuditRecord()
    {
        return $this->auditRecord;
    }
    /**
     * @param AuditRecord $auditRecord
     * @return $this
     */
    public function setAuditRecord(AuditRecord $auditRecord)
    {
        $this->auditRecord = $auditRecord;
        return $this;
    }

}
