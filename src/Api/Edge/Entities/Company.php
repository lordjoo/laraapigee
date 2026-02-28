<?php

namespace Lordjoo\LaraApigee\Api\Edge\Entities;

use Lordjoo\LaraApigee\Entities\BaseEntity;
use Lordjoo\LaraApigee\Entities\Properties\AttributesPropertyAwareTrait;
use Lordjoo\LaraApigee\Entities\Properties\CommonEntityPropertiesAwareTrait;
use Lordjoo\LaraApigee\Entities\Properties\DescriptionPropertyAwareTrait;
use Lordjoo\LaraApigee\Entities\Properties\DisplayNamePropertyAwareTrait;
use Lordjoo\LaraApigee\Entities\Properties\NamePropertyAwareTrait;
use Lordjoo\LaraApigee\Entities\Properties\StatusPropertyAwareTrait;

class Company extends BaseEntity
{
    use NamePropertyAwareTrait,
        DescriptionPropertyAwareTrait,
        DisplayNamePropertyAwareTrait,
        StatusPropertyAwareTrait,
        AttributesPropertyAwareTrait,
        CommonEntityPropertiesAwareTrait;



}
