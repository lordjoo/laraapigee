<?php

namespace Lordjoo\Apigee\Api\Edge\Services;

use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Validator;
use Lordjoo\Apigee\Abstract\Service;
use Lordjoo\Apigee\Api\Edge\Entities\ApiProduct;
use Lordjoo\Apigee\Exceptions\ValidationException;

class ApiProductService extends Service
{
    /**
     * Find an API product by name.
     */
    public function find(string $name): ApiProduct
    {
        $response = $this->client->get('apiproducts/' . $name, [
            'expand' => 'true',
        ])->json();

        return new ApiProduct($response);
    }

    /**
     * Returns a list of all API products in the organization.
     *
     * @return Collection<ApiProduct>
     */
    public function get(): Collection
    {
        $response = $this->client->get('apiproducts', [
            'expand' => 'true',
        ])->json();

        return collect($response['apiProduct'])->map(function ($product) {
            return new ApiProduct($product);
        });
    }

    /**
     * Create a new API product.
     *
     * @param array $data refer to https://apidocs.apigee.com/docs/api-products/1/types/APIProductRequest
     *
     * @throws ValidationException
     */
    public function create(array $data): ApiProduct
    {
        $this->validateData($data);
        $response = $this->client->post('apiproducts', $data)->json();

        return new ApiProduct($response);
    }

    protected function validateData(array $data): void
    {
        $validator = Validator::make($data, [
            'name' => 'required|string',
            'displayName' => 'required|string',
            'approvalType' => 'required|in:auto,manual',
            'apiResources' => 'nullable|array',
            'apiResources.*' => 'required|string',
            'attributes' => 'nullable|array',
            'attributes.*.name' => 'required|string',
            'attributes.*.value' => 'required|string',
            'description' => 'nullable|string',
            'environments' => 'nullable|array',
            'proxies' => 'nullable|array',
            'proxies.*' => 'required|string',
            'quota' => 'nullable|integer',
            'quotaInterval' => 'nullable|integer',
            'quotaTimeUnit' => 'nullable|in:minute,hour,day,month',
            'scopes' => 'nullable|array',
            'scopes.*' => 'required|string',
        ]);

        if ($validator->fails()) {
            throw new ValidationException($validator->errors()->toArray());
        }

    }

    /**
     * Update an existing API product.
     *
     * @param array $data refer to https://apidocs.apigee.com/docs/api-products/1/types/APIProductRequest
     *
     * @throws ValidationException
     */
    public function update(string $name, array $data): ApiProduct
    {
        $this->validateData($data);
        $response = $this->client->put('apiproducts/' . $name, $data)->json();

        return new ApiProduct($response);
    }

    /**
     * Delete an API product.
     */
    public function delete(string $name): void
    {
        $this->client->delete('apiproducts/' . $name);
    }
}
