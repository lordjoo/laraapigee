<?php

namespace Lordjoo\LaraApigee\Services;

use Lordjoo\LaraApigee\Utility\URLTemplate;

trait EntityEndpointAwareTrait
{
    abstract public function getEntityPath(?string $path = null): URLTemplate;
}
