<?php

namespace Lordjoo\Apigee\ConfigReaders;

class ConfigFileDriver implements ConfigReaderInterface
{
    public function getOrganization(): string
    {
        return config('apigee.organization');
    }

    public function getEndpoint(): string
    {
        return config('apigee.endpoint');
    }

    public function getUserName(): string
    {
        return config('apigee.username');
    }

    public function getPassword(): string
    {
        return config('apigee.password');
    }
}
