<?php

namespace Lordjoo\Apigee\Api\Edge\Services;

use Illuminate\Support\Collection;
use Lordjoo\Apigee\Abstract\Edge\Service;
use Lordjoo\Apigee\Api\Edge\Entities\ApiProxy;

class ApiProxyService extends Service
{
    /**
     * Returns a list of all API proxies in the organization.
     *
     * @return Collection<ApiProxy>
     */
    public function get(): Collection
    {
        $response = $this->client->get('apis', [
            'includeMetaData' => 'true',
        ])->json();

        return collect($response)->map(function ($proxy) {
            return new ApiProxy($proxy);
        });
    }
}
