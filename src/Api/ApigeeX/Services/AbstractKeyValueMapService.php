<?php

namespace Lordjoo\LaraApigee\Api\ApigeeX\Services;

use Lordjoo\LaraApigee\Api\ApigeeX\Contracts\Services\KeyValueMapServiceInterface;
use Lordjoo\LaraApigee\Api\ApigeeX\Entities\KeyValueEntry;
use Lordjoo\LaraApigee\Api\ApigeeX\Entities\KeyValueMap;
use Lordjoo\LaraApigee\Services\BaseService;

abstract class AbstractKeyValueMapService extends BaseService implements KeyValueMapServiceInterface
{
    public function get(string $name): KeyValueMap
    {
        $response = $this->getClient()->get($this->keyValueMapPath($name));

        return $this->hydrateKeyValueMap($response);
    }

    public function create(KeyValueMap $map): KeyValueMap
    {
        $response = $this->getClient()->post($this->keyValueMapCollectionPath(), [
            'json' => $this->getSerializer()->normalize($map, 'json'),
        ]);

        return $this->hydrateKeyValueMap($response);
    }

    public function update(string $name, KeyValueMap $map): KeyValueMap
    {
        $map->setName($name);

        $response = $this->getClient()->put($this->keyValueMapPath($name), [
            'json' => $this->getSerializer()->normalize($map, 'json'),
        ]);

        return $this->hydrateKeyValueMap($response);
    }

    public function delete(string $name): bool
    {
        $this->getClient()->delete($this->keyValueMapPath($name));

        return true;
    }

    public function listEntries(string $mapName, array $query = []): array
    {
        $response = $this->getClient()->get($this->entryCollectionPath($mapName), [
            'query' => $query,
        ]);

        $payload = json_decode($response->getBody()->getContents(), true) ?? [];
        $entries = collect($payload['keyValueEntries'] ?? [])->map(function (array $entry) {
            return $this->getSerializer()->denormalize($entry, KeyValueEntry::class, 'json');
        });

        return [
            'keyValueEntries' => $entries,
            'nextPageToken' => $payload['nextPageToken'] ?? null,
        ];
    }

    public function getEntry(string $mapName, string $entryName): KeyValueEntry
    {
        $response = $this->getClient()->get($this->entryPath($mapName, $entryName));

        return $this->hydrateKeyValueEntry($response);
    }

    public function createEntry(string $mapName, KeyValueEntry $entry): KeyValueEntry
    {
        $response = $this->getClient()->post($this->entryCollectionPath($mapName), [
            'json' => $this->getSerializer()->normalize($entry, 'json'),
        ]);

        return $this->hydrateKeyValueEntry($response);
    }

    public function updateEntry(string $mapName, string $entryName, KeyValueEntry $entry): KeyValueEntry
    {
        $entry->setName($entryName);

        $response = $this->getClient()->put($this->entryPath($mapName, $entryName), [
            'json' => $this->getSerializer()->normalize($entry, 'json'),
        ]);

        return $this->hydrateKeyValueEntry($response);
    }

    public function deleteEntry(string $mapName, string $entryName): bool
    {
        $this->getClient()->delete($this->entryPath($mapName, $entryName));

        return true;
    }

    protected function keyValueMapPath(string $name): string
    {
        return $this->keyValueMapCollectionPath() . '/' . rawurlencode($name);
    }

    protected function entryCollectionPath(string $mapName): string
    {
        return $this->keyValueMapPath($mapName) . '/entries';
    }

    protected function entryPath(string $mapName, string $entryName): string
    {
        return $this->entryCollectionPath($mapName) . '/' . rawurlencode($entryName);
    }

    protected function hydrateKeyValueMap($response): KeyValueMap
    {
        return $this->getSerializer()->denormalize(
            json_decode($response->getBody()->getContents(), true),
            KeyValueMap::class,
            'json'
        );
    }

    protected function hydrateKeyValueEntry($response): KeyValueEntry
    {
        return $this->getSerializer()->denormalize(
            json_decode($response->getBody()->getContents(), true),
            KeyValueEntry::class,
            'json'
        );
    }

    abstract protected function keyValueMapCollectionPath(): string;
}
