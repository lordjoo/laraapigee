<?php

namespace Lordjoo\LaraApigee\Tests\Support;

use Lordjoo\LaraApigee\ConfigReaders\ConfigDriver;

class FakeConfigDriver extends ConfigDriver
{
    public function getOrganization(): string
    {
        return 'test-org';
    }

    public function getEndpoint(): string
    {
        return 'https://example.test/v1';
    }

    public function getUserName(): string
    {
        return 'user';
    }

    public function getPassword(): string
    {
        return 'pass';
    }

    public function getMonetizationEnabled(): bool
    {
        return true;
    }

    public function getMonetizationEndpoint(): string
    {
        return 'https://example.test/v1/mint';
    }

    public function getKeyFile(): string
    {
        return __FILE__;
    }

    public function get(string $key): string
    {
        return '';
    }

    public function getMonetizationPlatform(): string
    {
        return 'edge';
    }
}
