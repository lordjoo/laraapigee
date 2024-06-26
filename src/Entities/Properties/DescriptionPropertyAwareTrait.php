<?php

namespace Lordjoo\LaraApigee\Entities\Properties;

trait DescriptionPropertyAwareTrait
{
    /**
     * @var string|null
     */
    private ?string $description = null;

    /**
     * @return string|null
     */
    public function getDescription(): ?string
    {
        return $this->description;
    }

    /**
     * @param string $description
     * @return $this
     */
    public function setDescription(string $description): static
    {
        $this->description = $description;
        return $this;
    }
}
