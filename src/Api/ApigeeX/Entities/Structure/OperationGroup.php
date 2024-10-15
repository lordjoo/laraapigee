<?php

namespace Lordjoo\LaraApigee\Api\ApigeeX\Entities\Structure;

use Lordjoo\LaraApigee\Entities\Structure\BaseObject;
use Lordjoo\LaraApigee\Utility\Serializer\EntitySerializer;

class OperationGroup extends BaseObject
{
    protected string $operationConfigType;

    protected array $operationConfigs = [];


    public function getOperationConfigs(): array
    {
        return $this->operationConfigs;
    }

    public function setOperationConfigs(array $operationConfigs): void
    {
        foreach ($operationConfigs as $operationConfig) {
            if (!($operationConfig instanceof OperationConfig)) {
                throw new \InvalidArgumentException('OperationConfig must be an instance of '.OperationConfig::class);
            }
        }
        $this->operationConfigs = $operationConfigs;
    }

    public function getOperationConfigType(): string
    {
        return $this->operationConfigType;
    }

    public function setOperationConfigType(string $operationConfigType): void
    {
        $this->operationConfigType = $operationConfigType;
    }
}
