<?php

namespace Lordjoo\LaraApigee\ConfigReaders;

class ConfigFileDriver extends ConfigDriver
{
    public function getOrganization(): string
    {
        return config('laraapigee.organization');
    }

    public function getEndpoint(): string
    {
        return config('laraapigee.endpoint');
    }

    public function getUserName(): string
    {
        return config('laraapigee.username');
    }

    public function getPassword(): string
    {
        return config('laraapigee.password');
    }

    public function getMonetizationEnabled(): bool
    {
        return config('laraapigee.monetization.enabled', false);
    }

    public function getMonetizationEndpoint(): string
    {
        return config('laraapigee.monetization.endpoint', '');
    }

    public function getMonetizationPlatform(): string
    {
        return config('laraapigee.monetization.platform', 'edge');
    }

    public function getKeyFile(): string
    {
        return config('laraapigee.key_file', '');
    }


    public function get(string $key): string
    {
        return config("laraapigee.$key");
    }
}
