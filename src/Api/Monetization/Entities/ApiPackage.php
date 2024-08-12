<?php

namespace Lordjoo\LaraApigee\Api\Monetization\Entities;

use Lordjoo\LaraApigee\Api\Monetization\Entities\Properties\ApiProductsPropertyAwareTrait;
use Lordjoo\LaraApigee\Api\Monetization\Entities\Properties\OrganizationPropertyAwareTrait;
use Lordjoo\LaraApigee\Entities\BaseEntity;
use Lordjoo\LaraApigee\Entities\Properties\DescriptionPropertyAwareTrait;
use Lordjoo\LaraApigee\Entities\Properties\DisplayNamePropertyAwareTrait;
use Lordjoo\LaraApigee\Entities\Properties\NamePropertyAwareTrait;
use Lordjoo\LaraApigee\Entities\Properties\StatusPropertyAwareTrait;

class ApiPackage extends BaseEntity
{
    use NamePropertyAwareTrait,
        DisplayNamePropertyAwareTrait,
        DescriptionPropertyAwareTrait,
        StatusPropertyAwareTrait,
        OrganizationPropertyAwareTrait,
        ApiProductsPropertyAwareTrait;
}
