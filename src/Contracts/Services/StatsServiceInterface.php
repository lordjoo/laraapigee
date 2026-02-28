<?php

namespace Lordjoo\LaraApigee\Contracts\Services;

use Carbon\Carbon;
use Illuminate\Support\Collection;

interface StatsServiceInterface
{
    /**
     * Get traffic stats for dimensions and metrics in a given time range.
     *
     * @param array<int, string> $dimensions
     * @param array<int, string> $metrics
     * @param array{0: Carbon, 1: Carbon} $timeRange
     * @param string|null $filter
     * @param array<string, scalar|array|null> $options
     * @return Collection<int, array<string, mixed>>
     */
    public function traffic(
        array $dimensions,
        array $metrics,
        array $timeRange,
        ?string $filter = null,
        array $options = []
    ): Collection;
}
