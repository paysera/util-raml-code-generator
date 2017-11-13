<?php

namespace Paysera\Bundle\CodeGeneratorBundle\Service;

use Doctrine\Common\Inflector\Inflector;
use Paysera\Bundle\CodeGeneratorBundle\Entity\UriNameParts;

class MethodNameBuilder
{
    /**
     * @param string $uri
     * @param string $prefix
     * @return string
     */
    public function buildPluralMethodName($uri, $prefix)
    {
        $nameParts = $this->getNameParts($uri);

        $firstPart = $prefix . ucfirst(Inflector::pluralize($nameParts->getPartName()));
        if ($nameParts->getSubName() === null) {
            return $firstPart;
        }

        $parts = $this->buildSingularPaths($nameParts);
        $parts[count($parts) - 1] = ucfirst(Inflector::pluralize($parts[count($parts) - 1]));

        return $prefix . implode('', $parts);
    }

    /**
     * @param string $uri
     * @param string $prefix
     * @return string
     */
    public function buildSingularMethodName($uri, $prefix)
    {
        $nameParts = $this->getNameParts($uri);
        return $prefix . implode('', $this->buildSingularPaths($nameParts));
    }

    /**
     * @param string $uri
     * @return string
     */
    public function buildBinaryMethodName($uri)
    {
        $nameParts = $this->getNameParts($uri);
        $lastPart = $nameParts->getLastPart();

        $parts = [];
        if (strpos($lastPart->getPartName(), '-') !== false) {
            $subParts = explode('-', $lastPart->getPartName());
            $parts[] = $subParts[0];
            $parts = array_merge($parts, $this->buildSingularPaths($nameParts));
            unset($subParts[0]);
            unset($parts[count($parts) - 1]);
            $parts[] = Inflector::classify(implode(' ', $subParts));

            return implode('', $parts);
        }

        $parts[] = Inflector::singularize($nameParts->getLastPart()->getPartName());
        $lastParts = $this->buildSingularPaths($nameParts);
        if (!$nameParts->hasPlaceholder()) {
            $lastParts[count($parts) - 1] = Inflector::pluralize($lastParts[count($parts) - 1]);
        }
        $parts = array_merge($parts, $lastParts);
        unset($parts[count($parts) - 1]);

        return implode('', $parts);
    }

    /**
     * @param UriNameParts $nameParts
     * @return string[]
     */
    private function buildSingularPaths(UriNameParts $nameParts)
    {
        $parts = [];
        $part = $nameParts;
        do {
            $parts[] = ucfirst(Inflector::singularize($part->getPartName()));
            $part = $part->getSubName();
        } while ($part !== null);

        return $parts;
    }

    /**
     * @param string $uri
     * @return UriNameParts|null
     */
    private function getNameParts($uri)
    {
        $parts = new UriNameParts();
        $previousPart = $parts;

        while (strlen($uri) > 0) {
            $part = $this->doGetNameParts($uri);
            $previousPart->setSubName($part);
            $previousPart = $part;
            $uri = substr($uri, strlen($part->getFullPart()));
        }

        return $parts->getSubName();
    }

    /**
     * @param $uri
     * @return null|UriNameParts
     */
    private function doGetNameParts(string $uri)
    {
        $namePart = null;
        $uri = '/' . ltrim($uri, '/');

        if (preg_match('#^/([\w-]+)/*(\{[\w-]+\})*#', $uri, $matches) === 1) {
            $namePart = new UriNameParts();
            $namePart
                ->setPartName(Inflector::classify($matches[1]))
                ->setFullPart($matches[0])
            ;
            if (isset($matches[2])) {
                $namePart->setPlaceholder($matches[2]);
            }
        }

        return $namePart;
    }
}
