<?php

namespace Lordjoo\LaraApigee\Api\ApigeeX\Entities;

use Lordjoo\LaraApigee\Entities\BaseEntity;

class KeyValueEntry extends BaseEntity
{
    protected string $name;

    protected string $value;

    public function getName(): string
    {
        return $this->name;
    }

    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }

    public function getValue(): string
    {
        return $this->value;
    }

    public function setValue(string $value): self
    {
        $this->value = $value;

        return $this;
    }
}
