<?php

namespace Lordjoo\LaraApigee\Api\ApigeeX\Entities;

use Lordjoo\LaraApigee\Entities\BaseEntity;

class KeyValueMap extends BaseEntity
{
    protected string $name;

    protected ?bool $maskedValues = null;

    protected ?bool $encrypted = null;

    public function getName(): string
    {
        return $this->name;
    }

    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }

    public function getMaskedValues(): ?bool
    {
        return $this->maskedValues;
    }

    public function setMaskedValues(?bool $maskedValues): self
    {
        $this->maskedValues = $maskedValues;

        return $this;
    }

    public function getEncrypted(): ?bool
    {
        return $this->encrypted;
    }

    public function setEncrypted(?bool $encrypted): self
    {
        $this->encrypted = $encrypted;

        return $this;
    }
}
