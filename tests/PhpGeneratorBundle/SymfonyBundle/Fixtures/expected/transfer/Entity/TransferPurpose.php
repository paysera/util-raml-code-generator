<?php

namespace Vendor\Test\TransferApiBundle\Entity;

class TransferPurpose
{
    const CODE_CASH_IN = 'cash_in';
    const CODE_CASH_OUT = 'cash_out';
    const CODE_PAYMENT = 'payment';
    const CODE_APP_TRANSFER = 'app_transfer';

    private $id;
    private $details;
    private $reference;
    private $voCode;
    private $ocrCode;
    private $detailsOptions;
    private $code;

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
     * @return string|null
     */
    public function getDetails()
    {
        return $this->details;
    }
    /**
     * @param string $details
     * @return $this
     */
    public function setDetails($details)
    {
        $this->details = $details;
        return $this;
    }
    /**
     * @return string|null
     */
    public function getReference()
    {
        return $this->reference;
    }
    /**
     * @param string $reference
     * @return $this
     */
    public function setReference($reference)
    {
        $this->reference = $reference;
        return $this;
    }
    /**
     * @return string|null
     */
    public function getVoCode()
    {
        return $this->voCode;
    }
    /**
     * @param string $voCode
     * @return $this
     */
    public function setVoCode($voCode)
    {
        $this->voCode = $voCode;
        return $this;
    }
    /**
     * @return string|null
     */
    public function getOcrCode()
    {
        return $this->ocrCode;
    }
    /**
     * @param string $ocrCode
     * @return $this
     */
    public function setOcrCode($ocrCode)
    {
        $this->ocrCode = $ocrCode;
        return $this;
    }
    /**
     * @return DetailsOptions|null
     */
    public function getDetailsOptions()
    {
        return $this->detailsOptions;
    }
    /**
     * @param DetailsOptions $detailsOptions
     * @return $this
     */
    public function setDetailsOptions(DetailsOptions $detailsOptions)
    {
        $this->detailsOptions = $detailsOptions;
        return $this;
    }
    /**
     * @return string|null
     */
    public function getCode()
    {
        return $this->code;
    }
    /**
     * @param string $code
     * @return $this
     */
    public function setCode($code)
    {
        $this->code = $code;
        return $this;
    }

}
