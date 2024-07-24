<?php

namespace Lordjoo\LaraApigee\Api\Edge\Entities;

use Lordjoo\LaraApigee\Entities\BaseEntity;
use Lordjoo\LaraApigee\Entities\Properties\AttributesPropertyAwareTrait;
use Lordjoo\LaraApigee\Entities\Properties\CommonEntityPropertiesAwareTrait;
use Lordjoo\LaraApigee\Entities\Properties\DescriptionPropertyAwareTrait;
use Lordjoo\LaraApigee\Entities\Properties\DisplayNamePropertyAwareTrait;
use Lordjoo\LaraApigee\Entities\Properties\EnvironmentsPropertyAwareTrait;
use Lordjoo\LaraApigee\Entities\Properties\NamePropertyAwareTrait;
use Lordjoo\LaraApigee\Entities\Structure\AttributesProperty;

class ApiProduct extends BaseEntity
{
    use NamePropertyAwareTrait,
        DisplayNamePropertyAwareTrait,
        DescriptionPropertyAwareTrait,
        EnvironmentsPropertyAwareTrait,
        AttributesPropertyAwareTrait,
        CommonEntityPropertiesAwareTrait;

    /**
     * @var string
     */
    protected string $approvalType;

    /**
     * @var string[]
     */
    protected array $resources = [];

    /**
     * @var string[]
     */
    protected array $proxies = [];

    /**
     * @var string
     */
    protected ?string $quota = null;

    /**
     * @var string
     */
    protected ?string $quotaInterval = null;

    /**
     * @var string
     */
    protected ?string $quotaTimeUnit = null;


    public function __construct(array $values = [])
    {
        $this->attributes = new AttributesProperty();
        parent::__construct($values);
    }

    /**
     * @return string
     */
    public function getApprovalType(): string
    {
        return $this->approvalType;
    }

    /**
     * @param string $approvalType
     * @return $this
     */
    public function setApprovalType(string $approvalType): self
    {
        $this->approvalType = $approvalType;
        return $this;
    }


    /**
     * @return string[]
     */
    public function getResources(): ?array
    {
        return $this->resources;
    }


    /**
     * @param array $resources
     * @return $this
     */
    public function setResources(array $resources): self
    {
        $this->resources = $resources;
        return $this;
    }


    /**
     * @return string[]
     */
    public function getProxies(): ?array
    {
        return $this->proxies;
    }


    /**
     * @param array $proxies
     * @return $this
     */
    public function setProxies(array $proxies): self
    {
        $this->proxies = $proxies;
        return $this;
    }


    /**
     * @return string
     */
    public function getQuota(): ?string
    {
        return $this->quota;
    }


    /**
     * @param string $quota
     * @return $this
     */
    public function setQuota(string $quota): self
    {
        $this->quota = $quota;
        return $this;
    }


    /**
     * @return string
     */
    public function getQuotaInterval(): ?string
    {
        return $this->quotaInterval;
    }


    /**
     * @param string $quotaInterval
     * @return $this
     */
    public function setQuotaInterval(string $quotaInterval): self
    {
        $this->quotaInterval = $quotaInterval;
        return $this;
    }


    /**
     * @return string
     */
    public function getQuotaTimeUnit(): ?string
    {
        return $this->quotaTimeUnit;
    }


    /**
     * @param string $quotaTimeUnit
     * @return $this
     */
    public function setQuotaTimeUnit(string $quotaTimeUnit): self
    {
        $this->quotaTimeUnit = $quotaTimeUnit;
        return $this;
    }

}
