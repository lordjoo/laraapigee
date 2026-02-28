<?php

namespace Lordjoo\LaraApigee\Api\Monetization\Edge\Entities;

class ApiProducts extends AbstractEdgeMonetizationEntity
{
    /** @var array<int, ApiProduct> */
    protected array $product = [];

    public function getProduct(): array
    {
        return $this->product;
    }

    public function setProduct(array $product): self
    {
        $this->product = $this->castNestedEntityArray($product, ApiProduct::class);

        return $this;
    }
}
