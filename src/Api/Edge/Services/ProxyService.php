<?php

namespace Lordjoo\Apigee\Api\Edge\Services;

use Illuminate\Support\Collection;
use Lordjoo\Apigee\Abstract\BaseService;
use Lordjoo\Apigee\Entities\ApiProxy;

class ProxyService extends BaseService
{
    /**
     * Returns a list of all API proxies in the organization.
     *
     * @return Collection<\Lordjoo\Apigee\Entities\ApiProxy>
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
