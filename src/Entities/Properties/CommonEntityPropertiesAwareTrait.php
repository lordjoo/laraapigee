<?php

namespace Lordjoo\LaraApigee\Entities\Properties;

use Carbon\Carbon;

trait CommonEntityPropertiesAwareTrait
{

    /**
     * @var Carbon|null
     */
    protected ?Carbon $createdAt;

    /**
     * @var string|null
     */
    protected ?string $createdBy;

    /**
     * @var Carbon|null
     */
    protected ?Carbon $lastModifiedAt;

    /**
     * @var string|null
     */
    protected ?string $lastModifiedBy;

    /**
     * @return Carbon|null
     */
    public function getCreatedAt(): ?Carbon
    {
        return $this->createdAt;
    }

    /**
     * @param Carbon|null $createdAt
     * @return $this
     */
    public function setCreatedAt(?Carbon $createdAt): static
    {
        $this->createdAt = $createdAt;
        return $this;
    }

    /**
     * @return string|null
     */
    public function getCreatedBy(): ?string
    {
        return $this->createdBy;
    }

    /**
     * @param string|null $createdBy
     * @return $this
     */
    public function setCreatedBy(?string $createdBy): static
    {
        $this->createdBy = $createdBy;
        return $this;
    }

    /**
     * @return Carbon|null
     */
    public function getLastModifiedAt(): ?Carbon
    {
        return $this->lastModifiedAt;
    }

    /**
     * @param Carbon|null $lastModifiedAt
     * @return $this
     */
    public function setLastModifiedAt(?Carbon $lastModifiedAt): static
    {
        $this->lastModifiedAt = $lastModifiedAt;
        return $this;
    }

    /**
     * @return string|null
     */
    public function getLastModifiedBy(): ?string
    {
        return $this->lastModifiedBy;
    }

    /**
     * @param string|null $lastModifiedBy
     * @return $this
     */
    public function setLastModifiedBy(?string $lastModifiedBy): static
    {
        $this->lastModifiedBy = $lastModifiedBy;
        return $this;
    }

}
