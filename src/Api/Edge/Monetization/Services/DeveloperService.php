<?php

namespace Lordjoo\Apigee\Api\Edge\Monetization\Services;

use Lordjoo\Apigee\Api\Edge\Monetization\Entities\Developer;
use Lordjoo\Apigee\Api\Edge\Monetization\Entities\DeveloperBalance;
use Lordjoo\Apigee\Api\Edge\Monetization\Entities\DeveloperRatePlan;

class DeveloperService extends Service
{
    /**
     * Get all developers
     */
    public function get(int $page = 1, int $limit = 20): array
    {
        $response = $this->client->get(
            url: 'developers',
            query: [
                'page' => $page,
                'size' => $limit,
            ]
        )->json();
        $developers = collect($response['developer'])->map(function ($developer) {
            return new Developer($developer);
        });

        return [
            'developers' => $developers,
            'totalPages' => intval($response['totalRecords'] / $limit),
        ];
    }

    /**
     * Find developer by email
     *
     * @return \Lordjoo\Apigee\Monetization\Edge\Entities\Developer
     */
    public function find(string $email): Developer
    {
        $response = $this->client->get("developers/$email")->json();

        return new Developer($response);
    }

    /**
     * Lists rate plans accepted by a developer
     */
    public function getRatePlans(
        string $email,
        int $page = 1,
        int $limit = 20
    ): array {
        $response = $this->client->get(
            url: "developers/$email/developer-accepted-rateplans",
            query: [
                'page' => $page,
                'size' => $limit,
            ]
        )->json();
        $ratePlans = collect($response['developerRatePlan'])->map(function ($ratePlan) {
            return new DeveloperRatePlan($ratePlan);
        });

        return [
            'ratePlans' => $ratePlans,
            'totalPages' => intval($response['totalRecords'] / $limit),
        ];
    }

    public function getBalances(
        string $email,
        int $page = 1,
        int $limit = 20
    ): array {
        $response = $this->client->get(
            url: "developers/$email/developer-balances",
            query: [
                'page' => $page,
                'size' => $limit,
            ]
        )->json();
        $ratePlans = collect($response['developerBalance'])->map(function ($ratePlan) {
            return new DeveloperBalance($ratePlan);
        });

        return [
            'ratePlans' => $ratePlans,
            'totalPages' => intval($response['totalRecords'] / $limit),
        ];
    }

    /**
     * @return \Lordjoo\Apigee\Monetization\Edge\Entities\DeveloperBalance
     */
    public function addBalance(
        string $email,
        float $amount,
        string $currency_id,
    ): DeveloperBalance {
        $response = $this->client->post(
            url: "developers/$email/developer-balances",
            data: [
                'amount' => $amount,
                'supportedCurrency' => [
                    'id' => $currency_id,
                ],
            ]
        )->json();

        return new DeveloperBalance($response);
    }
}
