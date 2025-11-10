<?php

namespace Lordjoo\LaraApigee\Api\Monetization\ApigeeX\Services;

use Lordjoo\LaraApigee\Api\Monetization\ApigeeX\Contracts\Services\DeveloperMonetizationConfigServiceInterface;
use Lordjoo\LaraApigee\Api\Monetization\ApigeeX\Entities\DeveloperMonetizationConfig;
use Lordjoo\LaraApigee\ConfigReaders\ConfigDriver;
use Lordjoo\LaraApigee\HttpClient\HttpClient;
use Lordjoo\LaraApigee\Services\BaseService;
use Lordjoo\LaraApigee\Services\EntityEndpointAwareTrait;
use Lordjoo\LaraApigee\Services\EntitySerializerAwareTrait;
use Lordjoo\LaraApigee\Utility\Serializer\EntitySerializer;
use Lordjoo\LaraApigee\Utility\Serializer\EntitySerializerInterface;
use Lordjoo\LaraApigee\Utility\URLTemplate;

class DeveloperMonetizationConfigService extends BaseService implements DeveloperMonetizationConfigServiceInterface
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

    public function get(): DeveloperMonetizationConfig
    {
        $response = $this->getClient()->get((string) $this->getEntityPath());

        return $this->hydrate($response);
    }

    public function update(DeveloperMonetizationConfig $config): DeveloperMonetizationConfig
    {
        $response = $this->getClient()->put((string) $this->getEntityPath(), [
            'json' => $this->getSerializer()->normalize($config, 'json'),
        ]);

        return $this->hydrate($response);
    }

    protected function hydrate($response): DeveloperMonetizationConfig
    {
        return $this->getSerializer()->denormalize(
            json_decode($response->getBody()->getContents(), true),
            DeveloperMonetizationConfig::class,
            'json'
        );
    }

    protected function getEntityPath(?string $path = null): URLTemplate
    {
        $template = (new URLTemplate('organizations/{organization}/developers/{developerId}/monetizationConfig'))
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
