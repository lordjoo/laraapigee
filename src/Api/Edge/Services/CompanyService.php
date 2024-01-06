<?php

namespace Lordjoo\Apigee\Api\Edge\Services;

use Exception;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Validator;
use Lordjoo\Apigee\Abstract\Edge\Service;
use Lordjoo\Apigee\Api\Edge\Entities\Company;
use Lordjoo\Apigee\Exceptions\ValidationException;

class CompanyService extends Service
{
    /**
     * Get a company by name.
     */
    public function find(string $name): Company
    {
        $response = $this->client->get('companies/' . $name, [
            'expand' => 'true',
        ])->json();

        return new Company($response);
    }

    /**
     * Get all companies in the organization.
     *
     * @return Collection<Company>
     */
    public function get(): Collection
    {
        $response = $this->client->get('companies', [
            'expand' => 'true',
        ])->json();

        return collect($response['company'])->map(function ($company) {
            return new Company($company);
        });
    }

    /**
     * Create a new company.
     *
     * @param array $data refer to https://apidocs.apigee.com/docs/companies/1/types/CompanyRequest
     *
     * @throws ValidationException
     */
    public function create(array $data): Company
    {
        $this->validateData($data);
        $response = $this->client->post('companies', $data)->json();

        return new Company($response);
    }

    protected function validateData(array $data): void
    {
        $validator = Validator::make($data, [
            'name' => 'required|string',
            'displayName' => 'required|string',
            'attributes' => 'nullable|array',
            'attributes.*.name' => 'required|string',
            'attributes.*.value' => 'required|string',
        ]);

        if ($validator->fails()) {
            throw new ValidationException($validator->errors()->first());
        }
    }

    /**
     * Update a company.
     *
     * @param array $data refer to https://apidocs.apigee.com/docs/companies/1/types/CompanyRequest
     *
     * @throws ValidationException
     */
    public function update(string $name, array $data): Company
    {
        $this->validateData($data);
        $response = $this->client->put('companies/' . $name, $data)->json();

        return new Company($response);
    }

    /**
     * Delete a company.
     */
    public function delete(string $name): void
    {
        $this->client->delete('companies/' . $name);
    }

    /**
     * Update the status of a company.
     *
     * @return void
     */
    public function updateStatus(string $name, string $string)
    {
        if (!in_array($string, ['active', 'inactive'])) {
            throw new Exception("Invalid status: {$string}");
        }
        $this->client->post(
            url: 'companies/' . $name . '?action=' . $string,
            headers: [
                'Content-Type' => 'application/octet-stream',
            ]
        );
    }
}
