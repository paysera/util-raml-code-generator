<?php
declare(strict_types=1);

namespace Paysera\Bundle\ClientReleaseBundle\Exception;

use Exception;

class ReleaseCycleException extends Exception
{
    private $debugMessage;

    /**
     * @return string|null
     */
    public function getDebugMessage()
    {
        return $this->debugMessage;
    }

    public function setDebugMessage(string $debugMessage): self
    {
        $this->debugMessage = $debugMessage;
        return $this;
    }
}
