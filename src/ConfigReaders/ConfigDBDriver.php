<?php

namespace Lordjoo\LaraApigee\ConfigReaders;

use Illuminate\Database\Query\Builder;
use Illuminate\Support\Facades\DB;

class ConfigDBDriver extends ConfigDriver
{
    private array $data;

    public function __construct()
    {
        $this->setData();
    }

    public function getQuery(): Builder
    {
        $table = config('apigee.db.table_name');

        return DB::table($table)->newQuery();
    }

    public function setData(): void
    {
        $this->data = $this->getQuery()->first()->toArray();
    }

    public function getOrganization(): string
    {
        $col = config('apigee.db.columns.organization');

        return $this->data[$col];
    }

    public function getEndpoint(): string
    {
        $col = config('apigee.db.columns.endpoint');

        return $this->data[$col];
    }

    public function getUserName(): string
    {
        $col = config('apigee.db.columns.username');

        return $this->data[$col];
    }

    public function getPassword(): string
    {
        $col = config('apigee.db.columns.password');

        return $this->data[$col];
    }

    public function getMonetizationEnabled(): bool
    {
        $col = config('apigee.db.columns.monetization.enabled');

        return $this->data[$col];
    }

    public function getMonetizationEndpoint(): string
    {
        $col = config('apigee.db.columns.monetization.endpoint');

        return $this->data[$col];
    }

    public function getMonetizationPlatform(): string
    {
        $col = config('apigee.db.columns.monetization.platform');

        if ($col === null || !array_key_exists($col, $this->data)) {
            return 'edge';
        }

        return $this->data[$col] ?: 'edge';
    }

    public function getKeyFile(): string
    {
        $col = config('apigee.db.columns.key_file');

        return $this->data[$col];
    }

    public function get(string $key): string
    {
        return $this->data[$key];
    }
}
