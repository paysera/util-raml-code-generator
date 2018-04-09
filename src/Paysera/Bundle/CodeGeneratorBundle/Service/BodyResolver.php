<?php

namespace Paysera\Bundle\CodeGeneratorBundle\Service;

use Exception;
use Fig\Http\Message\StatusCodeInterface;
use Raml\Body;
use Raml\Method;
use Raml\Types\StringType;

class BodyResolver
{
    const BODY_JSON = 'application/json';
    const BODY_JAVASCRIPT = 'application/javascript';

    /**
     * @param Method $method
     * @return null|Body
     * @throws \Exception
     */
    public function getResponseBody(Method $method)
    {
        $okResponse = $method->getResponse(StatusCodeInterface::STATUS_OK);

        if ($okResponse === null) {
            return null;
        }

        try {
            $body = $okResponse->getBodyByType(self::BODY_JSON);
        } catch (Exception $exception) {
            /** @var Body $body */
            $body = $okResponse->getBodyByType(self::BODY_JAVASCRIPT);
            $body->setType(new StringType('string'));
        }

        return $body;
    }

    public function isRawResponse(Method $method)
    {
        $body = $this->getResponseBody($method);
        if ($body !== null) {
            return $body->getMediaType() !== self::BODY_JSON;
        }

        return false;
    }
}
