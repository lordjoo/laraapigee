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

    public function getMonetizationEnabled(): bool
    {
        return config('apigee.monetization.enabled', false);
    }

    public function getMonetizationEndpoint(): string
    {
        return config('apigee.monetization.endpoint', '');
    }
}
