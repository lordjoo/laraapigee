<?php

namespace Lordjoo\LaraApigee\Entities\Properties;

trait DisplayNamePropertyAwareTrait
{
    /**
     * @var string|null
     */
    protected ?string $displayName = null;

    /**
     * @return string|null
     */
    public function getDisplayName(): ?string
    {
        return $this->displayName;
    }

    /**
     * @param string $displayName
     * @return $this
     */
    public function setDisplayName(string $displayName): static
    {
        $this->displayName = $displayName;
        return $this;
    }
}
