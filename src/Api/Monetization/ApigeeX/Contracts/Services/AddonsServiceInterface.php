<?php

namespace Lordjoo\LaraApigee\Api\Monetization\ApigeeX\Contracts\Services;

use Lordjoo\LaraApigee\Api\Monetization\ApigeeX\Entities\AddonsConfig;
use Lordjoo\LaraApigee\Contracts\Services\EntityServiceInterface;

interface AddonsServiceInterface extends EntityServiceInterface
{
    public function get(): AddonsConfig;

    /**
     * @return array<string, mixed>
     */
    public function setMonetizationEnabled(bool $enabled): array;
}
