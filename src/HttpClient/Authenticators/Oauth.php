<?php

namespace Lordjoo\LaraApigee\HttpClient\Authenticators;

use Firebase\JWT\JWT;
use GuzzleHttp\Client;
use Illuminate\Support\Facades\Cache;

class Oauth implements AuthenticatorInterface
{

    /**
     * Authorization server for Apigee on GCP authentication.
     *
     * @var string
     */
    public const DEFAULT_AUTHORIZATION_SERVER = 'https://oauth2.googleapis.com/token';

    /**
     * A space-delimited list of the permissions that the application requests.
     *
     * @var string
     */
    public const TOKEN_SCOPES = 'https://www.googleapis.com/auth/cloud-platform';

    /**
     * Grant type used in an access token request.
     *
     * @see https://developers.google.com/identity/protocols/OAuth2ServiceAccount
     *
     * @var string
     */
    public const GRANT_TYPE = 'urn:ietf:params:oauth:grant-type:jwt-bearer';


    protected string $clientEmail;

    protected string $privateKey;

    public function __construct(
        string $clientEmail,
        string $privateKey
    ) {
        $this->clientEmail = $clientEmail;
        $this->privateKey = $privateKey;
    }

    public function getAccessToken(): string
    {
        $now = time();
        $token = [
            'iss' => $this->clientEmail,
            'aud' => self::DEFAULT_AUTHORIZATION_SERVER,
            'scope' => self::TOKEN_SCOPES,
            'iat' => $now,
            // Have the token expire in the maximum allowed time of an hour.
            'exp' => $now + (60 * 60),
        ];

        try {
            $jwt = JWT::encode($token, $this->privateKey, 'RS256');
        } catch (\Exception $e) {
            throw new \RuntimeException('Failed to create JWT: ' . $e->getMessage());
        }

        $body = [
            'grant_type' => self::GRANT_TYPE,
            'assertion' => $jwt,
        ];

        try {
            $response = $this->getClient()->post('', [
                'body' => json_encode($body),
                'headers' => [
                    'Content-Type' => 'application/json',
                ],
            ]);

            $response = json_decode($response->getBody()->getContents(), true);

            Cache::put('apigee_access_token', $response['access_token'], $response['expires_in']);

            return $response['access_token'];
        } catch (\Exception $e) {
            throw new \RuntimeException('Failed to get access token: ' . $e->getMessage());
        }


    }

    public function getAuthHeader(): string
    {
        $cached = Cache::get('apigee_access_token');
        if ($cached) {
            return 'Bearer ' . $cached;
        }
        return 'Bearer ' . $this->getAccessToken();
    }

    /**
     * @return Client
     */
    protected function getClient(): Client
    {
        return new Client([
            'base_uri' => self::DEFAULT_AUTHORIZATION_SERVER,
        ]);
    }

}
