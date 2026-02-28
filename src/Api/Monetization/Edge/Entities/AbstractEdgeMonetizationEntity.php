<?php

namespace Lordjoo\LaraApigee\Api\Monetization\Edge\Entities;

use Lordjoo\LaraApigee\Entities\BaseEntity;

abstract class AbstractEdgeMonetizationEntity extends BaseEntity
{
    protected function castNestedEntity(mixed $value, string $entityClass): mixed
    {
        if ($value === null || $value instanceof $entityClass) {
            return $value;
        }

        if (is_array($value)) {
            return new $entityClass($value);
        }

        return $value;
    }

    /**
     * @return array<int, mixed>
     */
    protected function castNestedEntityArray(array $values, string $entityClass): array
    {
        return array_values(array_map(function ($value) use ($entityClass) {
            if ($value instanceof $entityClass) {
                return $value;
            }

            return new $entityClass((array) $value);
        }, $values));
    }
}
