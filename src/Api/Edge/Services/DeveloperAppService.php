<?php

namespace Lordjoo\Apigee\Api\Edge\Services;

use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Validator;
use Lordjoo\Apigee\Api\Edge\Entities\AppKey;
use Lordjoo\Apigee\Api\Edge\Entities\DeveloperApp;
use Lordjoo\Apigee\Exceptions\ValidationException;
use Lordjoo\Apigee\Support\HttpClient;

class DeveloperAppService extends \Lordjoo\Apigee\Abstract\Edge\Service
{
    protected string $developerEmail;

    public function __construct(
        HttpClient $client,
        string $developerEmail)
    {
        parent::__construct($client);
        $this->developerEmail = $developerEmail;
    }

    /**
     * Returns a list of all Developer Apps in the organization.
     *
     * @return Collection<\Lordjoo\Apigee\Api\Edge\Entities\DeveloperApp>
     */
    public function get(): Collection
    {
        $response = $this->client->get('developers/'.$this->developerEmail.'/apps', [
            'expand' => 'true',
        ])->json();

        return collect($response['app'])->map(function ($app) {
            return new \Lordjoo\Apigee\Api\Edge\Entities\DeveloperApp($app);
        });
    }

    /**
     * Returns a Developer App in the organization.
     */
    public function find(string $appName): DeveloperApp
    {
        $response = $this->client->get('developers/'.$this->developerEmail.'/apps/'.$appName, [
            'expand' => 'true',
        ])->json();

        return new DeveloperApp($response);
    }

    /**
     * Creates a new Developer App in the organization.
     *
     * @param  array  $data refer to https://apidocs.apigee.com/docs/developer-apps/1/types/DeveloperAppRequest
     */
    public function create(array $data): DeveloperApp
    {
        $response = $this->client->post('developers/'.$this->developerEmail.'/apps', $data)->json();

        return new \Lordjoo\Apigee\Api\Edge\Entities\DeveloperApp($response);
    }

    /**
     * Updates an existing Developer App in the organization.
     *
     * @param  array  $data refer to https://apidocs.apigee.com/docs/developer-apps/1/types/DeveloperAppRequest
     */
    public function update(string $appName, array $data): DeveloperApp
    {
        $response = $this->client->put('developers/'.$this->developerEmail.'/apps/'.$appName, $data)->json();

        return new \Lordjoo\Apigee\Api\Edge\Entities\DeveloperApp($response);
    }

    /**
     * Deletes an existing Developer App in the organization.
     */
    public function delete(string $appName): void
    {
        $this->client->delete('developers/'.$this->developerEmail.'/apps/'.$appName);
    }

    /**
     * Updates the status of an existing Developer App in the organization.
     *
     * @param  string  $status either 'approve' or 'revoke'
     */
    public function updateStatus(string $appName, string $status): void
    {
        if (! in_array($status, ['approve', 'revoke'])) {
            throw new \InvalidArgumentException('Invalid status provided.');
        }
        $this->client->post(
            url: 'developers/'.$this->developerEmail.'/apps/'.$appName.'/?action='.$status,
            headers: [
                'Content-Type' => 'application/octet-stream',
            ]
        );
    }

    /**
     * @throws ValidationException
     */
    public function createCredential(string $appId, array $data): DeveloperApp
    {
        $this->validateCreateCredentialRequestdata($data);
        $response = $this->client->post('developers/'.$this->developerEmail.'/apps/'.$appId.'/keys', $data)->json();

        return $this->find($appId);
    }

    public function addProductToCredential(string $appId, string $credentialId, string $productName): DeveloperApp
    {
        $response = $this->client->post('developers/'.$this->developerEmail.'/apps/'.$appId.'/keys/'.$credentialId.'/apiproducts/'.$productName)->json();

        return $this->find($appId);
    }

    public function removeProductFromCredential(string $appId, string $credentialId, string $productName): DeveloperApp
    {
        $response = $this->client->delete('developers/'.$this->developerEmail.'/apps/'.$appId.'/keys/'.$credentialId.'/apiproducts/'.$productName)->json();

        return $this->find($appId);
    }

    public function updateCredential(string $appId, string $credentialId, array $data): DeveloperApp
    {
        $response = $this->client->put('developers/'.$this->developerEmail.'/apps/'.$appId.'/keys/'.$credentialId, $data)->json();

        return $this->find($appId);
    }

    public function deleteCredential(string $appId, string $credentialId): DeveloperApp
    {
        $response = $this->client->delete('developers/'.$this->developerEmail.'/apps/'.$appId.'/keys/'.$credentialId)->json();

        return $this->find($appId);
    }

    public function getCredential(string $appName, string $consumerKey): AppKey
    {
        $response = $this->client->get('developers/'.$this->developerEmail.'/apps/'.$appName.'/keys/'.$consumerKey)->json();

        return new AppKey($response + ['developerId' => $this->developerEmail, 'appName' => $appName]);
    }

    protected function validateData(array $data): void
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
        ]);

        if ($validator->fails()) {
            throw new ValidationException($validator->errors()->first());
        }

    }

    protected function validateCreateCredentialRequestdata(array $data): void
    {
        $validator = Validator::make($data, [
            'consumerKey' => 'required|string',
            'consumerSecret' => 'required|string',
        ]);

        if ($validator->fails()) {
            throw new ValidationException($validator->errors()->first());
        }

    }
}
