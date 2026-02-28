<?php

namespace Lordjoo\LaraApigee\Api\Monetization\ApigeeX\Services;

use Lordjoo\LaraApigee\Api\Monetization\ApigeeX\Contracts\Services\DeveloperBalanceServiceInterface;
use Lordjoo\LaraApigee\Api\Monetization\ApigeeX\Entities\DeveloperBalance;
use Lordjoo\LaraApigee\Api\Monetization\ApigeeX\Entities\Money;
use Lordjoo\LaraApigee\ConfigReaders\ConfigDriver;
use Lordjoo\LaraApigee\HttpClient\HttpClient;
use Lordjoo\LaraApigee\Services\BaseService;
use Lordjoo\LaraApigee\Services\EntityEndpointAwareTrait;
use Lordjoo\LaraApigee\Services\EntitySerializerAwareTrait;
use Lordjoo\LaraApigee\Utility\Serializer\EntitySerializer;
use Lordjoo\LaraApigee\Utility\Serializer\EntitySerializerInterface;
use Lordjoo\LaraApigee\Utility\URLTemplate;

class DeveloperBalanceService extends BaseService implements DeveloperBalanceServiceInterface
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

    public function get(): DeveloperBalance
    {
        $response = $this->getClient()->get($this->balanceUri());

        return $this->hydrate($response);
    }

    public function credit(Money $amount, string $transactionId): DeveloperBalance
    {
        $response = $this->getClient()->post($this->balanceUri(':credit'), [
            'json' => [
                'transactionAmount' => $this->getSerializer()->normalize($amount, 'json'),
                'transactionId' => $transactionId,
            ],
        ]);

        return $this->hydrate($response);
    }

    public function adjust(Money $adjustment): DeveloperBalance
    {
        $response = $this->getClient()->post($this->balanceUri(':adjust'), [
            'json' => [
                'adjustment' => $this->getSerializer()->normalize($adjustment, 'json'),
            ],
        ]);

        return $this->hydrate($response);
    }

    protected function hydrate($response): DeveloperBalance
    {
        return $this->getSerializer()->denormalize(
            json_decode($response->getBody()->getContents(), true),
            DeveloperBalance::class,
            'json'
        );
    }

    protected function getEntityPath(?string $path = null): URLTemplate
    {
        $template = (new URLTemplate('organizations/{organization}/developers/{developerId}/balance'))
            ->bindParam('organization', $this->config->getOrganization())
            ->bindParam('developerId', $this->developerId);

        if ($path !== null) {
            $template->appendPath($path);
        }

        return $template;
    }

    protected function balanceUri(string $suffix = ''): string
    {
        $base = (string) $this->getEntityPath();

        return $suffix ? $base . $suffix : $base;
    }

    protected function getSerializer(): EntitySerializerInterface
    {
        return $this->serializer;
    }
}
