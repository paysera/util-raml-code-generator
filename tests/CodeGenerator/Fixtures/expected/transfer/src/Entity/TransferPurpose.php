<?php

namespace Paysera\Test\TestClient\Entity;

use Paysera\Component\RestClientCommon\Entity\Entity;

class TransferPurpose extends Entity
{
    /**
     * @return string|null
     */
    public function getDetails()
    {
        return $this->get('details');
    }
    /**
     * @param string $details
     * @return $this
     */
    public function setDetails($details)
    {
        $this->set('details', $details);
        return $this;
    }
    /**
     * @return string|null
     */
    public function getReference()
    {
        return $this->get('reference');
    }
    /**
     * @param string $reference
     * @return $this
     */
    public function setReference($reference)
    {
        $this->set('reference', $reference);
        return $this;
    }
    /**
     * @return string|null
     */
    public function getVoCode()
    {
        return $this->get('vo_code');
    }
    /**
     * @param string $voCode
     * @return $this
     */
    public function setVoCode($voCode)
    {
        $this->set('vo_code', $voCode);
        return $this;
    }
    /**
     * @return string|null
     */
    public function getOcrCode()
    {
        return $this->get('ocr_code');
    }
    /**
     * @param string $ocrCode
     * @return $this
     */
    public function setOcrCode($ocrCode)
    {
        $this->set('ocr_code', $ocrCode);
        return $this;
    }
    /**
     * @return DetailsOptions|null
     */
    public function getDetailsOptions()
    {
        return (new DetailsOptions())->setDataByReference($this->getByReference('details_options'));
    }
    /**
     * @param DetailsOptions $detailsOptions
     * @return $this
     */
    public function setDetailsOptions(DetailsOptions $detailsOptions)
    {
        $this->setByReference('details_options', $detailsOptions->getDataByReference());
        return $this;
    }
    /**
     * @return string|null
     */
    public function getCode()
    {
        return $this->get('code');
    }
    /**
     * @param string $code
     * @return $this
     */
    public function setCode($code)
    {
        $this->set('code', $code);
        return $this;
    }
}
