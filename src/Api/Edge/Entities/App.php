<?php

namespace Lordjoo\LaraApigee\Api\Edge\Entities;

use LogicException;
use Lordjoo\LaraApigee\Entities\BaseEntity;
use Lordjoo\LaraApigee\Entities\Properties\AttributesPropertyAwareTrait;
use Lordjoo\LaraApigee\Entities\Properties\CommonEntityPropertiesAwareTrait;
use Lordjoo\LaraApigee\Entities\Properties\DescriptionPropertyAwareTrait;
use Lordjoo\LaraApigee\Entities\Properties\NamePropertyAwareTrait;
use Lordjoo\LaraApigee\Entities\Properties\StatusPropertyAwareTrait;
use Lordjoo\LaraApigee\Entities\Structure\AttributesProperty;
use Lordjoo\LaraApigee\Utility\Serializer\EntitySerializer;

class App extends BaseEntity
{
    use CommonEntityPropertiesAwareTrait;
    use NamePropertyAwareTrait;
    use StatusPropertyAwareTrait;
    use DescriptionPropertyAwareTrait;
    use AttributesPropertyAwareTrait;

    public string $appFamily = 'default';

    public ?string $appId = null;

    public ?string $callbackUrl = null;

    public array $credentials = [];

    public array $initialApiProducts = [];

    public string $displayName;

    public function __construct(array $values = [])
    {
        $this->attributes = new AttributesProperty();
        parent::__construct($values);
    }

    public function getDescription(): ?string
    {
        return $this->getAttributeValue('Notes');
    }

    public function setDescription(string $description): self
    {
        $this->setAttribute('Notes', $description);
        return $this;
    }

    public function getAppFamily(): string
    {
        return $this->appFamily;
    }

    public function setAppFamily(string $appFamily): self
    {
        $this->appFamily = $appFamily;
        return $this;
    }

    public function getAppId(): string
    {
        return $this->appId;
    }

    public function setAppId(string $appId): self
    {
        $this->appId = $appId;
        return $this;
    }

    public function getCallbackUrl(): string
    {
        return $this->callbackUrl;
    }

    public function setCallbackUrl(?string $callbackUrl): self
    {
        $this->callbackUrl = $callbackUrl;
        return $this;
    }

    public function getCredentials(): array
    {
        return $this->credentials;
    }

    public function setCredentials(array $credentials): self
    {
        $serializer = new EntitySerializer();
        $credentials = $serializer->denormalize($credentials, AppCredential::class . '[]');
        $this->credentials = $credentials;
        return $this;
    }

    public function getInitialApiProducts(): array
    {
        return $this->initialApiProducts;
    }

    public function setInitialApiProducts(array $initialApiProducts): self
    {
        if (!$this->appId) {
            $this->initialApiProducts = $initialApiProducts;
        } else {
            throw new LogicException('This method is only supported for creating a new app.');
        }
        return $this;
    }

    public function getDisplayName(): ?string
    {
        return $this->getAttributeValue('DisplayName') ?: $this->getName();
    }

    /**
     * Set the display name of the app.
     *
     * @param string $displayName
     */
    public function setDisplayName(string $displayName): self
    {
        $this->setAttribute('DisplayName', $displayName);
        return $this;
    }

    final public function getApiProducts(): array
    {
        return $this->initialApiProducts;
    }
}
