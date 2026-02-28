<?php

namespace Lordjoo\LaraApigee\Api\ApigeeX\Contracts\Services;

use Illuminate\Support\Collection;
use Lordjoo\LaraApigee\Api\ApigeeX\Entities\KeyValueEntry;
use Lordjoo\LaraApigee\Api\ApigeeX\Entities\KeyValueMap;

interface KeyValueMapServiceInterface
{
    public function get(string $name): KeyValueMap;

    public function create(KeyValueMap $map): KeyValueMap;

    public function update(string $name, KeyValueMap $map): KeyValueMap;

    public function delete(string $name): bool;

    /**
     * @return array{
     *     keyValueEntries: Collection<int, KeyValueEntry>,
     *     nextPageToken: string|null
     * }
     */
    public function listEntries(string $mapName, array $query = []): array;

    public function getEntry(string $mapName, string $entryName): KeyValueEntry;

    public function createEntry(string $mapName, KeyValueEntry $entry): KeyValueEntry;

    public function updateEntry(string $mapName, string $entryName, KeyValueEntry $entry): KeyValueEntry;

    public function deleteEntry(string $mapName, string $entryName): bool;
}
