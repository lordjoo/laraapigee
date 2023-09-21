<?php

namespace Lordjoo\Apigee\Abstract;

abstract class ApigeeDriver
{
    abstract public function get(string $url, array $query = [], array $headers = []);

    abstract public function post(string $url, array $data = [], array $headers = []);

    abstract public function put(string $url, array $data = [], array $headers = []);

    abstract public function delete(string $url, array $data = [], array $headers = []);
}
