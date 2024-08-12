<?php

namespace Lordjoo\LaraApigee\Api\Edge\Entities;

use Lordjoo\LaraApigee\Entities\BaseEntity;
use Lordjoo\LaraApigee\Entities\Properties\CommonEntityPropertiesAwareTrait;
use Lordjoo\LaraApigee\Entities\Properties\DescriptionPropertyAwareTrait;
use Lordjoo\LaraApigee\Entities\Properties\DisplayNamePropertyAwareTrait;
use Lordjoo\LaraApigee\Entities\Properties\NamePropertyAwareTrait;

class Environment extends BaseEntity
{
    use NamePropertyAwareTrait,
        DisplayNamePropertyAwareTrait,
        DescriptionPropertyAwareTrait,
        CommonEntityPropertiesAwareTrait;
}
