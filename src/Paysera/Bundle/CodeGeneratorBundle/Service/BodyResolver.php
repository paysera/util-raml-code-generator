<?php

namespace Paysera\Bundle\CodeGeneratorBundle\Service;

use Exception;
use Fig\Http\Message\StatusCodeInterface;
use Paysera\Bundle\CodeGeneratorBundle\Entity\Definition\ApiDefinition;
use Paysera\Bundle\CodeGeneratorBundle\Entity\Definition\ResultTypeDefinition;
use Raml\Body;
use Raml\BodyInterface;
use Raml\Method;
use Raml\Response;
use Raml\Types\ArrayType;
use Raml\Types\StringType;

class BodyResolver
{
    const BODY_JSON = 'application/json';
    const BODY_JAVASCRIPT = 'application/javascript';
    const BODY_OCTET_STREAM = 'application/octet-stream';
    const BODY_TEXT_CSV = 'text/csv';
    const ANNOTATION_STREAM_RESPONSE = '(stream_response)';

    /**
     * @param Method $method
     * @return null|Body
     * @throws \Exception
     */
    public function getRequestBody(Method $method)
    {
        try {
            return $method->getBodyByType(self::BODY_JSON);
        } catch (Exception $exception) {
            return null;
        }
    }

    /**
     * @param Method $method
     * @return null|BodyInterface
     * @throws Exception
     */
    public function getResponseBody(Method $method)
    {
        $successfulResponseWithBody = $this->getSuccessfulResponseWithBody($method);
        if ($successfulResponseWithBody === null) {
            return null;
        }

        try {
            return $successfulResponseWithBody->getBodyByType(self::BODY_JSON);
        } catch (Exception $exception) {}

        try {
            $body = $successfulResponseWithBody->getBodyByType(self::BODY_JAVASCRIPT);
            $body->setType(new StringType('string'));

            return $body;
        } catch (Exception $exception) {}

        try {
            return $successfulResponseWithBody->getBodyByType(self::BODY_OCTET_STREAM);
        } catch (Exception $exception) {}

        try {
            return $successfulResponseWithBody->getBodyByType(self::BODY_TEXT_CSV);
        } catch (Exception $exception) {}

        throw new Exception('No body found');
    }

    public function isRawResponse(Method $method)
    {
        $body = $this->getResponseBody($method);
        if ($body !== null) {
            return $body->getMediaType() !== self::BODY_JSON && $body->getMediaType() !== self::BODY_OCTET_STREAM;
        }

        return false;
    }

    public function isStreamResponse(Method $method) : bool
    {
        return array_key_exists(self::ANNOTATION_STREAM_RESPONSE, $method->getAnnotations());
    }

    public function isIterableResponse(Method $method, ApiDefinition $api)
    {
        $body = $this->getResponseBody($method);
        if ($body === null) {
            return false;
        }

        if ($body->getType() instanceof ArrayType) {
            return true;
        }

        if ($body !== null) {
            if ($api->getType($body->getType()->getName()) instanceof ResultTypeDefinition) {
                return true;
            }
        }

        return false;
    }

    private function getSuccessfulResponseWithBody(Method $method): ?Response
    {
        if ($method->getResponse(StatusCodeInterface::STATUS_OK) !== null) {
            return ($method->getResponse(StatusCodeInterface::STATUS_OK));
        }

        if ($method->getResponse(StatusCodeInterface::STATUS_ACCEPTED) !== null) {
            return ($method->getResponse(StatusCodeInterface::STATUS_ACCEPTED));
        }

        return null;
    }
}
