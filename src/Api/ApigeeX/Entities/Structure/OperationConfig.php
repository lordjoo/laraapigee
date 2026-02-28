<?php

namespace Lordjoo\LaraApigee\Api\ApigeeX\Entities\Structure;

use Lordjoo\LaraApigee\Entities\Structure\BaseObject;

class OperationConfig extends BaseObject
{
    protected string $apiSource;

    protected array $operations = [];

    protected ?Quota $quota = null;

    public function __construct(array $values = [])
    {
        parent::__construct($values);
    }

    public function getApiSource(): string
    {
        return $this->apiSource;
    }

    public function setApiSource(string $apiSource): void
    {
        $this->apiSource = $apiSource;
    }

    public function getQuota(): ?Quota
    {
        return $this->quota;
    }

    public function setQuota(Quota $quota): void
    {
        $this->quota = $quota;
    }

    public function getOperations(): array
    {
        return $this->operations;
    }

    public function setOperations(array $operations): void
    {
        foreach ($operations as $operation) {
            if (!$operation instanceof Operation) {
                throw new \InvalidArgumentException('Operation must be an instance of '.Operation::class);
            }
        }
        $this->operations = $operations;
    }

}
