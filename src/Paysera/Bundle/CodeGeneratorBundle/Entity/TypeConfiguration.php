<?php

namespace Paysera\Bundle\CodeGeneratorBundle\Entity;

class TypeConfiguration
{
    /**
     * @var string
     */
    private $matchRegex;

    /**
     * @var string
     */
    private $getterTemplate;

    /**
     * @var string
     */
    private $setterTemplate;

    /**
     * @var LibraryConfiguration
     */
    private $libraryConfiguration;

    /**
     * @var string
     */
    private $argumentTypeTemplate;

    /**
     * @var string
     */
    private $returnTypeTemplate;

    /**
     * @var string
     */
    private $argumentTypeHintTemplate;

    /**
     * @var string
     */
    private $typeName;

    /**
     * @var string
     */
    private $importString;

    /**
     * @var string
     */
    private $normalizerTemplate;

    /**
     * @var string
     */
    private $denormalizerTemplate;

    /**
     * @var string
     */
    private $entityFieldTemplate;

    /**
     * @var string
     */
    private $ormFieldTemplate;

    /**
     * @var string
     */
    private $normalizerImportString;

    /**
     * @var string
     */
    private $resultPopulatorCode;

    /**
     * @var string
     */
    private $apiMethodReturnType;

    /**
     * @return string
     */
    public function getMatchRegex()
    {
        return $this->matchRegex;
    }

    /**
     * @param string $matchRegex
     *
     * @return $this
     */
    public function setMatchRegex($matchRegex)
    {
        $this->matchRegex = $matchRegex;
        return $this;
    }

    /**
     * @return string
     */
    public function getGetterTemplate()
    {
        return $this->getterTemplate;
    }

    /**
     * @param string $getterTemplate
     *
     * @return $this
     */
    public function setGetterTemplate($getterTemplate)
    {
        $this->getterTemplate = $getterTemplate;
        return $this;
    }

    /**
     * @return string
     */
    public function getSetterTemplate()
    {
        return $this->setterTemplate;
    }

    /**
     * @param string $setterTemplate
     *
     * @return $this
     */
    public function setSetterTemplate($setterTemplate)
    {
        $this->setterTemplate = $setterTemplate;
        return $this;
    }

    /**
     * @return LibraryConfiguration
     */
    public function getLibraryConfiguration()
    {
        return $this->libraryConfiguration;
    }

    /**
     * @param LibraryConfiguration $libraryConfiguration
     *
     * @return $this
     */
    public function setLibraryConfiguration($libraryConfiguration)
    {
        $this->libraryConfiguration = $libraryConfiguration;
        return $this;
    }

    /**
     * @return string
     */
    public function getArgumentTypeTemplate()
    {
        return $this->argumentTypeTemplate;
    }

    /**
     * @param string $argumentTypeTemplate
     *
     * @return $this
     */
    public function setArgumentTypeTemplate($argumentTypeTemplate)
    {
        $this->argumentTypeTemplate = $argumentTypeTemplate;
        return $this;
    }

    /**
     * @return string
     */
    public function getReturnTypeTemplate()
    {
        return $this->returnTypeTemplate;
    }

    /**
     * @param string $returnTypeTemplate
     *
     * @return $this
     */
    public function setReturnTypeTemplate($returnTypeTemplate)
    {
        $this->returnTypeTemplate = $returnTypeTemplate;
        return $this;
    }

    /**
     * @return string
     */
    public function getArgumentTypeHintTemplate()
    {
        return $this->argumentTypeHintTemplate;
    }

    /**
     * @param string $argumentTypeHintTemplate
     *
     * @return $this
     */
    public function setArgumentTypeHintTemplate($argumentTypeHintTemplate)
    {
        $this->argumentTypeHintTemplate = $argumentTypeHintTemplate;
        return $this;
    }

    /**
     * @return string
     */
    public function getTypeName()
    {
        return $this->typeName;
    }

    /**
     * @param string $typeName
     *
     * @return $this
     */
    public function setTypeName($typeName)
    {
        $this->typeName = $typeName;
        return $this;
    }

    /**
     * @return string
     */
    public function getImportString()
    {
        return $this->importString;
    }

    /**
     * @param string $importString
     *
     * @return $this
     */
    public function setImportString($importString)
    {
        $this->importString = $importString;
        return $this;
    }

    /**
     * @return string
     */
    public function getNormalizerTemplate()
    {
        return $this->normalizerTemplate;
    }

    /**
     * @param string $normalizerTemplate
     *
     * @return $this
     */
    public function setNormalizerTemplate($normalizerTemplate)
    {
        $this->normalizerTemplate = $normalizerTemplate;
        return $this;
    }

    /**
     * @return string
     */
    public function getDenormalizerTemplate()
    {
        return $this->denormalizerTemplate;
    }

    /**
     * @param string $denormalizerTemplate
     *
     * @return $this
     */
    public function setDenormalizerTemplate($denormalizerTemplate)
    {
        $this->denormalizerTemplate = $denormalizerTemplate;
        return $this;
    }

    /**
     * @return string
     */
    public function getEntityFieldTemplate()
    {
        return $this->entityFieldTemplate;
    }

    /**
     * @param string $entityFieldTemplate
     *
     * @return $this
     */
    public function setEntityFieldTemplate($entityFieldTemplate)
    {
        $this->entityFieldTemplate = $entityFieldTemplate;
        return $this;
    }

    /**
     * @return string
     */
    public function getOrmFieldTemplate()
    {
        return $this->ormFieldTemplate;
    }

    /**
     * @param string $ormFieldTemplate
     *
     * @return $this
     */
    public function setOrmFieldTemplate($ormFieldTemplate)
    {
        $this->ormFieldTemplate = $ormFieldTemplate;
        return $this;
    }

    /**
     * @return string
     */
    public function getNormalizerImportString()
    {
        return $this->normalizerImportString;
    }

    /**
     * @param string $normalizerImportString
     *
     * @return $this
     */
    public function setNormalizerImportString($normalizerImportString)
    {
        $this->normalizerImportString = $normalizerImportString;
        return $this;
    }

    /**
     * @return string|null
     */
    public function getResultPopulatorCode()
    {
        return $this->resultPopulatorCode;
    }

    /**
     * @param string $resultPopulatorCode
     *
     * @return $this
     */
    public function setResultPopulatorCode($resultPopulatorCode)
    {
        $this->resultPopulatorCode = $resultPopulatorCode;

        return $this;
    }

    /**
     * @return string|null
     */
    public function getApiMethodReturnType()
    {
        return $this->apiMethodReturnType;
    }

    /**
     * @param string $apiMethodReturnType
     *
     * @return $this
     */
    public function setApiMethodReturnType($apiMethodReturnType)
    {
        $this->apiMethodReturnType = $apiMethodReturnType;

        return $this;
    }
}
