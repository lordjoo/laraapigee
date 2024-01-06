<?php

namespace Lordjoo\Apigee\Abstract;

use Carbon\Carbon;
use Illuminate\Support\Str;
use Lordjoo\Apigee\Abstract\ApigeeX\Entity;

abstract class BaseEntity
{

    public function __construct(array $data)
    {
        $this->setAttributes($data);
    }

    protected function setAttributes(array $data)
    {
        foreach ($data as $key => $value) {
            if (property_exists($this, $key)) {
                if ($key === 'attributes') {
                    $this->attributes = [];
                    foreach ($value as $attribute) {
                        $this->attributes[] = new Attribute($attribute);
                    }

                    continue;
                }
                if (is_numeric($value) && $value > 1000000000) {
                    $value = Carbon::createFromTimestamp($value / 1000);
                }

                $this->{$key} = $value;
            }
        }
    }

    public function toArray(bool $sneakCase = false): array
    {
        $data = [];
        foreach ($this as $key => $value) {
            if ($sneakCase) {
                $_key = Str::snake($key);
            } else {
                $_key = $key;
            }

            $rf = new ReflectionProperty($this, $key);
            if ($rf->isPrivate() || $rf->isProtected()) {
                continue;
            }
            // if the value is an array of entities then convert them to array
            if (is_array($value)) {
                foreach ($value as $k => $v) {
                    if ($v instanceof Entity) {
                        $value[$k] = $v->toArray();
                    }
                }
                $data[$_key] = $value;

                continue;
            }

            if ($value instanceof Entity) {
                $data[$_key] = $value->toArray();

                continue;
            }
            $data[$_key] = $value;
        }

        return $data;
    }

}
