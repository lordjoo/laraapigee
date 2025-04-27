<?php

namespace Lordjoo\LaraApigee\Api\ApigeeX\Entities\Structure;

use Lordjoo\LaraApigee\Entities\Structure\BaseObject;

class Operation extends BaseObject
{
    protected string $resource;

    protected array $methods = [];

    public function getResource(): string
    {
        return $this->resource;
    }

    public function setResource(string $resource): void
    {
        $this->resource = $resource;
    }

    public function getMethods(): array
    {
        return $this->methods;
    }

    public function setMethods(array $methods): void
    {
        $this->methods = $methods;
    }
}
