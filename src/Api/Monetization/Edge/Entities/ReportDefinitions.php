<?php

namespace Lordjoo\LaraApigee\Api\Monetization\Edge\Entities;

class ReportDefinitions extends AbstractEdgeMonetizationEntity
{
    /** @var array<int, ReportDefinition> */
    protected array $reportDefinition = [];

    protected ?int $totalRecords = null;

    public function getReportDefinition(): array
    {
        return $this->reportDefinition;
    }

    public function setReportDefinition(array $reportDefinition): self
    {
        $this->reportDefinition = $this->castNestedEntityArray($reportDefinition, ReportDefinition::class);

        return $this;
    }

    public function getTotalRecords(): ?int
    {
        return $this->totalRecords;
    }

    public function setTotalRecords(?int $totalRecords): self
    {
        $this->totalRecords = $totalRecords;

        return $this;
    }
}
