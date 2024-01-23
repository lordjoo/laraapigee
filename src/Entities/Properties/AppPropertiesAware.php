<?php

namespace Lordjoo\Apigee\Entities\Properties;

use Carbon\Carbon;

trait AppPropertiesAware
{
    public string $name;

    public string $status;

    public string $appFamily;

    public array $scopes;

    public ?string $callbackUrl;

    public string $createdBy;

    public Carbon|string $createdAt;

    public string $lastModifiedBy;

    public Carbon|string $lastModifiedAt;
}
