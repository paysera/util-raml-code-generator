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
}
