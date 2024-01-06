<?php

namespace Lordjoo\Apigee\ConfigReaders;

interface ConfigReaderInterface
{
    public function getOrganization(): string;

    public function getEndpoint(): string;

    public function getUserName(): string;

    public function getPassword(): string;

    public function getMonetizationEnabled(): bool;

    public function getMonetizationEndpoint(): string;

    public function getKeyFile(): string;
}
