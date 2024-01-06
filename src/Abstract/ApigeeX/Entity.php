<?php

namespace Lordjoo\Apigee\Abstract\ApigeeX;

use Lordjoo\Apigee\Abstract\BaseEntity;
use Lordjoo\Apigee\Api\ApigeeX\ApigeeX;

abstract class Entity extends BaseEntity
{

    /**
     * @var ApigeeX
     */
    private ApigeeX $client;

    public function __construct(array $data)
    {
        $this->client = app(ApigeeX::class);
        parent::__construct($data);
    }

}
