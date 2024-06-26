<?php

namespace Lordjoo\LaraApigee\Entities\Properties;

trait EnvironmentsPropertyAwareTrait
{
    /**
     * @var string[]
     */
    protected array $environments;

    public function getEnvironments(): array
    {
        return $this->environments;
    }

    public function setEnvironments(array $environments): self
    {
        $this->environments = $environments;
        return $this;
    }
}
