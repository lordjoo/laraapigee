<?php

namespace Lordjoo\LaraApigee\Api\ApigeeX\Services;

use Carbon\Carbon;
use Illuminate\Support\Collection;
use Lordjoo\LaraApigee\ConfigReaders\ConfigDriver;
use Lordjoo\LaraApigee\Contracts\Services\StatsServiceInterface;
use Lordjoo\LaraApigee\HttpClient\HttpClient;
use Lordjoo\LaraApigee\Services\BaseService;
use Lordjoo\LaraApigee\Services\ClientAwareTrait;
use Lordjoo\LaraApigee\Services\EntityEndpointAwareTrait;
use Lordjoo\LaraApigee\Utility\URLTemplate;

class StatsService extends BaseService implements StatsServiceInterface
{
    use EntityEndpointAwareTrait, ClientAwareTrait;

    public function __construct(HttpClient $httpClient, ConfigDriver $config, protected string $environment)
    {
        parent::__construct($httpClient, $config);
    }


    public function getEntityPath(?string $path = null): URLTemplate
    {
        return (new URLTemplate('environments/{environment}/stats/'))
            ->bindParam('environment', $this->environment)
            ->appendPath($path);
    }

    /**
     * Get traffic data for the given dimensions and metrics.
     *
     * @param array $dimensions
     * @param array $metrics
     * @param Carbon[] $timeRange
     * @param string|null $filter
     * @return Collection
     */
    public function traffic(array $dimensions, array $metrics, array $timeRange, string $filter = null,array $options = []): Collection
    {
        if (count($timeRange) > 2) {
            throw new \InvalidArgumentException('Time range must be an array of 2 Carbon instances.');
        }

        $from = $timeRange[0]->format('m/d/Y H:i');
        $to = $timeRange[1]->format('m/d/Y H:i');

        // check if time range exceeds maximum 92 days
        $days = $timeRange[0]->diffInDays($timeRange[1]);
        if ($days > 92) {
            throw new \InvalidArgumentException('Time range exceeds maximum of 92 days.');
        }

        $timeRange = "$from~$to";
        $response = $this->getClient()->get(
            $this->getEntityPath(implode(',', $dimensions))->getURL(), [
            'query' => [
                'select' => implode(',', $metrics),
                'timeRange' => $timeRange,
                'sortby' => implode(',', $metrics),
                'filter' => $filter,
                ...$options
            ]
        ]);

        $data = json_decode($response->getBody(), true);

        return collect($data['environments'][0]['dimensions'] ?? []);
    }
}
