<?php

namespace Lordjoo\LaraApigee\Entities\Structure;

use Illuminate\Contracts\Support\Arrayable;

abstract class BaseObject implements Arrayable
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

    /**
     * Convert the object to an array.
     *
     * @return array
     */
    public function toArray(): array
    {
        $ro = new \ReflectionObject($this);
        $values = [];
        foreach ($ro->getProperties() as $property) {
            // if the property is a complex object, we need to call toArray() recursively
            if ($property->getType() && !$property->getType()->isBuiltin()) {
                $getter = 'get' . ucfirst($property->getName());
                if ($ro->hasMethod($getter)) {
                    $rm = new \ReflectionMethod($this, $getter);
                    // if has toString method, call it
                    $value = $rm->invoke($this)->toArray();
                    if (method_exists($rm->invoke($this), 'toString')) {
                        $value = $rm->invoke($this)->toString();
                    } else if (method_exists($rm->invoke($this), 'toArray')) {
                        $value = $rm->invoke($this)->toArray();
                    }
                    $values[$property->getName()] = $value;
                }
                continue;
            }

            $getter = 'get' . ucfirst($property->getName());
            if ($ro->hasMethod($getter)) {
                $rm = new \ReflectionMethod($this, $getter);
                $values[$property->getName()] = $rm->invoke($this);
            }
        }
        return $values;
    }


}
