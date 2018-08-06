<?php

namespace Paysera\Bundle\ClientReleaseBundle\Console;

use Symfony\Component\Console\Question\Question;

class MultilineQuestion extends Question
{
    private $escapeSequence = "\n\n";

    /**
     * @return string
     */
    public function getEscapeSequence()
    {
        return $this->escapeSequence;
    }

    /**
     * @param string $escapeSequence
     *
     * @return $this
     */
    public function setEscapeSequence($escapeSequence)
    {
        $this->escapeSequence = $escapeSequence;
        return $this;
    }
}
