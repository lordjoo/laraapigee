<?php

namespace Lordjoo\LaraApigee\Contracts\Services;

use Lordjoo\LaraApigee\Api\Edge\Entities\AppCredential;

/**
 * @template TCredential of AppCredential
 * @extends EntityServiceInterface<TCredential>
 */
interface AppCredentialsServiceInterface extends EntityServiceInterface
{

    /**
     * @return TCredential
     */
    public function create(string $consumerKey, string $consumerSecret): AppCredential;

    /**
     * @return TCredential
     */
    public function load(string $consumerKey): AppCredential;

    public function delete(string $consumerKey): bool;

    /**
     * @return array<int|string, TCredential>
     */
    public function generate(
        array              $apiProducts,
        string             $keyExpiresIn = '-1'
    ): array;

    /**
     * @return TCredential
     */
    public function revoke(string $consumerKey): AppCredential;

    /**
     * @return TCredential
     */
    public function approve(string $consumerKey): AppCredential;

    /**
     * @return TCredential
     */
    public function addProducts(string $consumerKey, array $apiProducts): AppCredential;

    /**
     * @return TCredential
     */
    public function deleteApiProduct(string $consumerKey, string $apiProduct): AppCredential;

    /**
     * @return TCredential
     */
    public function setApiProductStatus(string $consumerKey, string $apiProduct, string $status): AppCredential;


}
