<?php

namespace Lordjoo\Apigee\Entities\Properties;

trait AttributePropertyAware
{
    /**
     * @var \Lordjoo\Apigee\Entities\Attribute[]
     */
    public array $attributes;

    public function getAttribute(string $name)
    {
        $attribute = array_filter($this->attributes, function ($attribute) use ($name) {
            return $attribute->name === $name;
        });
        if (count($attribute) === 1) {
            return $attribute[0]->value;
        }
        throw new \Exception("Attribute $name does not exist");
    }
}
