<?php

namespace Lordjoo\LaraApigee\Api\Edge\Services;

use Lordjoo\LaraApigee\Api\Edge\Entities\AppCredential;
use Lordjoo\LaraApigee\ConfigReaders\ConfigDriver;
use Lordjoo\LaraApigee\Entities\Structure\AttributesProperty;
use Lordjoo\LaraApigee\HttpClient\HttpClient;
use Lordjoo\LaraApigee\Services\BaseService;
use Lordjoo\LaraApigee\Services\EntityClassAwareTrait;
use Lordjoo\LaraApigee\Services\EntityEndpointAwareTrait;
use Lordjoo\LaraApigee\Services\EntitySerializerAwareTrait;
use Lordjoo\LaraApigee\Utility\URLTemplate;
use Symfony\Component\Serializer\Exception\ExceptionInterface;

abstract class AppCredentialsService extends BaseService
{
    use EntityEndpointAwareTrait,
        EntitySerializerAwareTrait,
        EntityClassAwareTrait;

    protected string $appName;

    public function __construct(
        HttpClient   $httpClient,
        ConfigDriver $config,
        string       $appName
    )
    {
        parent::__construct($httpClient, $config);
        $this->appName = $appName;
    }

    /**
     * Create a new app credential
     *
     * @param string $consumerKey
     * @param string $consumerSecret
     * @return AppCredential
     * @throws ExceptionInterface
     */
    public function create(string $consumerKey, string $consumerSecret): AppCredential
    {
        $response = $this->getClient()->post($this->getEntityPath()->appendPath('/create')->getURL(), [
            "json" => [
                'consumerKey' => $consumerKey,
                'consumerSecret' => $consumerSecret
            ]
        ]);
        $responseData = json_decode($response->getBody()->getContents(), true);
        return $this->getSerializer()->denormalize($responseData, $this->getEntityClass(), 'json');
    }

    /**
     * Load an app credential
     *
     * @param string $consumerKey
     * @return AppCredential
     * @throws ExceptionInterface
     */
    public function load(string $consumerKey): AppCredential
    {
        $response = $this->getClient()->get($this->getEntityPath()->appendPath( "/{$consumerKey}")->getURL());
        $responseData = json_decode($response->getBody()->getContents(), true);
        return $this->getSerializer()->denormalize($responseData, $this->getEntityClass(), 'json');
    }

    /**
     * Generate a new app credential
     *
     * @param array $apiProducts
     * @param AttributesProperty|null $appAttributes
     * @param string $callbackUrl
     * @param array $scopes
     * @param string $keyExpiresIn
     * @return array
     * @throws ExceptionInterface
     */
    public function generate(
        array              $apiProducts,
        AttributesProperty $appAttributes = null,
        string             $callbackUrl = "",
        array              $scopes = [],
        string             $keyExpiresIn = '-1'
    ): array
    {
        $path = 'developers/' . rawurlencode($this->developerId) . '/apps/' . rawurlencode($this->appName);
        $response = $this->getClient()->put(
            $path, [
            "json" => [
                'apiProducts' => $apiProducts,
                'appAttributes' => $this->getSerializer()->normalize($appAttributes, 'json'),
                'callbackUrl' => $callbackUrl,
                'scopes' => $scopes,
                'keyExpiresIn' => $keyExpiresIn
            ]
        ]);
        $responseData = json_decode($response->getBody()->getContents(), true);
        $data = [];
        foreach ($responseData['credentials'] as $key => $value) {
            $data[$key] = $this->getSerializer()->denormalize($value, $this->getEntityClass());
        }
        return $data;
    }

    /**
     * Add products to an app credential
     *
     * @param string $consumerKey
     * @param array $apiProducts
     * @return AppCredential
     * @throws ExceptionInterface
     */
    public function addProducts(string $consumerKey, array $apiProducts): AppCredential
    {
        $this->getClient()->post(
            $this->getEntityPath()->appendPath("/{$consumerKey}")->getURL(), [
            "json" => [
                'apiProducts' => $apiProducts
            ]
        ]);
        return $this->load($consumerKey);
    }

    /**
     * Remove products from an app credential
     *
     * @param string $consumerKey
     * @param string $apiProduct
     * @param string $status
     * @return AppCredential
     * @throws ExceptionInterface
     */
    public function setApiProductStatus(string $consumerKey, string $apiProduct, string $status): AppCredential
    {
        $this->getClient()->post(
            $this->getEntityPath()->appendPath("/{$consumerKey}/apiproducts/".rawurlencode($apiProduct))->getURL(), [
            "query" => [
                "action" => $status
            ],
            "headers" => [
                "Content-Type" => "application/octet-stream"
            ]
        ]);
        return $this->load($consumerKey);
    }

    /**
     * Delete an app credential
     *
     * @param string $consumerKey
     * @param string $apiProduct
     * @return AppCredential
     * @throws ExceptionInterface
     */
    public function deleteApiProduct(string $consumerKey, string $apiProduct): AppCredential
    {
        $this->getClient()->delete(
            $this->getEntityPath()->appendPath("/{$consumerKey}/apiproducts/".rawurlencode($apiProduct))->getURL()
        );
        return $this->load($consumerKey);
    }


    /**
     * Delete an app credential
     *
     * @param string $consumerKey
     * @return void
     */
    public function delete(string $consumerKey): void
    {
        $this->getClient()->delete($this->getEntityPath()->appendPath("/{$consumerKey}")->getURL());
    }

    /**
     * Revoke an app credential
     *
     * @param string $consumerKey
     * @return AppCredential
     * @throws ExceptionInterface
     */
    public function approve(string $consumerKey): AppCredential
    {
        $this->getClient()->post(
            $this->getEntityPath()->appendPath("/{$consumerKey}")->getURL(), [
            "json" => [
                'status' => 'approved'
            ],
            "headers" => [
                "Content-Type" => "application/octet-stream"
            ]
        ]);
        return $this->load($consumerKey);
    }

    /**
     * Reject an app credential
     *
     * @param string $consumerKey
     * @return AppCredential
     * @throws ExceptionInterface
     */
    public function revoke(string $consumerKey): AppCredential
    {
        $this->getClient()->post(
            $this->getEntityPath()->appendPath("/{$consumerKey}")->getURL(), [
            "query" => [
                'action' => 'revoke'
            ],
            "headers" => [
                "Content-Type" => "application/octet-stream"
            ]
        ]);
        return $this->load($consumerKey);
    }


    protected function getEntityPath(?string $path = null): URLTemplate
    {
        return (new URLTemplate('apps/{appName}/keys'))
            ->bindParam('appName', $this->appName)->appendPath($path);
    }


    protected function getEntityClass(): string
    {
        return AppCredential::class;
    }
}
