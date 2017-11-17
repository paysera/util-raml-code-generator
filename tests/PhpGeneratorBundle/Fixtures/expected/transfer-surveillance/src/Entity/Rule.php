<?php

namespace Paysera\Test\TestClient\Entity;

use Paysera\Component\RestClientCommon\Entity\Entity;

class Rule extends Entity
{
    /**
     * @return integer|null
     */
    public function getId()
    {
        return $this->get('id');
    }
    /**
     * @param integer $id
     * @return $this
     */
    public function setId($id)
    {
        $this->set('id', $id);
        return $this;
    }
    /**
     * @return string
     */
    public function getMatcherIdentifier()
    {
        return $this->get('matcher_identifier');
    }
    /**
     * @param string $matcherIdentifier
     * @return $this
     */
    public function setMatcherIdentifier($matcherIdentifier)
    {
        $this->set('matcher_identifier', $matcherIdentifier);
        return $this;
    }
    /**
     * @return string
     */
    public function getTitle()
    {
        return $this->get('title');
    }
    /**
     * @param string $title
     * @return $this
     */
    public function setTitle($title)
    {
        $this->set('title', $title);
        return $this;
    }
    /**
     * @return string
     */
    public function getAction()
    {
        return $this->get('action');
    }
    /**
     * @param string $action
     * @return $this
     */
    public function setAction($action)
    {
        $this->set('action', $action);
        return $this;
    }
    /**
     * @return string
     */
    public function getType()
    {
        return $this->get('type');
    }
    /**
     * @param string $type
     * @return $this
     */
    public function setType($type)
    {
        $this->set('type', $type);
        return $this;
    }
    /**
     * @return string|null
     */
    public function getStatus()
    {
        return $this->get('status');
    }
    /**
     * @param string $status
     * @return $this
     */
    public function setStatus($status)
    {
        $this->set('status', $status);
        return $this;
    }
    /**
     * @return boolean|null
     */
    public function isAmlDetailsNeeded()
    {
        return $this->get('aml_details_needed');
    }
    /**
     * @param boolean $amlDetailsNeeded
     * @return $this
     */
    public function setAmlDetailsNeeded($amlDetailsNeeded)
    {
        $this->set('aml_details_needed', $amlDetailsNeeded);
        return $this;
    }
    /**
     * @return boolean|null
     */
    public function isRelatedBankAccountsAllowed()
    {
        return $this->get('related_bank_accounts_allowed');
    }
    /**
     * @param boolean $relatedBankAccountsAllowed
     * @return $this
     */
    public function setRelatedBankAccountsAllowed($relatedBankAccountsAllowed)
    {
        $this->set('related_bank_accounts_allowed', $relatedBankAccountsAllowed);
        return $this;
    }
    /**
     * @return string|null
     */
    public function getDescription()
    {
        return $this->get('description');
    }
    /**
     * @param string $description
     * @return $this
     */
    public function setDescription($description)
    {
        $this->set('description', $description);
        return $this;
    }
    /**
     * @return boolean|null
     */
    public function isInformPrevention()
    {
        return $this->get('inform_prevention');
    }
    /**
     * @param boolean $informPrevention
     * @return $this
     */
    public function setInformPrevention($informPrevention)
    {
        $this->set('inform_prevention', $informPrevention);
        return $this;
    }
}
