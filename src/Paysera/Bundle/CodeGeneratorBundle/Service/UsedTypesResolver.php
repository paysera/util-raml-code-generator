<?php

namespace Paysera\Bundle\CodeGeneratorBundle\Service;

use Paysera\Bundle\CodeGeneratorBundle\Entity\Definition\ApiDefinition;
use Paysera\Bundle\CodeGeneratorBundle\Entity\Definition\ArrayPropertyDefinition;
use Paysera\Bundle\CodeGeneratorBundle\Entity\Definition\DateTimePropertyDefinition;
use Paysera\Bundle\CodeGeneratorBundle\Entity\Definition\DateTimeTypeDefinition;
use Paysera\Bundle\CodeGeneratorBundle\Entity\Definition\PropertyDefinition;
use Paysera\Bundle\CodeGeneratorBundle\Entity\Definition\ResultTypeDefinition;
use Paysera\Bundle\CodeGeneratorBundle\Entity\Definition\TypeDefinition;
use Raml\Body;
use Raml\Resource;
use Raml\TraitDefinition;

class UsedTypesResolver
{
    public function resolveUsedTypes(ApiDefinition $api)
    {
        $primaryTypes = [];
        foreach ($api->getRamlDefinition()->getResources() as $resource) {
            $primaryTypes = $this->getUsedTypes($resource, $primaryTypes);
        }
        $secondaryTypes = [];
        foreach (array_unique($primaryTypes) as $type) {
            $typeDefinition = $api->getType($type);
            if ($typeDefinition !== null) {
                $secondaryTypes = $this->getNestedTypes($api, $typeDefinition, $secondaryTypes);
            }
        }

        $types = $this->filterOutTypes($api, $secondaryTypes);
        sort($types);
        return $types;
    }

    public function resolveDirectlyUsedTypes(ApiDefinition $api)
    {
        $directTypes = $this->resolveDirectlyUsedTypesUnfiltered($api);
        $types = $this->filterOutTypes($api, $directTypes);
        sort($types);
        return $types;
    }

    public function resolveDirectlyUsedTypesUnfiltered(ApiDefinition $api)
    {
        $directTypes = [];
        foreach ($api->getRamlDefinition()->getResources() as $resource) {
            $directTypes = $this->getDirectlyUsedTypes($resource, $directTypes);
        }

        sort($directTypes);
        return array_unique($directTypes);
    }

    public function resolveRelatedTypes(TypeDefinition $type, ApiDefinition $api)
    {
        $relatedTypes = [];
        foreach ($type->getProperties() as $property) {
            if ($property instanceof ArrayPropertyDefinition) {
                $relatedTypes[] = $property->getItemsType();
            } elseif ($property->getType() === PropertyDefinition::TYPE_REFERENCE) {
                $relatedTypes[] = $property->getReference();
            } elseif ($property instanceof DateTimePropertyDefinition) {
                $relatedTypes[] = DateTimeTypeDefinition::NAME;
            } else {
                $relatedTypes[] = $property->getType();
            }
        }
        if ($type->getParent() !== null) {
            $relatedTypes[] = $type->getParent()->getName();
        }
        if ($type instanceof ResultTypeDefinition) {
            $relatedTypes[] = $type->getItemsType();
        }

        $types = $this->filterOutTypes($api, $relatedTypes);
        sort($types);
        return $types;
    }

    private function filterOutTypes(ApiDefinition $api, array $types)
    {
        return array_filter(array_unique($types), function ($type) use ($api) {
            return
                !in_array($type, PropertyDefinition::getSimpleTypes(), true)
                && $api->getType($type) !== null
            ;
        });
    }

    private function getNestedTypes(ApiDefinition $api, TypeDefinition $type, array $types)
    {
        $types[] = $type->getName();
        if ($type->getParent() !== null) {
            $types = $this->getNestedTypes($api, $type->getParent(), $types);
        }
        if ($type instanceof ResultTypeDefinition) {
            $resultType = $api->getType($type->getItemsType());
            if ($resultType !== null) {
                $types = $this->getNestedTypes($api, $resultType, $types);
            }
        }
        foreach ($type->getProperties() as $property) {
            if ($property instanceof ArrayPropertyDefinition) {
                $itemsType = $api->getType($property->getItemsType());
                if ($itemsType !== null) {
                    $types = $this->getNestedTypes($api, $itemsType, $types);
                }
            }
            $subType = $api->getType($property->getType());
            if ($subType !== null) {
                $types = $this->getNestedTypes($api, $subType, $types);
            }

            $refType = $api->getType($property->getReference());
            if ($refType !== null) {
                $types = $this->getNestedTypes($api, $refType, $types);
            }
            if ($property instanceof DateTimePropertyDefinition) {
                $types[] = DateTimeTypeDefinition::NAME;
            }
        }
        return $types;
    }

    public function getDirectlyUsedTypes(Resource $resource, array $types)
    {
        foreach ($resource->getTraits() as $resourceTrait) {
            if (count($resourceTrait->getQueryParameters()) > 0) {
                $types[] = $resourceTrait->getName();
            }
        }
        foreach ($resource->getResources() as $subResource) {
            $types = $this->getDirectlyUsedTypes($subResource, $types);
        }
        foreach ($resource->getMethods() as $method) {
            foreach ($method->getTraits() as $methodTrait) {
                if (count($methodTrait->getQueryParameters()) > 0) {
                    $types[] = $methodTrait->getName();
                }
            }
            foreach ($method->getResponses() as $response) {
                /** @var Body $responseBody */
                foreach ($response->getBodies() as $responseBody) {
                    if ($responseBody->getType()->getType() !== null) {
                        $types[] = $responseBody->getType()->getName();
                    } elseif (in_array($response->getStatusCode(), [200], true)) {
                        $types[] = null;
                    }
                }
            }
            /** @var Body $requestBody */
            foreach ($method->getBodies() as $requestBody) {
                $types[] = $requestBody->getType()->getName();
            }
        }

        return $types;
    }

    private function getUsedTypes(Resource $resource, array $types)
    {
        foreach ($resource->getTraits() as $resourceTrait) {
            $types = $this->getUsedTraitNames($resourceTrait, $types);
        }
        foreach ($resource->getResources() as $subResource) {
            $types = $this->getUsedTypes($subResource, $types);
        }
        foreach ($resource->getMethods() as $method) {
            foreach ($method->getTraits() as $methodTrait) {
                $types = $this->getUsedTraitNames($methodTrait, $types);
            }
            foreach ($method->getResponses() as $response) {
                /** @var Body $responseBody */
                foreach ($response->getBodies() as $responseBody) {
                    $types[] = $responseBody->getType()->getName();
                }
            }
            /** @var Body $requestBody */
            foreach ($method->getBodies() as $requestBody) {
                $types[] = $requestBody->getType()->getName();
            }
        }

        return $types;
    }

    private function getUsedTraitNames(TraitDefinition $trait, array $types)
    {
        if (count($trait->getQueryParameters()) > 0) {
            $types[] = $trait->getName();
        }
        foreach ($trait->getTraits() as $trait) {
            $types = $this->getUsedTraitNames($trait, $types);
        }
        return $types;
    }
}
