<?php

namespace Lordjoo\LaraApigee\Api\Edge\Contracts;

use Lordjoo\LaraApigee\Api\Edge\Entities\AppCredential;
use Lordjoo\LaraApigee\Contracts\Service\EntityServiceInterface;

interface AppCredentialsServiceInterface extends EntityServiceInterface
{

    public function create(string $consumerKey, string $consumerSecret): AppCredential;

    public function load(string $consumerKey): AppCredential;

    public function delete(string $consumerKey): bool;

    public function generate(
        array              $apiProducts,
        string             $keyExpiresIn = '-1'
    ): array;

    public function revoke(string $consumerKey): AppCredential;

    public function approve(string $consumerKey): AppCredential;

    public function addProducts(string $consumerKey, array $apiProducts): AppCredential;

    public function deleteApiProduct(string $consumerKey, string $apiProduct): AppCredential;

    public function setApiProductStatus(string $consumerKey, string $apiProduct, string $status): AppCredential;


}
