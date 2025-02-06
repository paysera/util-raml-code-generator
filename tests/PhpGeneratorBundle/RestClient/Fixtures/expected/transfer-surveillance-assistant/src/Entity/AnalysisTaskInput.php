<?php

namespace Paysera\Test\TransferSurveillanceAssistantClient\Entity;

use Paysera\Component\RestClientCommon\Entity\Entity;

class AnalysisTaskInput extends Entity
{
    const REFERENCE_TYPE_INFORMATION_REQUEST = 'information_request';

    public function __construct(array $data = [])
    {
        parent::__construct($data);
    }

    /**
     * @return string
     */
    public function getReferenceId()
    {
        return $this->get('reference_id');
    }
    /**
     * @param string $referenceId
     * @return $this
     */
    public function setReferenceId($referenceId)
    {
        $this->set('reference_id', $referenceId);
        return $this;
    }
    /**
     * @return string
     */
    public function getReferenceType()
    {
        return $this->get('reference_type');
    }
    /**
     * @param string $referenceType
     * @return $this
     */
    public function setReferenceType($referenceType)
    {
        $this->set('reference_type', $referenceType);
        return $this;
    }
}
