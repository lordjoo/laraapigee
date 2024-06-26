<?php

namespace Lordjoo\LaraApigee\Exceptions;

use GuzzleHttp\Exception\ClientException;
use Psr\Http\Message\ResponseInterface;

class ApiException extends ClientException
{

    protected function parseErrorResponse(ResponseInterface $response): array
    {
        $error = [
            'code' => null,
            'message' => null,
        ];
        // Try to parse Edge error message and error code from the response body.
        $contentTypeHeader = $response->getHeaderLine('Content-Type');
        if ($contentTypeHeader && str_contains($contentTypeHeader, 'application/json')) {
            $array = json_decode((string) $response->getBody(), true);
            $array = is_array($array) ? $array : (array) $array;

            if (JSON_ERROR_NONE === json_last_error()) {
                if (array_key_exists('fault', $array)) {
                    $error['message'] = $array['fault']['faultstring'] ?? null;
                    $error['code'] = $array['fault']['detail']['errorcode'] ?? null;
                } else {
                    if (array_key_exists('code', $array)) {
                        $error['code'] = $array['code'];
                    } elseif (isset($array['error']['details'][0]['violations'][0]['type'])) {
                        // Hybrid returns the Edge error code here.
                        $error['code'] = $array['error']['details'][0]['violations'][0]['type'];
                    } elseif (isset($array['error']['code'])) {
                        // Fallback for Hybrid if the above is not set.
                        $error['code'] = $array['error']['code'];
                    }
                    if (array_key_exists('message', $array)) {
                        // It could happen that the returned message by
                        // Apigee Edge is also an array.
                        $error['message'] = is_array($array['message']) ? json_encode($array['message']) : $array['message'];
                    } elseif (isset($array['error']['message'])) {
                        $error['message'] = $array['error']['message'];
                        if (!empty($array['error']['status'])) {
                            $error['message'] = $array['error']['status'] . ': ' . $error['message'];
                        }
                    }
                }
            }
        }

        return $error;
    }

}
