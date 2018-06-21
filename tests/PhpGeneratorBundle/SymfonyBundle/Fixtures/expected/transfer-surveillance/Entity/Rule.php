<?php

namespace Vendor\Test\TransferSurveillanceApiBundle\Entity;

class Rule
{
    const ACTION_NEEDS_REVIEW = 'needs_review';
    const ACTION_NEEDS_AUDIT = 'needs_audit';
    const ACTION_NONE = 'none';
    const TYPE_SYSTEM = 'system';
    const TYPE_FILTER = 'filter';
    const STATUS_ENABLED = 'enabled';
    const STATUS_DISABLED = 'disabled';

    private $id;
    private $matcherIdentifier;
    private $title;
    private $action;
    private $type;
    private $status;
    private $amlDetailsNeeded;
    private $relatedBankAccountsAllowed;
    private $description;
    private $informPrevention;

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
    public function getMatcherIdentifier()
    {
        return $this->matcherIdentifier;
    }
    /**
     * @param string $matcherIdentifier
     * @return $this
     */
    public function setMatcherIdentifier($matcherIdentifier)
    {
        $this->matcherIdentifier = $matcherIdentifier;
        return $this;
    }
    /**
     * @return string
     */
    public function getTitle()
    {
        return $this->title;
    }
    /**
     * @param string $title
     * @return $this
     */
    public function setTitle($title)
    {
        $this->title = $title;
        return $this;
    }
    /**
     * @return string
     */
    public function getAction()
    {
        return $this->action;
    }
    /**
     * @param string $action
     * @return $this
     */
    public function setAction($action)
    {
        $this->action = $action;
        return $this;
    }
    /**
     * @return string
     */
    public function getType()
    {
        return $this->type;
    }
    /**
     * @param string $type
     * @return $this
     */
    public function setType($type)
    {
        $this->type = $type;
        return $this;
    }
    /**
     * @return string|null
     */
    public function getStatus()
    {
        return $this->status;
    }
    /**
     * @param string $status
     * @return $this
     */
    public function setStatus($status)
    {
        $this->status = $status;
        return $this;
    }
    /**
     * @return boolean|null
     */
    public function isAmlDetailsNeeded()
    {
        return $this->amlDetailsNeeded;
    }
    /**
     * @param boolean $amlDetailsNeeded
     * @return $this
     */
    public function setAmlDetailsNeeded($amlDetailsNeeded)
    {
        $this->amlDetailsNeeded = $amlDetailsNeeded;
        return $this;
    }
    /**
     * @return boolean|null
     */
    public function isRelatedBankAccountsAllowed()
    {
        return $this->relatedBankAccountsAllowed;
    }
    /**
     * @param boolean $relatedBankAccountsAllowed
     * @return $this
     */
    public function setRelatedBankAccountsAllowed($relatedBankAccountsAllowed)
    {
        $this->relatedBankAccountsAllowed = $relatedBankAccountsAllowed;
        return $this;
    }
    /**
     * @return string|null
     */
    public function getDescription()
    {
        return $this->description;
    }
    /**
     * @param string $description
     * @return $this
     */
    public function setDescription($description)
    {
        $this->description = $description;
        return $this;
    }
    /**
     * @return boolean|null
     */
    public function isInformPrevention()
    {
        return $this->informPrevention;
    }
    /**
     * @param boolean $informPrevention
     * @return $this
     */
    public function setInformPrevention($informPrevention)
    {
        $this->informPrevention = $informPrevention;
        return $this;
    }

}
