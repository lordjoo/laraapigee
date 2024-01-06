<?php

namespace Lordjoo\Apigee\Abstract\Edge;

use Lordjoo\Apigee\Abstract\BaseEntity;
use Lordjoo\Apigee\Api\Edge\ApigeeEdge;
use Lordjoo\Apigee\Apigee;

abstract class Entity extends BaseEntity
{

    protected ApigeeEdge $client;

    public function __construct(array $data)
    {
        $this->client = app(ApigeeEdge::class);
        parent::__construct($data);
    }


}
