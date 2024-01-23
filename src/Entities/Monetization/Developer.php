<?php

namespace Lordjoo\Apigee\Entities\Monetization;

class Developer extends Entity
{
    public string $id;

    public string $name;

    public string $email;

    public string $billingType;

    public string $status;

    public string $type;

    public bool $broker;

    public bool $isCompany;

    public Organization $organization;

    /**
     * Get all rate plans accepted by a developer
     */
    public function ratePlanes(int $page = 1, int $limit = 20): array
    {
        return $this->client->developer()->getRatePlans($this->email, $page, $limit);
    }

    /**
     * Lists balances for a developer
     */
    public function balances(int $page = 1, int $limit = 20): array
    {
        return $this->client->developer()->getBalances($this->email, $page, $limit);
    }

    /**
     * Add balance to a developer
     */
    public function addBalance(float $amount, string $currency_id): DeveloperBalance
    {
        return $this->client->developer()->addBalance($this->email, $amount, $currency_id);
    }
}
