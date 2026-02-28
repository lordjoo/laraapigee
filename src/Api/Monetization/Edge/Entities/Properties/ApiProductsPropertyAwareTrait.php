<?php

namespace Lordjoo\LaraApigee\Api\Monetization\Edge\Entities\Properties;

trait ApiProductsPropertyAwareTrait
{
    protected array $apiProducts = [];

    public function getApiProducts(): array
    {
        return $this->apiProducts;
    }

    public function setApiProducts(array $apiProducts): self
    {
        $this->apiProducts = $apiProducts;

        return $this;
    }
}
