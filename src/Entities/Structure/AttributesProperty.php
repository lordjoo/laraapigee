<?php

namespace Lordjoo\LaraApigee\Entities\Structure;

class AttributesProperty extends BaseObject
{
    /** @var array */
    protected array $values = [];

    /**
     * KeyValueMapAwareTrait constructor.
     *
     * @param array $values
     *   Associative array. Ex.: ['foo' => 'bar']
     */
    public function __construct(array $values = [])
    {
        $this->values = $values;
        parent::__construct($values);
    }

    /**
     * @return array
     */
    public function values(): array
    {
        return $this->values;
    }

    /**
     * @param string $key
     * @return string|null
     */
    public function getValue(string $key): ?string
    {
        if (array_key_exists($key, $this->values())) {
            return $this->values[$key];
        }

        return null;
    }

    /**
     * @param string $key
     * @param $value
     * @return void
     */
    public function add(string $key, $value): void
    {
        $this->values[$key] = $value;
    }

    /**
     * @param array $values
     * @return void
     */
    public function set(array $values): void
    {
        $this->values = $values;
    }

    /**
     * @param string $key
     * @return void
     */
    public function delete(string $key): void
    {
        unset($this->values[$key]);
    }

    /**
     * @param string $key
     * @return bool
     */
    public function has(string $key): bool
    {
        return array_key_exists($key, $this->values);
    }

    /**
     * @return \Traversable
     */
    public function getIterator(): \Traversable
    {
        return new \ArrayIterator($this->values());
    }

}
