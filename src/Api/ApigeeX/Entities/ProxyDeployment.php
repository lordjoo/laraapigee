<?php

namespace Lordjoo\LaraApigee\Api\ApigeeX\Entities;

use Carbon\Carbon;
use Lordjoo\LaraApigee\Entities\BaseEntity;

class ProxyDeployment extends BaseEntity
{
    protected string $revision;
    protected string $environment;
    protected string $apiProxy;
    protected Carbon $deployStartTime;

    public function setRevision(string $revision): void
    {
        $this->revision = $revision;
    }

    public function getRevision(): string
    {
        return $this->revision;
    }

    public function setEnvironment(string $environment): void
    {
        $this->environment = $environment;
    }

    public function getEnvironment(): string
    {
        return $this->environment;
    }

    public function setApiProxy(string $apiProxy): void
    {
        $this->apiProxy = $apiProxy;
    }

    public function getApiProxy(): string
    {
        return $this->apiProxy;
    }

    public function setDeployStartTime(Carbon $deployStartTime): void
    {
        $this->deployStartTime = $deployStartTime;
    }

    public function getDeployStartTime(): Carbon
    {
        return $this->deployStartTime;
    }

    public function getDeployStartTimeFormatted(): string
    {
        return $this->deployStartTime->format('Y-m-d H:i:s');
    }
}
