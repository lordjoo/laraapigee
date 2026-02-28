<?php

namespace Lordjoo\LaraApigee\Api\ApigeeX\Services;

use Lordjoo\LaraApigee\Api\ApigeeX\Contracts\Services\DeveloperAppCredentialsServiceInterface;
use Lordjoo\LaraApigee\Api\ApigeeX\Entities\AppCredential;
use Lordjoo\LaraApigee\ConfigReaders\ConfigDriver;
use Lordjoo\LaraApigee\Exceptions\NotFoundException;
use Lordjoo\LaraApigee\HttpClient\HttpClient;
use Lordjoo\LaraApigee\Services\BaseService;
use Lordjoo\LaraApigee\Utility\URLTemplate;

class DeveloperAppCredentialService extends BaseService implements DeveloperAppCredentialsServiceInterface
{
    protected string $developerId;

    protected string $appName;

    public function __construct(
        HttpClient $httpClient,
        ConfigDriver $config,
        string $developerId,
        string $appName
    ) {
        parent::__construct($httpClient, $config);
        $this->developerId = $developerId;
        $this->appName = $appName;
    }

    public function create(string $consumerKey, string $consumerSecret): AppCredential
    {
        try {
            $response = $this->getClient()->post((string) $this->getEntityPath(), [
                'json' => [
                    'consumerKey' => $consumerKey,
                    'consumerSecret' => $consumerSecret,
                ],
            ]);
        } catch (NotFoundException $exception) {
            $response = $this->getClient()->post((string) $this->getEntityPath('create'), [
                'json' => [
                    'consumerKey' => $consumerKey,
                    'consumerSecret' => $consumerSecret,
                ],
            ]);
        }

        return $this->hydrateCredential($response);
    }

    public function replace(string $consumerKey, AppCredential $credential): AppCredential
    {
        $credential->setConsumerKey($consumerKey);

        $response = $this->getClient()->put((string) $this->getEntityPath(rawurlencode($consumerKey)), [
            'json' => $this->getSerializer()->normalize($credential, 'json'),
        ]);

        return $this->hydrateCredential($response);
    }

    public function load(string $consumerKey): AppCredential
    {
        $response = $this->getClient()->get((string) $this->getEntityPath(rawurlencode($consumerKey)));

        return $this->hydrateCredential($response);
    }

    public function delete(string $consumerKey): bool
    {
        $this->getClient()->delete((string) $this->getEntityPath(rawurlencode($consumerKey)));

        return true;
    }

    public function generate(array $apiProducts, string $keyExpiresIn = '-1'): array
    {
        $response = $this->getClient()->post((string) $this->developerAppPath(), [
            'json' => [
                'apiProducts' => $apiProducts,
                'keyExpiresIn' => $keyExpiresIn,
                'name' => $this->appName,
            ],
        ]);

        $responseData = json_decode($response->getBody()->getContents(), true) ?? [];
        $credentials = $responseData['credentials'] ?? [];

        $result = [];
        foreach ($credentials as $index => $value) {
            $result[$index] = $this->getSerializer()->denormalize($value, $this->getEntityClass(), 'json');
        }

        return $result;
    }

    public function revoke(string $consumerKey): AppCredential
    {
        return $this->updateCredentialStatus($consumerKey, 'revoke');
    }

    public function approve(string $consumerKey): AppCredential
    {
        return $this->updateCredentialStatus($consumerKey, 'approve');
    }

    public function addProducts(string $consumerKey, array $apiProducts): AppCredential
    {
        $this->getClient()->post((string) $this->getEntityPath(rawurlencode($consumerKey)), [
            'json' => [
                'apiProducts' => $apiProducts,
            ],
        ]);

        return $this->load($consumerKey);
    }

    public function deleteApiProduct(string $consumerKey, string $apiProduct): AppCredential
    {
        $this->getClient()->delete((string) $this->getEntityPath(
            rawurlencode($consumerKey) . '/apiproducts/' . rawurlencode($apiProduct)
        ));

        return $this->load($consumerKey);
    }

    public function setApiProductStatus(string $consumerKey, string $apiProduct, string $status): AppCredential
    {
        $this->getClient()->post((string) $this->getEntityPath(
            rawurlencode($consumerKey) . '/apiproducts/' . rawurlencode($apiProduct)
        ), [
            'query' => [
                'action' => $status,
            ],
            'headers' => [
                'Content-Type' => 'application/octet-stream',
            ],
        ]);

        return $this->load($consumerKey);
    }

    protected function updateCredentialStatus(string $consumerKey, string $action): AppCredential
    {
        $this->getClient()->post((string) $this->getEntityPath(rawurlencode($consumerKey)), [
            'query' => [
                'action' => $action,
            ],
            'headers' => [
                'Content-Type' => 'application/octet-stream',
            ],
        ]);

        return $this->load($consumerKey);
    }

    protected function hydrateCredential($response): AppCredential
    {
        return $this->getSerializer()->denormalize(
            json_decode($response->getBody()->getContents(), true),
            $this->getEntityClass(),
            'json'
        );
    }

    protected function developerAppPath(): URLTemplate
    {
        return (new URLTemplate('developers/{developerId}/apps/{appName}'))
            ->bindParam('developerId', $this->developerId)
            ->bindParam('appName', $this->appName);
    }

    protected function getEntityPath(?string $path = null): URLTemplate
    {
        $template = (new URLTemplate('developers/{developerId}/apps/{appName}/keys'))
            ->bindParam('developerId', $this->developerId)
            ->bindParam('appName', $this->appName);

        if ($path !== null) {
            $template->appendPath($path);
        }

        return $template;
    }

    protected function getEntityClass(): string
    {
        return AppCredential::class;
    }
}
