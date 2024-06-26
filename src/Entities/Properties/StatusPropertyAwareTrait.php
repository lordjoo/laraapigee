<?php

namespace Lordjoo\LaraApigee\Entities\Properties;

trait StatusPropertyAwareTrait
{
/**
     * @var string
     */
    protected string $status;

    /**
     * @return string
     */
    public function getStatus(): string
    {
        return $this->status;
    }

    /**
     * @param string $status
     * @return $this
     */
    public function setStatus(string $status): static
    {
        $this->status = $status;

        return $this;
    }
}
