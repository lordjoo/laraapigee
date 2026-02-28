<?php

namespace Lordjoo\LaraApigee\Entities;

use Lordjoo\LaraApigee\Entities\Structure\BaseObject;

abstract class BaseEntity extends BaseObject implements EntityInterface
{

    /**
     * @return string
     */
    private const DEFAULT_ID_FIELD = 'name';

    /**
     * @return string|null
     */
    public function id(): ?string
    {
        return $this->{self::DEFAULT_ID_FIELD};
    }

    /**
     * @return string
     */
    public static function idProperty(): string
    {
        return self::DEFAULT_ID_FIELD;
    }
}
