<?php

namespace Lordjoo\LaraApigee\Api\Edge\Entities;

use Carbon\Carbon;
use Lordjoo\LaraApigee\Entities\BaseEntity;
use Lordjoo\LaraApigee\Entities\Properties\AttributesPropertyAwareTrait;
use Lordjoo\LaraApigee\Entities\Properties\StatusPropertyAwareTrait;
use Lordjoo\LaraApigee\Entities\Structure\AttributesProperty;

class AppCredential extends BaseEntity
{
    use AttributesPropertyAwareTrait,
        StatusPropertyAwareTrait;

    protected string $consumerKey;

    protected string $consumerSecret;

    protected array $apiProducts = [];

    protected array $scopes = [];

    protected Carbon $expiresAt;

    protected Carbon $issuedAt;

    public function __construct(array $values = [])
    {
        parent::__construct($values);
        $this->attributes = new AttributesProperty();
    }

    public static function idProperty(): string
    {
        return "consumerKey";
    }

    public function getConsumerKey(): string
    {
        return $this->consumerKey;
    }

    public function setConsumerKey(string $consumerKey): self
    {
        $this->consumerKey = $consumerKey;
        return $this;
    }

    public function getConsumerSecret(): string
    {
        return $this->consumerSecret;
    }

    public function setConsumerSecret(string $consumerSecret): self
    {
        $this->consumerSecret = $consumerSecret;
        return $this;
    }

    public function getApiProducts(): array
    {
        return $this->apiProducts;
    }

    public function setApiProducts(array $apiProducts): self
    {
        $this->apiProducts = $apiProducts;
        return $this;
    }

    public function getScopes(): array
    {
        return $this->scopes;
    }

    public function setScopes(array $scopes): self
    {
        $this->scopes = $scopes;
        return $this;
    }

    public function getExpiresAt(): Carbon
    {
        return $this->expiresAt;
    }

    public function setExpiresAt(Carbon $expiresAt): self
    {
        $this->expiresAt = $expiresAt;
        return $this;
    }

    public function getIssuedAt(): Carbon
    {
        return $this->issuedAt;
    }

    public function setIssuedAt(Carbon $issuedAt): self
    {
        $this->issuedAt = $issuedAt;
        return $this;
    }

    public function __call(string $name, array $arguments)
    {
        throw new \BadMethodCallException(sprintf('Method %s::%s does not exist.', static::class, $name));
    }


}
