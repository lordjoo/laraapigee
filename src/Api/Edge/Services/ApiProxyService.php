<?php

namespace Lordjoo\Apigee\Api\Edge\Services;

use Illuminate\Support\Collection;

class ApiProxyService extends \Lordjoo\Apigee\Abstract\Service
{
    /**
     * Returns a list of all API proxies in the organization.
     *
     * @return Collection<\Lordjoo\Apigee\Api\Edge\Entities\ApiProxy>
     */
    public function get(): Collection
    {
        $response = $this->client->get('apis', [
            'includeMetaData' => 'true',
        ])->json();

        return collect($response)->map(function ($proxy) {
            return new \Lordjoo\Apigee\Api\Edge\Entities\ApiProxy($proxy);
        });
    }
}
