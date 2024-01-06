<?php

namespace Lordjoo\Apigee\Api\Edge\Entities;

use Lordjoo\Apigee\Abstract\Edge\Entity;

class ApiProxy extends Entity
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
