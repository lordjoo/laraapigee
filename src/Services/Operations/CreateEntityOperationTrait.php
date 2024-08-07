<?php

namespace Lordjoo\LaraApigee\Services\Operations;

use Lordjoo\LaraApigee\Entities\IEntity;
use Lordjoo\LaraApigee\Exceptions\ApiException;
use Lordjoo\LaraApigee\Services\ClientAwareTrait;
use Lordjoo\LaraApigee\Services\EntityClassAwareTrait;
use Lordjoo\LaraApigee\Services\EntityEndpointAwareTrait;
use Lordjoo\LaraApigee\Services\EntitySerializerAwareTrait;
use Symfony\Component\Serializer\Exception\ExceptionInterface;

trait CreateEntityOperationTrait
{
    use ClientAwareTrait,
        EntitySerializerAwareTrait,
        EntityEndpointAwareTrait,
        EntityClassAwareTrait;

    /**
     * @param IEntity $entity
     * @return IEntity|null
     * @throws ExceptionInterface|ApiException
     */
    public function create(IEntity $entity): IEntity
    {
        $path = (string) $this->getEntityPath();
        $data = $this->getSerializer()->normalize($entity,'json');
        $response = $this->getClient()->post($path, [
            'json' => $data
        ]);

        $responseData = json_decode($response->getBody()->getContents(), true);
        return $this->getSerializer()->denormalize($responseData, $this->getEntityClass(), 'json');

    }

}
