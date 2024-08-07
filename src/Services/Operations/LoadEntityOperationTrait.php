<?php

namespace Lordjoo\LaraApigee\Services\Operations;

use Lordjoo\LaraApigee\Entities\IEntity;
use Lordjoo\LaraApigee\Services\ClientAwareTrait;
use Lordjoo\LaraApigee\Services\EntityClassAwareTrait;
use Lordjoo\LaraApigee\Services\EntityEndpointAwareTrait;

trait LoadEntityOperationTrait
{
    use ClientAwareTrait,
        EntityEndpointAwareTrait,
        EntityClassAwareTrait;

    /**
     * @return IEntity[]
     * @throws \Exception|\Symfony\Component\Serializer\Exception\ExceptionInterface
     */
    public function get(): array
    {
        $path = (string) $this->getEntityPath();
        $response = $this->getClient()->get($path, [
            "query" => [
                "expand" => "true"
            ]
        ]);

        $content = $response->getBody()->getContents();
        $content = json_decode($content, true);
        $content = reset($content);

        if ([] === $content) {
            return [];
        }
        $res = [];
        foreach ($content as $key => $value) {
            $res[$key] = $this->getSerializer()->denormalize($value, $this->getEntityClass());
        }

        return $res;
    }

}
