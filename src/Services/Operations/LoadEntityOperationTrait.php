<?php

namespace Lordjoo\LaraApigee\Services\Operations;

use Illuminate\Support\Collection;
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
        if ([] === $content) {
            return collect();
        }

        if (!is_array(reset($content))) {
            return $content;
        }

        $content = reset($content);

        if ([] === $content) {
            return collect();
        }

        return collect($content)->map(function ($value) {
            return $this->getSerializer()->denormalize($value, $this->getEntityClass());
        }, $content);
    }

    /**
     * @return EntityInterface[]
     * @throws \Exception|\Symfony\Component\Serializer\Exception\ExceptionInterface
     */
    public function get($query = []): Collection
    {
        $path = (string) $this->getEntityPath();
        $response = $this->getClient()->get($path, [
            'query' => array_merge([
                'expand' => "true",
            ], $query),
        ]);

        $content = $response->getBody()->getContents();
        $content = json_decode($content, true);

        return $this->serializeList($content);
    }



}
