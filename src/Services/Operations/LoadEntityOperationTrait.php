<?php

namespace Lordjoo\LaraApigee\Services\Operations;

use Lordjoo\LaraApigee\Entities\EntityInterface;
use Lordjoo\LaraApigee\Services\ClientAwareTrait;
use Lordjoo\LaraApigee\Services\EntityClassAwareTrait;
use Lordjoo\LaraApigee\Services\EntityEndpointAwareTrait;

trait LoadEntityOperationTrait
{
    use ClientAwareTrait,
        EntityEndpointAwareTrait,
        EntityClassAwareTrait;

    protected function serializeList(array $content)
    {
        if (!is_array(reset($content))) {
            return $content;
        }

        $content = reset($content);

        if ([] === $content) {
            return [];
        }

        return array_map(function ($value) {
            return $this->getSerializer()->denormalize($value, $this->getEntityClass());
        }, $content);
    }

    /**
     * @return EntityInterface[]
     * @throws \Exception|\Symfony\Component\Serializer\Exception\ExceptionInterface
     */
    public function get(): array
    {
        $path = (string) $this->getEntityPath();
        $response = $this->getClient()->get($path, [
            'query' => [
                'expand' => true,
            ]
        ]);

        $content = $response->getBody()->getContents();
        $content = json_decode($content, true);

        return $this->serializeList($content);
    }



}
