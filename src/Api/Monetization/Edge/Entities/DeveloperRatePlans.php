<?php

namespace Lordjoo\LaraApigee\Api\Monetization\Edge\Entities;

class DeveloperRatePlans extends AbstractEdgeMonetizationEntity
{
    /** @var array<int, DeveloperRatePlan> */
    protected array $developerRatePlan = [];

    protected ?int $totalRecords = null;

    public function getDeveloperRatePlan(): array
    {
        return $this->developerRatePlan;
    }

    public function setDeveloperRatePlan(array $developerRatePlan): self
    {
        $flattened = [];
        foreach ($developerRatePlan as $item) {
            // Apigee's OpenAPI models DeveloperRatePlan as an array schema, but runtime payloads
            // are commonly arrays of objects. Be tolerant and flatten nested lists if present.
            if (is_array($item) && $item !== [] && array_is_list($item) && is_array($item[0] ?? null)) {
                foreach ($item as $nestedItem) {
                    $flattened[] = $nestedItem;
                }

                continue;
            }

            $flattened[] = $item;
        }

        $this->developerRatePlan = $this->castNestedEntityArray($flattened, DeveloperRatePlan::class);

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
