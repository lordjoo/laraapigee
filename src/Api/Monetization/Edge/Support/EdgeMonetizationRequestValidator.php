<?php

namespace Lordjoo\LaraApigee\Api\Monetization\Edge\Support;

use InvalidArgumentException;

class EdgeMonetizationRequestValidator
{
    /**
     * @param  array<string, mixed>  $query
     * @param  array<string, string>  $schema
     * @return array<string, mixed>
     */
    public static function normalizeQuery(array $query, array $schema): array
    {
        $normalized = [];

        foreach ($query as $key => $value) {
            if (! array_key_exists($key, $schema)) {
                throw new InvalidArgumentException(sprintf('Unsupported query option [%s]. Allowed options: %s', $key, implode(', ', array_keys($schema))));
            }

            if ($value === null) {
                continue;
            }

            $normalized[$key] = self::validateTypedValue($key, $value, $schema[$key]);
        }

        return $normalized;
    }

    public static function assertNonEmptyString(string $value, string $field): void
    {
        if (trim($value) === '') {
            throw new InvalidArgumentException(sprintf('Field [%s] must be a non-empty string.', $field));
        }
    }

    /**
     * @param  array<int, string>  $fields
     */
    public static function assertRequiredEntityFields(object $entity, array $fields, string $context): void
    {
        foreach ($fields as $field) {
            $getter = 'get'.ucfirst($field);
            $value = method_exists($entity, $getter) ? $entity->{$getter}() : null;

            if (self::isMissing($value)) {
                throw new InvalidArgumentException(sprintf('%s requires [%s] to be provided.', $context, $field));
            }
        }
    }

    /**
     * @param  mixed  $value
     */
    private static function validateTypedValue(string $key, $value, string $type): mixed
    {
        return match ($type) {
            'bool' => self::assertBool($key, $value),
            'int' => self::assertInt($key, $value),
            'string' => self::assertString($key, $value),
            'numeric' => self::assertNumeric($key, $value),
            default => throw new InvalidArgumentException(sprintf('Unsupported validator type [%s] for query option [%s].', $type, $key)),
        };
    }

    /**
     * @param  mixed  $value
     */
    private static function assertBool(string $key, $value): bool
    {
        if (! is_bool($value)) {
            throw new InvalidArgumentException(sprintf('Query option [%s] must be boolean.', $key));
        }

        return $value;
    }

    /**
     * @param  mixed  $value
     */
    private static function assertInt(string $key, $value): int
    {
        if (! is_int($value)) {
            throw new InvalidArgumentException(sprintf('Query option [%s] must be integer.', $key));
        }

        return $value;
    }

    /**
     * @param  mixed  $value
     */
    private static function assertString(string $key, $value): string
    {
        if (! is_string($value)) {
            throw new InvalidArgumentException(sprintf('Query option [%s] must be string.', $key));
        }

        return $value;
    }

    /**
     * @param  mixed  $value
     */
    private static function assertNumeric(string $key, $value): float|int|string
    {
        if (! is_numeric($value)) {
            throw new InvalidArgumentException(sprintf('Query option [%s] must be numeric.', $key));
        }

        return $value;
    }

    /**
     * @param  mixed  $value
     */
    private static function isMissing($value): bool
    {
        if ($value === null) {
            return true;
        }

        if (is_string($value)) {
            return trim($value) === '';
        }

        if (is_array($value)) {
            return $value === [];
        }

        return false;
    }
}
