<?php

namespace Lordjoo\LaraApigee\Api\Monetization\Edge\Services;

use ArrayObject;
use Illuminate\Support\Collection;
use InvalidArgumentException;
use Lordjoo\LaraApigee\Api\Monetization\Edge\Support\EdgeMonetizationRequestValidator;
use Lordjoo\LaraApigee\Entities\EntityInterface;
use Lordjoo\LaraApigee\Exceptions\NotFoundException;
use Lordjoo\LaraApigee\Services\BaseService;
use Lordjoo\LaraApigee\Utility\Serializer\EntitySerializer;
use Lordjoo\LaraApigee\Utility\Serializer\EntitySerializerInterface;
use Lordjoo\LaraApigee\Utility\URLTemplate;
use Psr\Http\Message\ResponseInterface;
use RuntimeException;

abstract class AbstractEdgeMonetizationService extends BaseService
{
    protected ?EntitySerializerInterface $serializer = null;

    protected function getSerializer(): EntitySerializerInterface
    {
        if ($this->serializer instanceof EntitySerializerInterface) {
            return $this->serializer;
        }

        $this->serializer = $this->createSerializer();

        return $this->serializer;
    }

    protected function createSerializer(): EntitySerializerInterface
    {
        return new EntitySerializer;
    }

    protected function getJson(string|URLTemplate $path, array $query = [], array $expectedStatus = [200]): array
    {
        $response = $this->getClient()->get((string) $path, [
            'query' => $query,
        ]);

        $this->assertResponseStatus($response, $expectedStatus);

        return $this->decodeJsonResponse($response);
    }

    protected function getJsonOrNull(string|URLTemplate $path, array $query = [], array $expectedStatus = [200]): ?array
    {
        try {
            return $this->getJson($path, $query, $expectedStatus);
        } catch (NotFoundException $e) {
            return null;
        }
    }

    protected function postJson(string|URLTemplate $path, mixed $payload = null, array $query = [], array $expectedStatus = [200, 201]): array
    {
        $options = [];
        if ($query !== []) {
            $options['query'] = $query;
        }
        if ($payload !== null) {
            $options['json'] = $this->normalizeJsonPayload($payload);
        }

        $response = $this->getClient()->post((string) $path, $options);
        $this->assertResponseStatus($response, $expectedStatus);

        return $this->decodeJsonResponse($response);
    }

    protected function putJson(string|URLTemplate $path, mixed $payload = null, array $query = [], array $expectedStatus = [200]): array
    {
        $options = [];
        if ($query !== []) {
            $options['query'] = $query;
        }
        if ($payload !== null) {
            $options['json'] = $this->normalizeJsonPayload($payload);
        }

        $response = $this->getClient()->put((string) $path, $options);
        $this->assertResponseStatus($response, $expectedStatus);

        return $this->decodeJsonResponse($response);
    }

    protected function postRaw(string|URLTemplate $path, mixed $payload = null, array $query = [], array $expectedStatus = [200]): ResponseInterface
    {
        $options = [];
        if ($query !== []) {
            $options['query'] = $query;
        }
        if ($payload !== null) {
            $options['json'] = $this->normalizeJsonPayload($payload);
        }

        $response = $this->getClient()->post((string) $path, $options);
        $this->assertResponseStatus($response, $expectedStatus);

        return $response;
    }

    protected function deleteRequest(string|URLTemplate $path, array $query = [], array $expectedStatus = [204, 200]): bool
    {
        $response = $this->getClient()->delete((string) $path, [
            'query' => $query,
        ]);

        $this->assertResponseStatus($response, $expectedStatus);

        return true;
    }

    protected function denormalizeEntity(array $payload, string $entityClass): mixed
    {
        return $this->getSerializer()->denormalize($payload, $entityClass, 'json');
    }

    /**
     * @return Collection<int, mixed>
     */
    protected function denormalizeEntityCollection(array $items, string $entityClass): Collection
    {
        return collect($items)->map(function ($item) use ($entityClass) {
            if (! is_array($item)) {
                throw new RuntimeException(sprintf('Expected list payload item to be array for [%s].', $entityClass));
            }

            return $this->denormalizeEntity($item, $entityClass);
        })->values();
    }

    /**
     * @param  array<string, mixed>  $payload
     * @return array<int, mixed>
     */
    protected function requireListKey(array $payload, string $key, string $context): array
    {
        $items = $payload[$key] ?? [];
        if (! is_array($items)) {
            throw new RuntimeException(sprintf('%s payload key [%s] is not an array.', $context, $key));
        }

        return array_values($items);
    }

    /**
     * @param  array<string, mixed>  $query
     * @param  array<string, string>  $schema
     * @return array<string, mixed>
     */
    protected function validateQuery(array $query, array $schema): array
    {
        return EdgeMonetizationRequestValidator::normalizeQuery($query, $schema);
    }

    /**
     * @param  array<int, string>  $fields
     */
    protected function assertRequiredEntityFields(object $entity, array $fields, string $context): void
    {
        EdgeMonetizationRequestValidator::assertRequiredEntityFields($entity, $fields, $context);
    }

    protected function assertIdentifier(string $value, string $field): void
    {
        EdgeMonetizationRequestValidator::assertNonEmptyString($value, $field);
    }

    protected function path(string $pathTemplate, array $params = [], ?string $suffix = null): URLTemplate
    {
        $template = new URLTemplate($pathTemplate);

        foreach ($params as $key => $value) {
            if (! is_string($value)) {
                throw new InvalidArgumentException(sprintf('Path parameter [%s] must be a string.', $key));
            }
            $template->bindParam($key, $value);
        }

        if ($suffix !== null) {
            $template->appendPath($suffix);
        }

        return $template;
    }

    protected function decodeJsonResponse(ResponseInterface $response): array
    {
        $body = (string) $response->getBody();
        if ($body === '') {
            return [];
        }

        $decoded = json_decode($body, true);
        if (! is_array($decoded)) {
            throw new RuntimeException('Expected a JSON object/array response from Apigee monetization endpoint.');
        }

        return $decoded;
    }

    protected function assertResponseStatus(ResponseInterface $response, array $expectedStatus): void
    {
        $status = $response->getStatusCode();
        if (! in_array($status, $expectedStatus, true)) {
            throw new RuntimeException(sprintf('Unexpected response status [%d]. Expected one of: %s', $status, implode(', ', $expectedStatus)));
        }
    }

    protected function normalizeJsonPayload(mixed $payload): mixed
    {
        if ($payload instanceof EntityInterface) {
            return $this->convertNormalizedDataToArray($this->getSerializer()->normalize($payload, 'json'));
        }

        if ($payload instanceof ArrayObject) {
            return $this->convertNormalizedDataToArray($payload);
        }

        if (is_array($payload)) {
            return array_map(function ($value) {
                return $this->normalizeJsonPayload($value);
            }, $payload);
        }

        return $payload;
    }

    protected function convertNormalizedDataToArray(mixed $normalized): mixed
    {
        if ($normalized instanceof ArrayObject) {
            $normalized = $normalized->getArrayCopy();
        }

        if (is_array($normalized)) {
            foreach ($normalized as $key => $value) {
                $normalized[$key] = $this->convertNormalizedDataToArray($value);
            }
        }

        return $normalized;
    }
}
