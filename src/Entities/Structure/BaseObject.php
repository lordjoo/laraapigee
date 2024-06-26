<?php

namespace Lordjoo\LaraApigee\Entities\Structure;

abstract class BaseObject
{
    public function __construct(array $values = [])
    {
        $ro = new \ReflectionObject($this);
        foreach ($ro->getProperties() as $property) {
            if (!array_key_exists($property->getName(), $values)) {
                continue;
            }
            $setter = 'set' . ucfirst($property->getName());
            if ($ro->hasMethod($setter)) {
                $value = $values[$property->getName()];
                $rm = new \ReflectionMethod($this, $setter);
                try {
                    $rm->invoke($this, $value);
                } catch (\TypeError $error) {
                    // Auto-retry, pass the value as variable-length arguments.
                    // Ignore empty variable list.
                    if (is_array($value)) {
                        // Clear the value of the property.
                        if (empty($value)) {
                            $rm->invoke($this);
                        } else {
                            $rm->invoke($this, ...$value);
                        }
                    } else {
                        throw $error;
                    }
                }
            }
        }
    }

}
