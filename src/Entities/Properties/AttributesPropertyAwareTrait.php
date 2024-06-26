<?php

namespace Lordjoo\LaraApigee\Entities\Properties;

use Lordjoo\LaraApigee\Entities\Structure\AttributesProperty;

trait AttributesPropertyAwareTrait
{
    protected AttributesProperty $attributes;

    public function getAttributes(): AttributesProperty
    {
        return $this->attributes;
    }

    public function setAttributes(AttributesProperty $attributes): self
    {
        $this->attributes = $attributes;
        return $this;
    }

    public function getAttributeValue(string $attribute): ?string
    {
        return $this->attributes->getValue($attribute);
    }

    public function setAttribute(string $name, string $value): self
    {
        $this->attributes->add($name, $value);
        return $this;
    }

    public function hasAttribute(string $name): bool
    {
        return $this->attributes->has($name);
    }

    public function deleteAttribute(string $name): self
    {
        $this->attributes->delete($name);
        return $this;
    }


}
