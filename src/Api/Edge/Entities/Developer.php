<?php

namespace Lordjoo\LaraApigee\Api\Edge\Entities;

use Lordjoo\LaraApigee\Entities\BaseEntity;
use Lordjoo\LaraApigee\Entities\Properties\AttributesPropertyAwareTrait;
use Lordjoo\LaraApigee\Entities\Properties\CommonEntityPropertiesAwareTrait;
use Lordjoo\LaraApigee\Entities\Properties\StatusPropertyAwareTrait;
use Symfony\Component\Serializer\Attribute\Ignore;

class Developer extends BaseEntity
{
    use CommonEntityPropertiesAwareTrait;
    use StatusPropertyAwareTrait;
    use AttributesPropertyAwareTrait;

    protected string $developerId;

    protected string $email;

    protected string $firstName;

    protected string $lastName;

    protected string $userName;

    private string $originalEmail;

    public static function idProperty(): string
    {
        return "developerId";
    }

    public function getDeveloperId(): string
    {
        return $this->developerId;
    }

    public function setDeveloperId(string $developerId): self
    {
        $this->developerId = $developerId;
        return $this;
    }

    public function getEmail(): string
    {
        return $this->email;
    }

    public function setEmail(string $email): self
    {
        $this->originalEmail = $email;
        $this->email = $email;
        return $this;
    }

    public function getFirstName(): string
    {
        return $this->firstName;
    }

    public function setFirstName(string $firstName): self
    {
        $this->firstName = $firstName;
        return $this;
    }

    public function getLastName(): string
    {
        return $this->lastName;
    }

    public function setLastName(string $lastName): self
    {
        $this->lastName = $lastName;
        return $this;
    }

    public function getUserName(): string
    {
        return $this->userName;
    }

    public function setUserName(string $userName): self
    {
        $this->userName = $userName;
        return $this;
    }

    public function originalEmail(): string
    {
        return $this->originalEmail;
    }


}
