<?php

namespace Lordjoo\LaraApigee\Api\Monetization\Edge\Entities;

class SimpleReference extends AbstractEdgeMonetizationEntity
{
    protected ?string $id = null;

    public function getId(): ?string
    {
        return $this->id;
    }

    public function setId(?string $id): self
    {
        $this->id = $id;

        return $this;
    }
}
