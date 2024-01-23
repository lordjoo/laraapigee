<?php

namespace Lordjoo\Apigee\Api\Edge\Monetization\Services;

use Illuminate\Support\Collection;
use Lordjoo\Apigee\Entities\Monetization\ApiPackage;
use Lordjoo\Apigee\Entities\Monetization\RatePlan;

class ApiPackageService extends Service
{
    /**
     * Get all api packages
     *
     * @return array ['packages' => Collection, 'totalPages' => int]
     */
    public function get(int $page = 1, int $limit = 20): array
    {
        $response = $this->client->get(
            url: 'monetization-packages?page=2',
            query: [
                'page' => $page,
                'size' => $limit,
            ]
        )->json();
        $totalPages = intval($response['totalRecords'] / $limit);
        $packages = collect($response['monetizationPackage'])->map(function ($item) {
            return new ApiPackage($item);
        });

        return [
            'packages' => $packages,
            'totalPages' => $totalPages,
        ];
    }

    /**
     * Find api package by id
     */
    public function find(string $id): ApiPackage
    {
        $response = $this->client->get("monetization-packages/$id")->json();

        return new ApiPackage($response);
    }

    /**
     * Delete api package by id
     */
    public function delete(string $id): void
    {
        $this->client->delete("monetization-packages/$id");
    }

    /**
     * Create new api package
     */
    public function create(array $data): ApiPackage
    {
        $response = $this->client->post('monetization-packages', $data)->json();

        return new ApiPackage($response);
    }

    /**
     * Get all rate plans for a package
     *
     * @return array ['ratePlans' => Collection, 'totalPages' => int]
     */
    public function getRatePlans(
        string $package_id,
        int $page = 1,
        int $limit = 20
    ): Collection {
        $response = $this->client->get(
            url: "monetization-packages/$package_id/rate-plans",
            query: [
                'page' => $page,
                'size' => $limit,
            ]
        )->json();
        $plans = collect($response['ratePlan'])->map(function ($item) {
            return new RatePlan($item);
        });

        return [
            'ratePlans' => $plans,
            'totalPages' => intval($response['totalRecords'] / $limit),
        ];
    }

    public function createRatePlan(
        string $package_id,
        array $data
    ): RatePlan {
        $response = $this->client->post(
            url: "monetization-packages/$package_id/rate-plans",
            data: $data
        )->json();

        return new RatePlan($response);
    }

    // TODO: produce a response w content to return an Entity classes
    public function addApiProduct(
        string $package_id,
        string $product_id,
        array $rate_plans = []
    ) {
        return $this->client->post(
            url: "monetization-packages/$package_id/products/$product_id",
            data: [
                'ratePlan' => $rate_plans,
            ]
        )->json();
    }

    public function removeApiProduct(
        string $package_id,
        string $product_id
    ) {
        return $this->client->delete(
            url: "monetization-packages/$package_id/products/$product_id"
        )->json();
    }
}
