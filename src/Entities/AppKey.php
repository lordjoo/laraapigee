<?php

namespace Lordjoo\Apigee\Entities;

use Carbon\Carbon;
use Lordjoo\Apigee\Abstract\BaseEntity;
use Lordjoo\Apigee\Entities\Properties\AttributePropertyAware;

class AppKey extends BaseEntity
{
    use AttributePropertyAware;

    public string $appName;

    public ?string $companyName;

    public ?string $developerId;

    public string $consumerKey;

    public string $consumerSecret;

    public string $status;

    public array $scopes;

    public array $apiProducts;

    public Carbon|string $expiresAt;

    public Carbon|string $issuedAt;
}
