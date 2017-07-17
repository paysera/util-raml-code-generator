<?php

namespace Paysera\Bundle\CodeGeneratorBundle\Entity;

class SourceCode
{
    /**
     * @var string
     */
    private $filepath;

    /**
     * @var string
     */
    private $contents;

    /**
     * @return string
     */
    public function getFilepath()
    {
        return $this->filepath;
    }

    /**
     * @param string $filepath
     *
     * @return $this
     */
    public function setFilepath($filepath)
    {
        $this->filepath = $filepath;
        return $this;
    }

    /**
     * @return string
     */
    public function getContents()
    {
        return $this->contents;
    }

    /**
     * @param string $contents
     *
     * @return $this
     */
    public function setContents($contents)
    {
        $this->contents = $contents;
        return $this;
    }
}
