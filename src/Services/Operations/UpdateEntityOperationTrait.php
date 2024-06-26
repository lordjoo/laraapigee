<?php

namespace Lordjoo\LaraApigee\Services\Operations;

use Lordjoo\LaraApigee\Entities\IEntity;
use Lordjoo\LaraApigee\Services\ClientAwareTrait;
use Lordjoo\LaraApigee\Services\EntityClassAwareTrait;
use Lordjoo\LaraApigee\Services\EntityEndpointAwareTrait;
use Lordjoo\LaraApigee\Services\EntitySerializerAwareTrait;
use Symfony\Component\Serializer\Exception\ExceptionInterface;

trait UpdateEntityOperationTrait
{
    use ClientAwareTrait,
        EntitySerializerAwareTrait,
        EntityEndpointAwareTrait,
        EntityClassAwareTrait;

    /**
     * @param string $entityId
     * @param IEntity $entity
     * @return IEntity|null
     * @throws ExceptionInterface
     */
    public function update(string $entityId, IEntity $entity): ?IEntity
    {
        $path = (string) $this->getEntityPath("/$entityId");
        $data = $this->getSerializer()->normalize($entity, 'json');
        $response = $this->getClient()->put($path, [
            'json' => $data
        ]);

        $responseData = json_decode($response->getBody()->getContents(), true);
        return $this->getSerializer()->denormalize($responseData, $this->getEntityClass(), 'json');
    }
}
