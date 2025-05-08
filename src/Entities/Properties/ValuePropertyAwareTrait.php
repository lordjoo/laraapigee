<?php

namespace Lordjoo\LaraApigee\Entities\Properties;

trait ValuePropertyAwareTrait
{
    /**
     * @var string
     */
    protected string $value;

    /**
     * @return string
     */
    public function getValue(): string
    {
        return $this->value;
    }

    /**
     * @param string $value
     * @return $this
     */
    public function setValue(string $value): static
    {
        $this->value = $value;
        return $this;
    }
}
