<?php

namespace Tests;

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

    public function shutdown()
    {
        parent::shutdown();

        $cacheDir = $this->getCacheDir();
        if (!file_exists($cacheDir)) {
            return;
        }

        $files = new \RecursiveIteratorIterator(
            new \RecursiveDirectoryIterator($cacheDir, \RecursiveDirectoryIterator::SKIP_DOTS),
            \RecursiveIteratorIterator::CHILD_FIRST
        );

        /** @var \SplFileInfo $fileInfo */
        foreach ($files as $fileInfo) {
            if ($fileInfo->isDir()) {
                rmdir($fileInfo->getRealPath());
            } else {
                unlink($fileInfo->getRealPath());
            }
        }
        rmdir($cacheDir);
    }
}
