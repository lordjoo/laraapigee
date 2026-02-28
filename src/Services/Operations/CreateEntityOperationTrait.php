<?php

namespace Lordjoo\LaraApigee\Services\Operations;

use Lordjoo\LaraApigee\Entities\EntityInterface;
use Lordjoo\LaraApigee\Exceptions\ApiException;
use Lordjoo\LaraApigee\Services\ClientAwareTrait;
use Lordjoo\LaraApigee\Services\EntityClassAwareTrait;
use Lordjoo\LaraApigee\Services\EntityEndpointAwareTrait;
use Lordjoo\LaraApigee\Services\EntitySerializerAwareTrait;
use Symfony\Component\Serializer\Exception\ExceptionInterface;

/**
 * @template T of EntityInterface
 */
trait CreateEntityOperationTrait
{
    use ClientAwareTrait,
        EntitySerializerAwareTrait,
        EntityEndpointAwareTrait,
        EntityClassAwareTrait;

    /**
     * @param T $entity
     * @return T
     * @throws ExceptionInterface|ApiException
     */
    public function create(EntityInterface $entity): EntityInterface
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
