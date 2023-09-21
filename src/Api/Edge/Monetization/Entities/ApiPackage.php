<?php

namespace Lordjoo\Apigee\Api\Edge\Monetization\Entities;

class ApiPackage extends Entity
{
    public string $id;

    public string $name;

    public string $displayName;

    public string $description;

    public string $status;

    public array $product;

    public Organization $organization;

    public function __construct(array $data)
    {
        parent::__construct($data);
        $this->product = array_map(function ($item) {
            return new ApiProduct($item);
        }, $this->product);
    }
}
