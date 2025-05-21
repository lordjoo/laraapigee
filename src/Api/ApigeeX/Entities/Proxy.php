<?php

namespace Lordjoo\LaraApigee\Api\ApigeeX\Entities;

use Lordjoo\LaraApigee\Entities\BaseEntity;
use Lordjoo\LaraApigee\Entities\Properties\NamePropertyAwareTrait;

class Proxy extends BaseEntity
{
    use NamePropertyAwareTrait;

    protected string $latestRevisionId;
    protected array $labels;
    protected array $metaData;

    public function getLatestRevisionId(): string
    {
        return $this->latestRevisionId;
    }

    public function setLatestRevisionId(string $latestRevisionId): void
    {
        $this->latestRevisionId = $latestRevisionId;
    }

    public function getLabels(): array
    {
        return $this->labels;
    }

    public function setLabels(array $labels): void
    {
        $this->labels = $labels;
    }

    public function getMetaData(): array
    {
        return $this->metaData;
    }

    public function setMetaData(array $metaData): void
    {
        $this->metaData = $metaData;
    }
}
