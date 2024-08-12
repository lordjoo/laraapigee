<?php

namespace Lordjoo\LaraApigee\Api\Monetization\Entities\Properties;

use Lordjoo\LaraApigee\Api\Monetization\Entities\ApiProduct;

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
