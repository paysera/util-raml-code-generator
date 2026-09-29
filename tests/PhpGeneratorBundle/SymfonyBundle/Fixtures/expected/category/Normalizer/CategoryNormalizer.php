<?php

namespace Vendor\Test\CategoryApiBundle\Normalizer;

use Evp\Component\Money\MoneyNormalizer;
use Paysera\Component\Serializer\Normalizer\DenormalizerInterface;
use Paysera\Component\Serializer\Normalizer\NormalizerInterface;
use Vendor\Test\CategoryApiBundle\Entity\Category;

class CategoryNormalizer implements NormalizerInterface, DenormalizerInterface
{
    private $keywordNormalizer;
    private $moneyNormalizer;
    
    public function __construct(
        KeywordNormalizer $keywordNormalizer,
        MoneyNormalizer $moneyNormalizer
    ) {
        $this->keywordNormalizer = $keywordNormalizer;
        $this->moneyNormalizer = $moneyNormalizer;
    }
    
    /**
     * @param array $data
     *
     * @return Category
     */
    public function mapToEntity($data)
    {
        $entity = new Category();

        if (isset($data['parent_id'])) {
            $entity->setParentId($data['parent_id']);
        }
        if (isset($data['titles'])) {
            $entity->setTitles($data['titles']);
        }
        if (isset($data['status'])) {
            $entity->setStatus($data['status']);
        }
        if (isset($data['enabled'])) {
            $entity->setEnabled($data['enabled']);
        }
        if (isset($data['updated_at'])) {
            $entity->setUpdatedAt(\DateTime::createFromFormat('Y-m-d\TH:i:sP', $data['updated_at']));
        }
        if (isset($data['keyword'])) {
            $entity->setKeyword($this->keywordNormalizer->mapToEntity($data['keyword']));
        }
        if (isset($data['archived'])) {
            $entity->setArchived($data['archived']);
        }
        if (isset($data['score'])) {
            $entity->setScore($data['score']);
        }
        if (isset($data['nickname'])) {
            $entity->setNickname($data['nickname']);
        }
        if (isset($data['tags'])) {
            $entity->setTags($data['tags']);
        }
        if (isset($data['state'])) {
            $entity->setState($data['state']);
        }
        if (isset($data['payload'])) {
            $entity->setPayload($data['payload']);
        }
        if (isset($data['price'])) {
            $entity->setPrice($this->moneyNormalizer->mapToEntity($data['price']));
        }
        if (isset($data['closed_at'])) {
            $entity->setClosedAt((new \DateTime())->setTimestamp($data['closed_at']));
        }
        
        return $entity;
    }

    /**
     * @param Category $entity
     *
     * @return array
     */
    public function mapFromEntity($entity)
    {
        return [
            'id' => $entity->getId(),
            'parent_id' => $entity->getParentId(),
            'titles' => $entity->getTitles(),
            'status' => $entity->getStatus(),
            'enabled' => $entity->isEnabled(),
            'updated_at' => $entity->getUpdatedAt() !== null ? $entity->getUpdatedAt()->format('Y-m-d\TH:i:sP') : null,
            'keyword' => $entity->getKeyword() !== null ? $this->keywordNormalizer->mapFromEntity($entity->getKeyword()) : null,
            'archived' => $entity->isArchived(),
            'score' => $entity->getScore(),
            'nickname' => $entity->getNickname(),
            'tags' => $entity->getTags(),
            'state' => $entity->getState(),
            'payload' => $entity->getPayload(),
            'price' => $entity->getPrice() !== null ? $this->moneyNormalizer->mapFromEntity($entity->getPrice()) : null,
            'closed_at' => $entity->getClosedAt() !== null ? $entity->getClosedAt()->getTimestamp() : null,
            
        ];
    }
}
