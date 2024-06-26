<?php

namespace Lordjoo\LaraApigee\Services;

use Lordjoo\LaraApigee\HttpClient\HttpClient;

trait ClientAwareTrait
{
    abstract public function getClient(): HttpClient;
}
