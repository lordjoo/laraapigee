<?php

namespace Lordjoo\Apigee\Api\Edge\Services;

use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Validator;
use InvalidArgumentException;
use Lordjoo\Apigee\Abstract\Edge\Service;
use Lordjoo\Apigee\Api\Edge\Entities\Developer;
use Lordjoo\Apigee\Exceptions\ValidationException;

class DeveloperService extends Service
{
    /**
     * Finds an existing developer in the organization by email.
     */
    public function find(string $email): Developer
    {
        $response = $this->client->get('developers/' . $email)->json();

        return new Developer($response);
    }

    /**
     * Returns a list of all developers in the organization.
     *
     * @return Collection<Developer>
     */
    public function get(): Collection
    {
        $response = $this->client->get('developers', [
            'expand' => 'true',
            'includeCompany' => 'true',
        ])->json();

        return collect($response['developer'])->map(function ($developer) {
            return new Developer($developer);
        });
    }

    /**
     * Creates a new developer in the organization.
     *
     * @param array $data refer to https://apidocs.apigee.com/docs/developers/1/types/DeveloperRequest
     *
     * @throws ValidationException
     */
    public function create(array $data): Developer
    {
        $this->validateData($data);
        $response = $this->client->post('developers', $data)->json();

        return new Developer($response);
    }

    protected function validateData(array $data): void
    {
        $validator = Validator::make($data, [
            'email' => 'required|email',
            'firstName' => 'required',
            'lastName' => 'required',
            'userName' => 'required',
            'attributes' => 'nullable|array',
            'attributes.*.name' => 'required|string',
            'attributes.*.value' => 'required|string',
        ]);

        if ($validator->fails()) {
            throw new ValidationException($validator->errors()->first());
        }
    }

    /**
     * Updates an existing developer in the organization.
     *
     * @param array $data refer to https://apidocs.apigee.com/docs/developers/1/types/DeveloperRequest
     *
     * @throws ValidationException
     */
    public function update(string $email, array $data): Developer
    {
        $this->validateData($data);
        $response = $this->client->put("developers/{$email}", $data)->json();

        return new Developer($response);
    }

    /**
     * Deletes an existing developer in the organization.
     */
    public function delete(string $email): void
    {
        $this->client->delete("developers/{$email}");
    }

    /**
     * Changes the status of an existing developer in the organization.
     *
     * @param string $status either 'active' or 'inactive'
     */
    public function updateStatus(string $email, string $status): void
    {
        if (!in_array($status, ['active', 'inactive'])) {
            throw new InvalidArgumentException('Invalid status');
        }
        $this->client->post("developers/{$email}?action={$status}");
    }
}
