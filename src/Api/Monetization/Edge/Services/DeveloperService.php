<?php

namespace Lordjoo\LaraApigee\Api\Monetization\Edge\Services;

use Illuminate\Support\Collection;
use Lordjoo\LaraApigee\Api\Monetization\Edge\Contracts\Services\DeveloperServiceInterface;
use Lordjoo\LaraApigee\Api\Monetization\Edge\Entities\Developer;
use Lordjoo\LaraApigee\Api\Monetization\Edge\Entities\Developers;

class DeveloperService extends AbstractEdgeMonetizationService implements DeveloperServiceInterface
{
    /**
     * @var array<string, string>
     */
    private const LIST_QUERY_SCHEMA = [
        'all' => 'bool',
        'size' => 'int',
        'page' => 'int',
    ];

    public function list(array $query = []): Developers
    {
        $payload = $this->getJson('developers', $this->validateQuery($query, self::LIST_QUERY_SCHEMA));

        return $this->denormalizeEntity($payload, Developers::class);
    }

    public function get(array $query = []): Collection
    {
        return collect($this->list($query)->getDeveloper());
    }

    public function find(string $developerEmail): ?Developer
    {
        $this->assertIdentifier($developerEmail, 'developerEmail');

        $payload = $this->getJsonOrNull($this->path('developers/{developerEmail}', [
            'developerEmail' => $developerEmail,
        ]));

        if ($payload === null) {
            return null;
        }

        return $this->denormalizeEntity($payload, Developer::class);
    }
}
