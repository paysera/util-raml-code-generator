<?php

namespace Paysera\Test\NullableUnionClient\Entity;

use Paysera\Component\RestClientCommon\Entity\Entity;

class Order extends Entity
{
    public function __construct(array $data = [])
    {
        parent::__construct($data);
    }

    /**
     * @return string
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
    public function getNote()
    {
        return $this->get('note');
    }
    /**
     * @param string $note
     * @return $this
     */
    public function setNote($note)
    {
        $this->set('note', $note);
        return $this;
    }
    /**
     * @return string|null
     */
    public function getDiscount()
    {
        return $this->get('discount');
    }
    /**
     * @param string $discount
     * @return $this
     */
    public function setDiscount($discount)
    {
        $this->set('discount', $discount);
        return $this;
    }
    /**
     * @return OrderLine|null
     */
    public function getLine()
    {
        if ($this->get('line') === null) {
            return null;
        }
        return (new OrderLine())->setDataByReference($this->getByReference('line'));
    }
    /**
     * @param OrderLine $line
     * @return $this
     */
    public function setLine(OrderLine $line)
    {
        $this->setByReference('line', $line->getDataByReference());
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
     * @return OrderLine[]
     */
    public function getLines()
    {
        $items = $this->getByReference('lines');
        if ($items === null) {
            return [];
        }

        $list = [];
        foreach($items as &$item) {
            $list[] = (new OrderLine())->setDataByReference($item);
        }

        return $list;
    }
    /**
     * @param OrderLine[] $lines
     * @return $this
     */
    public function setLines(array $lines)
    {
        $data = [];
        foreach($lines as $item) {
            $data[] = $item->getDataByReference();
        }
        $this->setByReference('lines', $data);
        return $this;
    }
}
