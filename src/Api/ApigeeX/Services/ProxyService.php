<?php

namespace Lordjoo\LaraApigee\Api\ApigeeX\Services;

use Illuminate\Support\Collection;
use Lordjoo\LaraApigee\Api\ApigeeX\Entities\Proxy;
use Lordjoo\LaraApigee\Api\ApigeeX\Entities\ProxyDeployment;
use Lordjoo\LaraApigee\Services\BaseService;
use Lordjoo\LaraApigee\Services\EntityClassAwareTrait;
use Lordjoo\LaraApigee\Services\EntityEndpointAwareTrait;
use Lordjoo\LaraApigee\Services\Operations\LoadEntityOperationTrait;
use Lordjoo\LaraApigee\Utility\URLTemplate;

class ProxyService extends BaseService
{
    use EntityEndpointAwareTrait,
        EntityClassAwareTrait,
        LoadEntityOperationTrait;


    protected string $entityClass;

    public function get($query = []): Collection
    {
        $path = (string) $this->getEntityPath();
        $response = $this->getClient()->get($path, [
            'query' => array_merge([
                'includeMetaData' => true,
            ], $query),
        ]);

        $content = $response->getBody()->getContents();
        $content = json_decode($content, true);

        return $this->serializeList($content);
    }

    /**
     * Returns a collection of deployed proxies in the given environment.
     * @param string $environment
     * @return Collection
     */
    public function deployed(string $environment): Collection
    {
        $path = (string) new URLTemplate("environments/{$environment}/deployments");
        $response = $this->getClient()->get($path);

        $content = $response->getBody()->getContents();
        $content = json_decode($content, true);

        $this->entityClass = ProxyDeployment::class;
//        dd($content);

        return $this->serializeList($content);
    }


    public function getEntityClass(): string
    {
        return $this->entityClass ?? Proxy::class;
    }

    public function getEntityPath(?string $path = null): URLTemplate
    {
        return new URLTemplate('apis/');
    }

}
