<?php

namespace Lordjoo\Apigee;

use Illuminate\Http\Client\PendingRequest;
use Illuminate\Support\Facades\Http;
use Lordjoo\Apigee\Api\ApigeeX\ApigeeX;
use Lordjoo\Apigee\Api\Edge\ApigeeEdge;
use Lordjoo\Apigee\ConfigReaders\ConfigReaderInterface;
use Lordjoo\Apigee\Support\MakesHttpRequests;

/**
 * Class Apigee
 *
 * @method static Apigee init()
 */
class Apigee
{

    protected $client;

    public function __construct() {
        $type = config('apigee.type');
        if (!in_array($type, ['edge', 'x'])) {
            throw new \Exception('Invalid Apigee type');
        }
        $this->client = $type === 'edge' ? new ApigeeEdge() : new ApigeeX();
    }

    public function client(): ApigeeEdge | ApigeeX
    {
        return $this->client;
    }

    public function __call(string $name, array $arguments)
    {
        return $this->client()->$name(...$arguments);
    }

}
