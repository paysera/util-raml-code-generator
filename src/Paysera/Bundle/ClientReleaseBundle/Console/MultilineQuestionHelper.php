<?php

namespace Paysera\Bundle\ClientReleaseBundle\Console;

use RuntimeException;
use Symfony\Component\Console\Helper\QuestionHelper;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Question\Question;

class MultilineQuestionHelper extends QuestionHelper
{
    public function ask(InputInterface $input, OutputInterface $output, Question $question)
    {
        if ($question instanceof MultilineQuestion) {
            if (!$question->getValidator()) {
                return $this->doAsk($output, $question);
            }

            $interviewer = function () use ($output, $question) {
                return $this->doAsk($output, $question);
            };

            return $this->validateAttempts($interviewer, $output, $question);
        }

        return parent::ask($input, $output, $question);
    }

    private function doAsk(OutputInterface $output, MultilineQuestion $question)
    {
        $this->writePrompt($output, $question);

        $inputStream = STDIN;
        $buffer = '';

        do {
            $ret = fgets($inputStream, 4096);
            if ($ret === false) {
                throw new RuntimeException('Aborted');
            }
            $buffer .= $ret;
        } while (strpos($buffer, $question->getEscapeSequence()) === false);

        $buffer = trim($buffer);

        if ($normalizer = $question->getNormalizer()) {
            return $normalizer($buffer);
        }

        return $buffer;
    }

    private function validateAttempts(callable $interviewer, OutputInterface $output, Question $question)
    {
        $error = null;
        $attempts = $question->getMaxAttempts();
        while (null === $attempts || $attempts--) {
            if (null !== $error) {
                $this->writeError($output, $error);
            }

            try {
                return call_user_func($question->getValidator(), $interviewer());
            } catch (RuntimeException $e) {
                throw $e;
            } catch (\Exception $error) {
            }
        }

        throw $error;
    }
}
