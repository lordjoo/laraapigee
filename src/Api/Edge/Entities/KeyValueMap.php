<?php

namespace Lordjoo\LaraApigee\Api\Edge\Entities;

use Lordjoo\LaraApigee\Entities\BaseEntity;
use Lordjoo\LaraApigee\Entities\Properties\NamePropertyAwareTrait;
use Lordjoo\LaraApigee\Entities\Structure\AttributesProperty;

class KeyValueMap extends BaseEntity
{
    use NamePropertyAwareTrait;

    /**
     * @var bool
     */
    protected bool $encrypted;

    /**
     * @var AttributesProperty
     */
    protected AttributesProperty $entry;


    /**
     * @return bool
     */
    public function isEncrypted(): bool
    {
        return $this->encrypted;
    }

    /**
     * @param bool $encrypted
     * @return $this
     */
    public function setEncrypted(bool $encrypted): static
    {
        $this->encrypted = $encrypted;
        return $this;
    }

    /**
     * @return AttributesProperty
     */
    public function getEntry(): AttributesProperty
    {
        return $this->entry;
    }

    /**
     * @param AttributesProperty $entry
     * @return $this
     */
    public function setEntry(AttributesProperty $entry): static
    {
        $this->entry = $entry;
        return $this;
    }

}
