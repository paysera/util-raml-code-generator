<?php

namespace Paysera\Test\CategoryClient\Entity;

use Evp\Component\Money\Money;
use Paysera\Component\RestClientCommon\Entity\Entity;

class Category extends Entity
{
    const STATUS_ACTIVE = 'active';
    const STATUS_INACTIVE = 'inactive';
    const STATE_ACTIVE = 'active';
    const STATE_SUSPENDED = 'suspended';

    public function __construct(array $data = [])
    {
        parent::__construct($data);
    }

    /**
     * @return string|null
     */
    public function getId()
    {
        return $this->get('id');
    }
    /**
     * @param string $id
     * @return $this
     */
    public function setId($id)
    {
        $this->set('id', $id);
        return $this;
    }
    /**
     * @return string
     */
    public function getPhoto()
    {
        return base64_decode($this->get('photo'));
    }
    /**
     * @param string $photo
     * @return $this
     */
    public function setPhoto($photo)
    {
        $this->set('photo', base64_encode($photo));
        return $this;
    }
    /**
     * @return string|null
     */
    public function getAvatar()
    {
        if ($this->get('avatar') === null) {
            return null;
        }
        return base64_decode($this->get('avatar'));
    }
    /**
     * @param string $avatar
     * @return $this
     */
    public function setAvatar($avatar)
    {
        if ($avatar === null) {
            $this->set('avatar', null);
            return $this;
        }
        $this->set('avatar', base64_encode($avatar));
        return $this;
    }
    /**
     * @return string|null
     */
    public function getParentId()
    {
        return $this->get('parent_id');
    }
    /**
     * @param string $parentId
     * @return $this
     */
    public function setParentId($parentId)
    {
        $this->set('parent_id', $parentId);
        return $this;
    }
    /**
     * @return string[]
     */
    public function getTitles()
    {
        return $this->get('titles');
    }
    /**
     * @param string[] $titles
     * @return $this
     */
    public function setTitles(array $titles)
    {
        $this->set('titles', $titles);
        return $this;
    }
    /**
     * @return string|null
     */
    public function getStatus()
    {
        return $this->get('status');
    }
    /**
     * @param string $status
     * @return $this
     */
    public function setStatus($status)
    {
        $this->set('status', $status);
        return $this;
    }
    /**
     * @return boolean|null
     */
    public function isEnabled()
    {
        return $this->get('enabled');
    }
    /**
     * @param boolean $enabled
     * @return $this
     */
    public function setEnabled($enabled)
    {
        $this->set('enabled', $enabled);
        return $this;
    }
    /**
     * @return \DateTimeImmutable|null
     */
    public function getUpdatedAt()
    {
        if ($this->get('updated_at') === null) {
            return null;
        }
        return \DateTimeImmutable::createFromFormat('Y-m-d\TH:i:sP', $this->get('updated_at'));
    }
    /**
     * @param \DateTimeInterface $updatedAt
     * @return $this
     */
    public function setUpdatedAt(\DateTimeInterface $updatedAt)
    {
        $this->set('updated_at', $updatedAt->format('Y-m-d\TH:i:sP'));
        return $this;
    }
    /**
     * @return Keyword|null
     */
    public function getKeyword()
    {
        if ($this->get('keyword') === null) {
            return null;
        }
        return (new Keyword())->setDataByReference($this->getByReference('keyword'));
    }
    /**
     * @param Keyword $keyword
     * @return $this
     */
    public function setKeyword(Keyword $keyword)
    {
        $this->setByReference('keyword', $keyword->getDataByReference());
        return $this;
    }
    /**
     * @return boolean|null
     */
    public function isArchived()
    {
        return $this->get('archived');
    }
    /**
     * @param boolean $archived
     * @return $this
     */
    public function setArchived($archived)
    {
        $this->set('archived', $archived);
        return $this;
    }
    /**
     * @return integer|null
     */
    public function getScore()
    {
        return $this->get('score');
    }
    /**
     * @param integer $score
     * @return $this
     */
    public function setScore($score)
    {
        $this->set('score', $score);
        return $this;
    }
    /**
     * @return string|null
     */
    public function getNickname()
    {
        return $this->get('nickname');
    }
    /**
     * @param string $nickname
     * @return $this
     */
    public function setNickname($nickname)
    {
        $this->set('nickname', $nickname);
        return $this;
    }
    /**
     * @return string[]|null
     */
    public function getTags()
    {
        return $this->get('tags');
    }
    /**
     * @param string[] $tags
     * @return $this
     */
    public function setTags(array $tags)
    {
        $this->set('tags', $tags);
        return $this;
    }
    /**
     * @return string|null
     */
    public function getState()
    {
        return $this->get('state');
    }
    /**
     * @param string $state
     * @return $this
     */
    public function setState($state)
    {
        $this->set('state', $state);
        return $this;
    }
    /**
     * @return object|null
     */
    public function getPayload()
    {
return $this->getByReference('payload');
    }
    /**
     * @param object $payload
     * @return $this
     */
    public function setPayload($payload)
    {
        $this->setByReference('payload', $payload);
        return $this;
    }
    /**
     * @return string|null
     */
    public function getAttachment()
    {
        if ($this->get('attachment') === null) {
            return null;
        }
        return base64_decode($this->get('attachment'));
    }
    /**
     * @param string $attachment
     * @return $this
     */
    public function setAttachment($attachment)
    {
        if ($attachment === null) {
            $this->set('attachment', null);
            return $this;
        }
        $this->set('attachment', base64_encode($attachment));
        return $this;
    }
    /**
     * @return Money|null
     */
    public function getPrice()
    {
        if (!isset($this->get('price')['amount']) || !isset($this->get('price')['currency'])) {
            return null;
        }
        return new Money($this->get('price')['amount'], $this->get('price')['currency']);
    }
    /**
     * @param Money $price
     * @return $this
     */
    public function setPrice(Money $price)
    {
        $this->set('price', ['amount' => $price->getAmount(), 'currency' => $price->getCurrency()]);
        return $this;
    }
    /**
     * @return \DateTimeImmutable|null
     */
    public function getClosedAt()
    {
        if ($this->get('closed_at') === null) {
            return null;
        }
        return (new \DateTimeImmutable())->setTimestamp($this->get('closed_at'));
    }
    /**
     * @param \DateTimeInterface $closedAt
     * @return $this
     */
    public function setClosedAt(\DateTimeInterface $closedAt)
    {
        $this->set('closed_at', $closedAt->getTimestamp());
        return $this;
    }
}
