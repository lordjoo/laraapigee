<?php

namespace Lordjoo\LaraApigee\Api\Monetization\ApigeeX\Contracts\Services;

use Lordjoo\LaraApigee\Api\Monetization\ApigeeX\Entities\DeveloperMonetizationConfig;
use Lordjoo\LaraApigee\Contracts\Services\EntityServiceInterface;

interface DeveloperMonetizationConfigServiceInterface extends EntityServiceInterface
{
    public function get(): DeveloperMonetizationConfig;

    public function update(DeveloperMonetizationConfig $config): DeveloperMonetizationConfig;
}
