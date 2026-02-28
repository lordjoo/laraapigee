<?php

namespace Lordjoo\LaraApigee\Api\ApigeeX\Entities\Structure;

use Lordjoo\LaraApigee\Entities\Structure\BaseObject;

class Quota extends BaseObject
{

    protected string $limit;
    protected string $interval;
    protected string $timeUnit;

    public function getLimit(): string
    {
        return $this->limit;
    }

    public function setLimit(string $limit): void
    {
        $this->limit = $limit;
    }

    public function getInterval(): string
    {
        return $this->interval;
    }

    public function setInterval(string $interval): void
    {
        $this->interval = $interval;
    }

    public function getTimeUnit(): string
    {
        return $this->timeUnit;
    }

    public function setTimeUnit(string $timeUnit): void
    {
        $this->timeUnit = $timeUnit;
    }
}
