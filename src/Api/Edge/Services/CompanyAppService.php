<?php

namespace Lordjoo\Apigee\Api\Edge\Services;

use Illuminate\Support\Collection;
use Lordjoo\Apigee\Api\Edge\Entities\CompanyApp;
use Lordjoo\Apigee\Exceptions\ValidationException;
use Lordjoo\Apigee\Services\Validator;

class CompanyAppService extends \Lordjoo\Apigee\Abstract\Service
{
    protected string $companyName;

    public function __construct(string $companyName)
    {
        parent::__construct();
        $this->companyName = $companyName;
    }

    /**
     * Returns a list of all Company Apps in the organization.
     *
     * @return Collection<CompanyApp>
     */
    public function get(): Collection
    {
        $response = $this->client->get('companies/'.$this->companyName.'/apps', [
            'expand' => 'true',
        ])->json();

        return collect($response['app'])->map(function ($app) {
            return new \Lordjoo\Apigee\Api\Edge\Entities\CompanyApp($app);
        });
    }

    /**
     * Create a new Company App
     *
     * @param  array  $data refer to https://apidocs.apigee.com/docs/company-apps/1/types/CompanyAppRequest
     */
    public function create(array $data): CompanyApp
    {
        $response = $this->client->post('companies/'.$this->companyName.'/apps', $data)->json();

        return new CompanyApp($response);
    }

    /**
     * Update a Company App
     *
     * @param  array  $data refer to https://apidocs.apigee.com/docs/company-apps/1/types/CompanyAppRequest
     */
    public function update(string $appName, array $data): CompanyApp
    {
        $response = $this->client->put('companies/'.$this->companyName.'/apps/'.$appName, $data)->json();

        return new \Lordjoo\Apigee\Api\Edge\Entities\CompanyApp($response);
    }

    /**
     * Delete a Company App
     */
    public function delete(string $appName): void
    {
        $this->client->delete('companies/'.$this->companyName.'/apps/'.$appName);
    }

    /**
     * Update the status of a Company App
     *
     * @param  string  $status either "approve" or "revoke"
     */
    public function updateStatus(string $appName, string $status): void
    {
        if (! in_array($status, ['approve', 'revoke'])) {
            throw new \InvalidArgumentException('Status must be either "approved" or "revoked"');
        }
        $this->client->post(
            url: 'companies/'.$this->companyName.'/apps/'.$appName.'?action='.$status,
            headers: [
                'Content-Type' => 'application/octet-stream',
            ]
        );
    }

    protected function validateData(array $data)
    {
        $validator = Validator::make($data, [
            'name' => 'required|string',
            'apiProducts' => 'required|array',
            'apiProducts.*' => 'string|required',
            'attributes' => 'nullable|array',
            'attributes.*.name' => 'required|string',
            'attributes.*.value' => 'required|string',
            'callbackUrl' => 'nullable|url',
            'keyExpiresIn' => 'nullable|integer',
            'scopes' => 'nullable|array',
            'status' => 'nullable|string',
        ]);

        if ($validator->fails()) {
            throw new ValidationException($validator->errors()->first());
        }
    }
}
