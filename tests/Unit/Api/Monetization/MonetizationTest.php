<?php

use Lordjoo\LaraApigee\Api\Monetization\ApigeeX\Contracts\Services\RatePlanServiceInterface;
use Lordjoo\LaraApigee\Api\Monetization\Edge\Contracts\Services\ApiPackageServiceInterface;
use Lordjoo\LaraApigee\Api\Monetization\Monetization;
use Lordjoo\LaraApigee\ConfigReaders\ConfigDriver;

describe('Monetization platform selection', function () {
    it('returns edge API packages service when platform is edge', function () {
        $config = new class extends ConfigDriver {
            public function getOrganization(): string { return 'test-org'; }
            public function getEndpoint(): string { return 'https://example.com/v1'; }
            public function getUserName(): string { return 'user'; }
            public function getPassword(): string { return 'pass'; }
            public function getMonetizationEnabled(): bool { return true; }
            public function getMonetizationEndpoint(): string { return 'https://example.com/v1/mint'; }
            public function getKeyFile(): string { return __FILE__; }
            public function get(string $key): string { return ''; }
            public function getMonetizationPlatform(): string { return 'edge'; }
        };

        $monetization = new Monetization($config);

        expect($monetization->apiPackages())->toBeInstanceOf(ApiPackageServiceInterface::class);
        expect(fn () => $monetization->ratePlans('my-product'))
            ->toThrow(\BadMethodCallException::class);
    });

    it('returns apigee x services when platform is apigee_x', function () {
        $keyFile = tempnam(sys_get_temp_dir(), 'apigee-key-');
        file_put_contents($keyFile, json_encode([
            'client_email' => 'service-account@example.iam.gserviceaccount.com',
            'private_key' => "-----BEGIN PRIVATE KEY-----\nMIIB...fake...\n-----END PRIVATE KEY-----\n",
        ]));

        $config = new class($keyFile) extends ConfigDriver {
            public function __construct(private string $keyFile) {}
            public function getOrganization(): string { return 'test-org'; }
            public function getEndpoint(): string { return 'https://example.com/v1'; }
            public function getUserName(): string { return 'user'; }
            public function getPassword(): string { return 'pass'; }
            public function getMonetizationEnabled(): bool { return true; }
            public function getMonetizationEndpoint(): string { return 'https://example.com/v1'; }
            public function getKeyFile(): string { return $this->keyFile; }
            public function get(string $key): string { return ''; }
            public function getMonetizationPlatform(): string { return 'apigee_x'; }
        };

        $monetization = new Monetization($config);

        expect($monetization->ratePlans('my-product'))
            ->toBeInstanceOf(RatePlanServiceInterface::class);
        expect(fn () => $monetization->apiPackages())
            ->toThrow(\BadMethodCallException::class);

        unlink($keyFile);
    });
});
