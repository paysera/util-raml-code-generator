<?php

namespace Paysera\Bundle\WordNetBundle\Entity;

class PartsOfSpeech
{
    private $word;
    private $nounDomains;
    private $verbDomains;
    private $adjectiveDomains;
    private $adverbDomains;
    private $adjectiveSatelliteDomains;

    public function __construct()
    {
        $this->nounDomains = [];
        $this->verbDomains = [];
        $this->adjectiveDomains = [];
        $this->adverbDomains = [];
        $this->adjectiveSatelliteDomains = [];
    }

    /**
     * @return string
     */
    public function getWord()
    {
        return $this->word;
    }

    /**
     * @param string $word
     *
     * @return $this
     */
    public function setWord($word)
    {
        $this->word = $word;
        return $this;
    }

    /**
     * @return array
     */
    public function getNounDomains()
    {
        return $this->nounDomains;
    }

    /**
     * @param string $domain
     * @param string $definition
     *
     * @return $this
     */
    public function addNounDomain($domain, $definition)
    {
        $this->nounDomains[$domain] = $definition;
        return $this;
    }

    /**
     * @return array
     */
    public function getVerbDomains()
    {
        return $this->verbDomains;
    }

    /**
     * @param string $domain
     * @param string $definition
     *
     * @return $this
     */
    public function addVerbDomain($domain, $definition)
    {
        $this->verbDomains[$domain] = $definition;
        return $this;
    }

    /**
     * @return array
     */
    public function getAdjectiveDomains()
    {
        return $this->adjectiveDomains;
    }

    /**
     * @param string $domain
     * @param string $definition
     *
     * @return $this
     */
    public function addAdjectiveDomain($domain, $definition)
    {
        $this->adjectiveDomains[$domain] = $definition;
        return $this;
    }

    /**
     * @return array
     */
    public function getAdverbDomains()
    {
        return $this->adverbDomains;
    }

    /**
     * @param string $domain
     * @param string $definition
     *
     * @return $this
     */
    public function addAdverbDomain($domain, $definition)
    {
        $this->adverbDomains[$domain] = $definition;
        return $this;
    }

    /**
     * @return array
     */
    public function getAdjectiveSatelliteDomains()
    {
        return $this->adjectiveSatelliteDomains;
    }

    /**
     * @param string $domain
     * @param string $definition
     *
     * @return $this
     */
    public function addAdjectiveSatelliteDomain($domain, $definition)
    {
        $this->adjectiveSatelliteDomains[$domain] = $definition;
        return $this;
    }
}
