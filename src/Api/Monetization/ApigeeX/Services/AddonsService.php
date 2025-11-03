<?php

namespace Lordjoo\LaraApigee\Api\Monetization\ApigeeX\Services;

use Lordjoo\LaraApigee\Api\Monetization\ApigeeX\Contracts\Services\AddonsServiceInterface;
use Lordjoo\LaraApigee\Api\Monetization\ApigeeX\Entities\AddonsConfig;
use Lordjoo\LaraApigee\ConfigReaders\ConfigDriver;
use Lordjoo\LaraApigee\HttpClient\HttpClient;
use Lordjoo\LaraApigee\Services\BaseService;
use Lordjoo\LaraApigee\Services\EntityEndpointAwareTrait;
use Lordjoo\LaraApigee\Services\EntitySerializerAwareTrait;
use Lordjoo\LaraApigee\Utility\Serializer\EntitySerializer;
use Lordjoo\LaraApigee\Utility\Serializer\EntitySerializerInterface;
use Lordjoo\LaraApigee\Utility\URLTemplate;

class AddonsService extends BaseService implements AddonsServiceInterface
{
    use EntityEndpointAwareTrait;
    use EntitySerializerAwareTrait;

    protected EntitySerializerInterface $serializer;

    public function __construct(HttpClient $httpClient, ConfigDriver $config)
    {
        parent::__construct($httpClient, $config);
        $this->serializer = new EntitySerializer();
    }

    public function get(): AddonsConfig
    {
        $response = $this->getClient()->get((string) $this->getEntityPath());
        $payload = json_decode($response->getBody()->getContents(), true) ?? [];

        $enabled = $payload['addonsConfig']['monetizationConfig']['enabled'] ?? null;

        return new AddonsConfig(['monetizationEnabled' => $enabled]);
    }

    public function setMonetizationEnabled(bool $enabled): array
    {
        $response = $this->getClient()->post(sprintf('%s:setAddons', (string) $this->getEntityPath()), [
            'json' => [
                'addonsConfig' => [
                    'monetizationConfig' => [
                        'enabled' => $enabled,
                    ],
                ],
            ],
        ]);

        return json_decode($response->getBody()->getContents(), true) ?? [];
    }

    protected function getEntityPath(?string $path = null): URLTemplate
    {
        $template = (new URLTemplate('organizations/{organization}'))
            ->bindParam('organization', $this->config->getOrganization());

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
