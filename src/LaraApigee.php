<?php

namespace Lordjoo\LaraApigee;

use Lordjoo\LaraApigee\Api\ApigeeX\ApigeeX;
use Lordjoo\LaraApigee\Api\Edge\Edge;
use Lordjoo\LaraApigee\ConfigReaders\ConfigDriver;

class LaraApigee
{
    protected ConfigDriver $config;

    public function __construct()
    {
        $this->config = app(ConfigDriver::class);
    }

    /**
     * @return Edge
     */
    public function edge(): Edge
    {
        return new Edge($this->config);
    }

    public function apigeeX(): ApigeeX
    {
        return new ApigeeX($this->config);
    }
}
