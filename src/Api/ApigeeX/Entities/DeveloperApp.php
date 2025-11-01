<?php

namespace Lordjoo\LaraApigee\Api\ApigeeX\Entities;

use Lordjoo\LaraApigee\Api\Edge\Entities\DeveloperApp as EdgeDeveloperApp;

class DeveloperApp extends EdgeDeveloperApp
{
    public array $apiProducts = [];

    public function setApiProducts(array $apiProducts): self
    {
        $this->apiProducts = $apiProducts;
        return $this;
    }

    public function getApiProducts(): array
    {
        return $this->apiProducts;
    }

    public function setInitialApiProducts(array $initialApiProducts): self
    {
        return $this->setApiProducts($initialApiProducts);
    }

    public function getInitialApiProducts(): array
    {
        return $this->getApiProducts();
    }
}
