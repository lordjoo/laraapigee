<?php

namespace Lordjoo\LaraApigee\ConfigReaders;

abstract class ConfigDriver
{

    public function toArray(): array
    {
        $re = new \ReflectionClass($this);
        $properties = $re->getMethods();
        $config = [];
        foreach ($properties as $property) {
            if (strpos($property->name, 'get') === 0) {
                $config[strtolower(lcfirst(substr($property->name, 3)))] = $this->{$property->name}();
            }
        }
        return $config;
    }

    abstract public function getOrganization(): string;

    abstract public function getEndpoint(): string;

    abstract public function getUserName(): string;

    abstract public function getPassword(): string;

    abstract public function getMonetizationEnabled(): bool;

    abstract public function getMonetizationEndpoint(): string;

    abstract public function getKeyFile(): string;

}