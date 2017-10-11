<?php

namespace Paysera\Bundle\CodeGeneratorBundle\Entity;

class UriNameParts
{
    /**
     * @var string
     */
    private $partName;

    /**
     * @var string
     */
    private $placeholder;

    /**
     * @var UriNameParts
     */
    private $subName;

    /**
     * @var string
     */
    private $fullPart;

    /**
     * @return string
     */
    public function getPartName()
    {
        return $this->partName;
    }

    /**
     * @param string $partName
     *
     * @return $this
     */
    public function setPartName($partName)
    {
        $this->partName = $partName;
        return $this;
    }

    /**
     * @return string|null
     */
    public function getPlaceholder()
    {
        return $this->placeholder;
    }

    /**
     * @param string $placeholder
     *
     * @return $this
     */
    public function setPlaceholder(string $placeholder)
    {
        $this->placeholder = $placeholder;
        return $this;
    }

    /**
     * @return UriNameParts|null
     */
    public function getSubName()
    {
        return $this->subName;
    }

    /**
     * @param UriNameParts $subName
     *
     * @return $this
     */
    public function setSubName($subName)
    {
        $this->subName = $subName;
        return $this;
    }

    /**
     * @return string
     */
    public function getFullPart()
    {
        return $this->fullPart;
    }

    /**
     * @param string $fullPart
     *
     * @return $this
     */
    public function setFullPart($fullPart)
    {
        $this->fullPart = $fullPart;
        return $this;
    }

    /**
     * @return int
     */
    public function getSubPartsCount()
    {
        $it = $this;
        $count = 0;
        while ($it->getSubName() !== null) {
            $count++;
            $it = $it->getSubName();
        }

        return $count;
    }

    /**
     * @return null|UriNameParts
     */
    public function getLastPart()
    {
        $it = $this;
        while ($it->getSubName() !== null) {
            $it = $it->getSubName();
        }

        return $it;
    }

    public function hasPlaceholder()
    {
        $it = $this;

        if ($this->getPlaceholder() !== null) {
            return true;
        }

        while ($it->getSubName() !== null) {
            $it = $it->getSubName();
            if ($it->getPlaceholder() !== null) {
                return true;
            }
        }

        return false;
    }
}
