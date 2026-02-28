<?php

namespace Lordjoo\LaraApigee\Api\Monetization\ApigeeX\Services;

use Lordjoo\LaraApigee\Api\Monetization\ApigeeX\Contracts\Services\DeveloperSubscriptionServiceInterface;
use Lordjoo\LaraApigee\Api\Monetization\ApigeeX\Entities\DeveloperSubscription;
use Lordjoo\LaraApigee\ConfigReaders\ConfigDriver;
use Lordjoo\LaraApigee\HttpClient\HttpClient;
use Lordjoo\LaraApigee\Services\BaseService;
use Lordjoo\LaraApigee\Services\EntityEndpointAwareTrait;
use Lordjoo\LaraApigee\Services\EntitySerializerAwareTrait;
use Lordjoo\LaraApigee\Utility\Serializer\EntitySerializer;
use Lordjoo\LaraApigee\Utility\Serializer\EntitySerializerInterface;
use Lordjoo\LaraApigee\Utility\URLTemplate;

class DeveloperSubscriptionService extends BaseService implements DeveloperSubscriptionServiceInterface
{
    use EntityEndpointAwareTrait;
    use EntitySerializerAwareTrait;

    protected string $developerId;

    protected EntitySerializerInterface $serializer;

    public function __construct(HttpClient $httpClient, ConfigDriver $config, string $developerId)
    {
        parent::__construct($httpClient, $config);
        $this->developerId = $developerId;
        $this->serializer = new EntitySerializer();
    }

    public function list(array $query = []): array
    {
        $response = $this->getClient()->get((string) $this->getEntityPath(), ['query' => $query]);
        $payload = json_decode($response->getBody()->getContents(), true) ?? [];

        $items = collect($payload['developerSubscriptions'] ?? [])->map(function ($item) {
            return $this->getSerializer()->denormalize($item, DeveloperSubscription::class, 'json');
        });

        return [
            'developerSubscriptions' => $items,
            'nextStartKey' => $payload['nextStartKey'] ?? null,
        ];
    }

    public function create(DeveloperSubscription $subscription): DeveloperSubscription
    {
        $response = $this->getClient()->post((string) $this->getEntityPath(), [
            'json' => $this->getSerializer()->normalize($subscription, 'json'),
        ]);

        return $this->hydrate($response);
    }

    public function get(string $subscriptionId): DeveloperSubscription
    {
        $response = $this->getClient()->get((string) $this->getEntityPath('/' . $subscriptionId));

        return $this->hydrate($response);
    }

    public function expire(string $subscriptionId): DeveloperSubscription
    {
        $response = $this->getClient()->post(sprintf('%s/%s:expire', (string) $this->getEntityPath(), rawurlencode($subscriptionId)), [
            'json' => new \stdClass(),
        ]);

        return $this->hydrate($response);
    }

    protected function hydrate($response): DeveloperSubscription
    {
        return $this->getSerializer()->denormalize(
            json_decode($response->getBody()->getContents(), true),
            DeveloperSubscription::class,
            'json'
        );
    }

    protected function getEntityPath(?string $path = null): URLTemplate
    {
        $template = (new URLTemplate('organizations/{organization}/developers/{developerId}/subscriptions'))
            ->bindParam('organization', $this->config->getOrganization())
            ->bindParam('developerId', $this->developerId);

        if ($path !== null) {
            $template->appendPath($path);
        }

        return $template;
    }

    protected function getSerializer(): EntitySerializerInterface
    {
        return $this->serializer;
    }
}
