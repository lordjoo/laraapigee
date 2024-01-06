<?php

namespace Lordjoo\Apigee\Api\ApigeeX;

class Authenticator
{

    public function __construct(
        protected readonly string $key_file,
        protected bool $is_cached = true,
        protected string $cache_key = 'sa_access_token',
        protected int $cache_ttl = 3600
    ) {}



    public function getToken(): string
    {
        if ($this->is_cached) {
            if (cache()->has($this->cache_key)) {
                return cache()->get($this->cache_key);
            }
        }

        $client = new \GuzzleHttp\Client();
        $response = $client->request('POST', 'https://oauth2.googleapis.com/token', [
            'form_params' => [
                'grant_type' => 'urn:ietf:params:oauth:grant-type:jwt-bearer',
                'assertion' => $this->generateJWT()
            ]
        ]);

        $response = json_decode($response->getBody()->getContents(), true);

        if ($this->is_cached) {
            cache()->put($this->cache_key, $response['access_token'], $this->cache_ttl);
        }

        return $response['access_token'];

    }

    /**
     *
     * Generate a JWT token for the service account
     *
     * @return string
     */
    private function generateJWT(): string
    {

        $service_account = json_decode(file_get_contents($this->key_file), true);
        $jet_header = base64_encode(json_encode([
            'alg' => 'RS256',
            'typ' => 'JWT'
        ]));

        $now = time();
        $jwt_payload = base64_encode(json_encode([
            'iss' => $service_account['client_email'],
            'sub' => $service_account['client_email'],
            'aud' => 'https://oauth2.googleapis.com/token',
            'iat' => $now,
            'exp' => $now + 3600,
            'scope' => 'https://www.googleapis.com/auth/cloud-platform'
        ]));

        $private_key = $service_account['private_key'];

        $signature = '';
        openssl_sign($jet_header . '.' . $jwt_payload, $signature, $private_key, 'sha256');
        return $jet_header . '.' . $jwt_payload . '.' . base64_encode($signature);

    }

}
