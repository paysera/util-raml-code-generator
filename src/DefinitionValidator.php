<?php
declare(strict_types=1);

namespace Paysera\Util\RamlCodeGenerator;

use Paysera\Util\RamlCodeGenerator\Entity\Definition\ApiDefinition;
use Paysera\Util\RamlCodeGenerator\Entity\Definition\ArrayPropertyDefinition;
use Paysera\Util\RamlCodeGenerator\Entity\Definition\PropertyDefinition;
use Paysera\Util\RamlCodeGenerator\Exception\UnrecognizedTypeException;
use Raml\Body;
use Raml\Resource;

class DefinitionValidator
{
    public function validateDefinition(ApiDefinition $api)
    {
        foreach ($api->getTypes() as $type) {
            foreach ($type->getProperties() as $property) {
                $this->validateType($property->getType(), $api);
                if ($property->getType() === PropertyDefinition::TYPE_REFERENCE) {
                    $this->validateType($property->getReference(), $api);
                }
                if ($property instanceof ArrayPropertyDefinition) {
                    $this->validateType($property->getItemsType(), $api);
                }
            }
        }

        foreach ($api->getRamlDefinition()->getResources() as $resource) {
            $this->validateResource($resource, $api);
        }
    }

    private function validateResource(Resource $resource, ApiDefinition $api)
    {
        foreach ($resource->getMethods() as $method) {
            foreach ($method->getResponses() as $response) {
                foreach ($response->getBodies() as $body) {
                    if ($body instanceof Body && $body->getType() !== null) {
                        $this->validateType($body->getType(), $api);
                    }
                }
            }
            foreach ($method->getBodies() as $body) {
                if ($body instanceof Body && $body->getType() !== null) {
                    $this->validateType($body->getType(), $api);
                }
            }
        }

        foreach ($resource->getResources() as $resource) {
            $this->validateResource($resource, $api);
        }
    }

    private function validateType(string $type, ApiDefinition $api)
    {
        if (
            !in_array($type, PropertyDefinition::getSimpleTypes(), true)
            && $api->getType($type) === null
            && $type !== PropertyDefinition::TYPE_REFERENCE
        ) {
            throw new UnrecognizedTypeException(sprintf('Did not found defined type "%s"', $type));
        }
    }
}
