<?php

namespace Lordjoo\LaraApigee\Api\ApigeeX\Entities;

use Lordjoo\LaraApigee\Api\ApigeeX\Entities\Structure\ConfigsProperty;
use Lordjoo\LaraApigee\Api\ApigeeX\Entities\Structure\OperationGroup;
use Lordjoo\LaraApigee\Api\Edge\Entities\ApiProduct as EdgeApiProduct;

class ApiProduct extends EdgeApiProduct
{
    protected ?OperationGroup $operationGroup = null;

    protected ?OperationGroup $graphqlOperationGroup = null;

    public function getOperationGroup(): ?OperationGroup
    {
        return $this->operationGroup;
    }

    public function setOperationGroup(OperationGroup $operationGroup): void
    {
        $this->operationGroup = $operationGroup;
    }

    public function getGraphqlOperationGroup(): ?OperationGroup
    {
        return $this->graphqlOperationGroup;
    }

    public function setGraphqlOperationGroup(OperationGroup $graphqlOperationGroup): void
    {
        $this->graphqlOperationGroup = $graphqlOperationGroup;
    }


}
