<?php

namespace Lordjoo\LaraApigee\HttpClient;

use Illuminate\Cache\Repository;
use Illuminate\Contracts\Cache\Store;

class StaticCache extends Repository
{

    protected array $cache = [];

    public function __construct() {}

    public function get($key, $default = null): mixed
    {
        return $this->cache[$key] ?? $default;
    }

    public function set($key, $value, $ttl = null): bool
    {
        $this->cache[$key] = $value;
        return true;
    }

    public function has($key): bool
    {
        return isset($this->cache[$key]);
    }

    public function put($key, $value, $ttl = null)
    {
        $this->cache[$key] = $value;
        return true;
    }
}
