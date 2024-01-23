<?php

namespace Lordjoo\Apigee\Entities;

use Lordjoo\Apigee\Abstract\BaseEntity;

class ApiProxy extends BaseEntity
{
    public string $name;

    public array $metaData;

    public function __get(string $name)
    {
        if (array_key_exists($name, $this->metaData)) {
            return $this->metaData[$name];
        }
        throw new \Exception("Property $name does not exist");
    }
}
