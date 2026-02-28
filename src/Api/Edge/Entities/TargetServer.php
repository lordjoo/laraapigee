<?php

namespace Lordjoo\LaraApigee\Api\Edge\Entities;

use Lordjoo\LaraApigee\Entities\BaseEntity;
use Lordjoo\LaraApigee\Entities\Properties\NamePropertyAwareTrait;

class TargetServer extends BaseEntity
{
    use NamePropertyAwareTrait;

    protected string $host;

    protected int $port;

    protected bool $isEncoded;

    public function getHost(): string
    {
        return $this->host;
    }

    public function setHost(string $host): static
    {
        $this->host = $host;
        return $this;
    }

    public function getPort(): int
    {
        return $this->port;
    }

    public function setPort(int $port): static
    {
        $this->port = $port;
        return $this;
    }

    public function getIsEncoded(): bool
    {
        return $this->isEncoded;
    }

    public function setIsEncoded(bool $isEncoded): static
    {
        $this->isEncoded = $isEncoded;
        return $this;
    }

}
