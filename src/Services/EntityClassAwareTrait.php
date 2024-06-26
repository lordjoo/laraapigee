<?php

namespace Lordjoo\LaraApigee\Services;

trait EntityClassAwareTrait
{
    abstract public function getEntityClass(): string;
}
