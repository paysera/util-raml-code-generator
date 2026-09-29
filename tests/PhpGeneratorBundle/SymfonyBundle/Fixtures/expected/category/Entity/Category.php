<?php

namespace Vendor\Test\CategoryApiBundle\Entity;

use Evp\Component\Money\Money;

class Category
{
    const STATUS_ACTIVE = 'active';
    const STATUS_INACTIVE = 'inactive';
    const STATE_ACTIVE = 'active';
    const STATE_SUSPENDED = 'suspended';

    private $id;
    private $parentId;
    private $titles;
    private $status;
    private $enabled;
    private $updatedAt;
    private $keyword;
    private $archived;
    private $score;
    private $nickname;
    private $tags;
    private $state;
    private $payload;
    private $priceAmount;
    private $priceCurrency;
    private $closedAt;

    public function __construct()
    {
                
        $this->titles = [];                                
        $this->tags = [];                
    }

    /**
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }
    /**
     * @return string|null
     */
    public function getParentId()
    {
        return $this->parentId;
    }
    /**
     * @param string $parentId
     * @return $this
     */
    public function setParentId($parentId)
    {
        $this->parentId = $parentId;
        return $this;
    }
    /**
     * @return string[]
     */
    public function getTitles()
    {
        return $this->titles;
    }
    /**
     * @param string[] $titles
     * @return $this
     */
    public function setTitles(array $titles)
    {
        $this->titles = $titles;
        return $this;
    }
    /**
     * @return string|null
     */
    public function getStatus()
    {
        return $this->status;
    }
    /**
     * @param string $status
     * @return $this
     */
    public function setStatus($status)
    {
        $this->status = $status;
        return $this;
    }
    /**
     * @return boolean|null
     */
    public function isEnabled()
    {
        return $this->enabled;
    }
    /**
     * @param boolean $enabled
     * @return $this
     */
    public function setEnabled($enabled)
    {
        $this->enabled = $enabled;
        return $this;
    }
    /**
     * @return \DateTime|null
     */
    public function getUpdatedAt()
    {
        return $this->updatedAt;
    }
    /**
     * @param \DateTimeInterface $updatedAt
     * @return $this
     */
    public function setUpdatedAt(\DateTimeInterface $updatedAt)
    {
        $this->updatedAt = $updatedAt;
        return $this;
    }
    /**
     * @return Keyword|null
     */
    public function getKeyword()
    {
        return $this->keyword;
    }
    /**
     * @param Keyword $keyword
     * @return $this
     */
    public function setKeyword(Keyword $keyword)
    {
        $this->keyword = $keyword;
        return $this;
    }
    /**
     * @return boolean|null
     */
    public function isArchived()
    {
        return $this->archived;
    }
    /**
     * @param boolean $archived
     * @return $this
     */
    public function setArchived($archived)
    {
        $this->archived = $archived;
        return $this;
    }
    /**
     * @return integer|null
     */
    public function getScore()
    {
        return $this->score;
    }
    /**
     * @param integer $score
     * @return $this
     */
    public function setScore($score)
    {
        $this->score = $score;
        return $this;
    }
    /**
     * @return string|null
     */
    public function getNickname()
    {
        return $this->nickname;
    }
    /**
     * @param string $nickname
     * @return $this
     */
    public function setNickname($nickname)
    {
        $this->nickname = $nickname;
        return $this;
    }
    /**
     * @return string[]
     */
    public function getTags()
    {
        return $this->tags;
    }
    /**
     * @param string[] $tags
     * @return $this
     */
    public function setTags(array $tags)
    {
        $this->tags = $tags;
        return $this;
    }
    /**
     * @return string|null
     */
    public function getState()
    {
        return $this->state;
    }
    /**
     * @param string $state
     * @return $this
     */
    public function setState($state)
    {
        $this->state = $state;
        return $this;
    }
    /**
     * @return object|null
     */
    public function getPayload()
    {
        return $this->payload;
    }
    /**
     * @param object $payload
     * @return $this
     */
    public function setPayload($payload)
    {
        $this->payload = $payload;
        return $this;
    }
    /**
     * @return Money|null
     */
    public function getPrice()
    {
        if ($this->priceAmount === null && $this->priceCurrency === null) {
            return null;
        }
        return new Money($this->priceAmount, $this->priceCurrency);
    }
    /**
     * @param Money $price
     * @return $this
     */
    public function setPrice(Money $price)
    {
        $this->priceAmount = $price->getAmount();
        $this->priceCurrency = $price->getCurrency();
        return $this;
    }
    /**
     * @return \DateTime|null
     */
    public function getClosedAt()
    {
        return $this->closedAt;
    }
    /**
     * @param \DateTimeInterface $closedAt
     * @return $this
     */
    public function setClosedAt(\DateTimeInterface $closedAt)
    {
        $this->closedAt = $closedAt;
        return $this;
    }

}
