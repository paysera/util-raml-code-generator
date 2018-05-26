<?php

namespace Paysera\Component\Console;

use AppKernel;

class PharKernel extends AppKernel
{
    protected function initializeContainer()
    {
        $container = $this->buildContainer();
        $container->compile();

        $this->container = $container;
        $this->container->set('kernel', $this);
    }

    protected function buildContainer()
    {
        $container = $this->getContainerBuilder();
        $container->addObjectResource($this);
        $this->prepareContainer($container);

        $containerConfiguration = $this->registerContainerConfiguration($this->getContainerLoader($container));
        if ($containerConfiguration !== null) {
            $container->merge($containerConfiguration);
        }

        return $container;
    }
}
