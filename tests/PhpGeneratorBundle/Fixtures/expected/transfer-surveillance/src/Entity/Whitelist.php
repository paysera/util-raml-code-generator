<?php

namespace Paysera\Test\TestClient\Entity;

use Paysera\Component\RestClientCommon\Entity\Entity;

class Whitelist extends Entity
{
    public function __construct(array $data = [])
    {
        parent::__construct($data);
    }

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
     * @return string|null
     */
    public function getPayerCovenanteeId()
    {
        return $this->get('payer_covenantee_id');
    }
    /**
     * @param string $payerCovenanteeId
     * @return $this
     */
    public function setPayerCovenanteeId($payerCovenanteeId)
    {
        $this->set('payer_covenantee_id', $payerCovenanteeId);
        return $this;
    }
    /**
     * @return string|null
     */
    public function getPayerAccountIdentifier()
    {
        return $this->get('payer_account_identifier');
    }
    /**
     * @param string $payerAccountIdentifier
     * @return $this
     */
    public function setPayerAccountIdentifier($payerAccountIdentifier)
    {
        $this->set('payer_account_identifier', $payerAccountIdentifier);
        return $this;
    }
    /**
     * @return string|null
     */
    public function getBeneficiaryCovenanteeId()
    {
        return $this->get('beneficiary_covenantee_id');
    }
    /**
     * @param string $beneficiaryCovenanteeId
     * @return $this
     */
    public function setBeneficiaryCovenanteeId($beneficiaryCovenanteeId)
    {
        $this->set('beneficiary_covenantee_id', $beneficiaryCovenanteeId);
        return $this;
    }
    /**
     * @return string|null
     */
    public function getBeneficiaryAccountIdentifier()
    {
        return $this->get('beneficiary_account_identifier');
    }
    /**
     * @param string $beneficiaryAccountIdentifier
     * @return $this
     */
    public function setBeneficiaryAccountIdentifier($beneficiaryAccountIdentifier)
    {
        $this->set('beneficiary_account_identifier', $beneficiaryAccountIdentifier);
        return $this;
    }
    /**
     * @return Money|null
     */
    public function getMaxAmount()
    {
        if ($this->get('max_amount') === null) {
            return null;
        }
        return (new Money())->setDataByReference($this->getByReference('max_amount'));
    }
    /**
     * @param Money $maxAmount
     * @return $this
     */
    public function setMaxAmount(Money $maxAmount)
    {
        $this->setByReference('max_amount', $maxAmount->getDataByReference());
        return $this;
    }
    /**
     * @return WhitelistProfile[]
     */
    public function getProfiles()
    {
        $items = $this->getByReference('profiles');
        if ($items === null) {
            return [];
        }

        $list = [];
        foreach($items as &$item) {
            $list[] = (new WhitelistProfile())->setDataByReference($item);
        }

        return $list;
    }
    /**
     * @param WhitelistProfile[] $profiles
     * @return $this
     */
    public function setProfiles(array $profiles)
    {
        $data = [];
        foreach($profiles as $item) {
            $data[] = $item->getDataByReference();
        }
        $this->setByReference('profiles', $data);
        return $this;
    }
}
