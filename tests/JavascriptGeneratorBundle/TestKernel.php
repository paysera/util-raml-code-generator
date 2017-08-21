<?php

namespace Tests\JavascriptGeneratorBundle;

class TestKernel extends \AppKernel
{
    /**
     * @var \Closure
     */
    private $containerModifier;

    public function buildContainer()
    {
        $container = parent::buildContainer();

        if ($this->containerModifier) {
            $containerModifier = $this->containerModifier;
            $containerModifier($container);
            $this->containerModifier = null;
        };

        return $container;
    }

    public function setContainerModifier(\Closure $containerModifier)
    {
        $this->containerModifier = $containerModifier;
    }
}
