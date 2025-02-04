<?php

namespace Lordjoo\LaraApigee;

use Lordjoo\LaraApigee\Api\ApigeeX\ApigeeX;
use Lordjoo\LaraApigee\Api\Edge\Edge;
use Lordjoo\LaraApigee\Api\Monetization\Monetization;
use Lordjoo\LaraApigee\ConfigReaders\ConfigDriver;

class LaraApigee
{
    protected ConfigDriver $config;

    public function __construct(ConfigDriver $config)
    {
        $this->config = $config;
    }

    /**
     * @return Edge
     */
    public function edge(): Edge
    {
        return new Edge($this->config);
    }

    /**
     * @return ApigeeX
     */
    public function apigeeX(): ApigeeX
    {
        return new ApigeeX($this->config);
    }

    public function monetization(): Monetization
    {
        return new Monetization($this->config);
    }

    /**
     * @param string $platform edge|apigeex|monetization
     * @return Edge|ApigeeX
     */
    public function platform(string $platform): Edge|ApigeeX
    {
        if ($platform === 'edge') {
            return $this->edge();
        } elseif ($platform === 'apigeex') {
            return $this->apigeeX();
        } else {
            throw new \InvalidArgumentException("Invalid platform specified: $platform");
        }
    }

}
