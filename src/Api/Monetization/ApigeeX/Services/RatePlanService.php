<?php

namespace Lordjoo\LaraApigee\Api\Monetization\ApigeeX\Services;

use Illuminate\Support\Collection;
use Lordjoo\LaraApigee\Api\Monetization\ApigeeX\Contracts\Services\RatePlanServiceInterface;
use Lordjoo\LaraApigee\Api\Monetization\ApigeeX\Entities\RatePlan;
use Lordjoo\LaraApigee\ConfigReaders\ConfigDriver;
use Lordjoo\LaraApigee\Entities\EntityInterface;
use Lordjoo\LaraApigee\HttpClient\HttpClient;
use Lordjoo\LaraApigee\Services\BaseService;
use Lordjoo\LaraApigee\Services\EntityClassAwareTrait;
use Lordjoo\LaraApigee\Services\EntityEndpointAwareTrait;
use Lordjoo\LaraApigee\Services\Operations\CrudOperationsTrait;
use Lordjoo\LaraApigee\Utility\Serializer\EntitySerializer;
use Lordjoo\LaraApigee\Utility\Serializer\EntitySerializerInterface;
use Lordjoo\LaraApigee\Utility\URLTemplate;

class RatePlanService extends BaseService implements RatePlanServiceInterface
{
    use CrudOperationsTrait {
        create as traitCreate;
        update as traitUpdate;
        get as traitGet;
    }
    use EntityClassAwareTrait;
    use EntityEndpointAwareTrait;

    protected string $apiProduct;

    public function __construct(HttpClient $httpClient, ConfigDriver $config, string $apiProduct)
    {
        parent::__construct($httpClient, $config);
        $this->apiProduct = $apiProduct;
    }

    public function list(array $query = []): array
    {
        $response = $this->getClient()->get((string) $this->getEntityPath(), [
            'query' => $query,
        ]);

        $payload = json_decode($response->getBody()->getContents(), true) ?? [];

        $items = collect($payload['ratePlans'] ?? [])->map(function ($item) {
            return $this->getSerializer()->denormalize($item, $this->getEntityClass(), 'json');
        });

        return [
            'ratePlans' => $items,
            'nextStartKey' => $payload['nextStartKey'] ?? null,
        ];
    }

    public function get(): Collection
    {
        return $this->list()['ratePlans'];
    }

    public function create(EntityInterface $entity): EntityInterface
    {
        $this->ensureRatePlanMetadata($entity);
        return $this->traitCreate($entity);
    }

    public function update(string $entityId, EntityInterface $entity): EntityInterface
    {
        $this->ensureRatePlanMetadata($entity);

        return $this->traitUpdate($entityId, $entity);
    }

    protected function ensureRatePlanMetadata(EntityInterface $entity): void
    {
        if ($entity instanceof RatePlan && !$entity->getApiproduct()) {
            $entity->setApiproduct(sprintf(
                'organizations/%s/apiproducts/%s',
                $this->config->getOrganization(),
                $this->apiProduct
            ));
        }
    }

    protected function getEntityClass(): string
    {
        return RatePlan::class;
    }

    protected function getEntityPath(?string $path = null): URLTemplate
    {
        $template = (new URLTemplate('organizations/{organization}/apiproducts/{apiProduct}/rateplans'))
            ->bindParam('organization', $this->config->getOrganization())
            ->bindParam('apiProduct', $this->apiProduct);

        if ($path !== null) {
            $template->appendPath($path);
        }

        return $template;
    }

    protected function getSerializer(): EntitySerializerInterface
    {
        return new EntitySerializer();
    }
}
