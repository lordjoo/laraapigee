<?php

namespace Lordjoo\LaraApigee\Api\Monetization\Edge\ValueObjects;

use Psr\Http\Message\ResponseInterface;

class ReportOutput
{
    protected string $body;

    protected ?string $contentType;

    /** @var array<string, array<int, string>> */
    protected array $headers;

    /** @var array<string, mixed>|null */
    protected ?array $decodedJson = null;

    /**
     * @param  array<string, array<int, string>>  $headers
     * @param  array<string, mixed>|null  $decodedJson
     */
    public function __construct(string $body, ?string $contentType = null, array $headers = [], ?array $decodedJson = null)
    {
        $this->body = $body;
        $this->contentType = $contentType;
        $this->headers = $headers;
        $this->decodedJson = $decodedJson;
    }

    public static function fromResponse(ResponseInterface $response): self
    {
        $body = (string) $response->getBody();
        $contentType = $response->getHeaderLine('Content-Type') ?: null;

        $decodedJson = null;
        if ($body !== '' && $contentType && str_contains(strtolower($contentType), 'json')) {
            $decoded = json_decode($body, true);
            if (is_array($decoded)) {
                $decodedJson = $decoded;
            }
        }

        return new self($body, $contentType, $response->getHeaders(), $decodedJson);
    }

    public function getBody(): string
    {
        return $this->body;
    }

    public function getContentType(): ?string
    {
        return $this->contentType;
    }

    /**
     * @return array<string, array<int, string>>
     */
    public function getHeaders(): array
    {
        return $this->headers;
    }

    public function isJson(): bool
    {
        return $this->decodedJson !== null;
    }

    /**
     * @return array<string, mixed>|null
     */
    public function json(): ?array
    {
        return $this->decodedJson;
    }
}
