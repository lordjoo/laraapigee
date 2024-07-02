<?php

namespace Lordjoo\LaraApigee\Utility;

class URLTemplate
{
    protected string $baseURL;
    protected array $params = [];

    public function __construct(string $baseURL)
    {
        $this->baseURL = $baseURL;
    }

    /**
     * Bind a value to a URL parameter.
     *
     * @param string $key The parameter placeholder
     * @param string $value The value to substitute
     */
    public function bindParam(string $key, string $value): self
    {
        $this->params[$key] = $value;
        return $this;
    }

    /**
     * Get the complete URL with parameter substitutions.
     *
     * @return string The generated URL
     */
    public function getURL(): string
    {
        $url = $this->baseURL;
        foreach ($this->params as $key => $value) {
            $url = str_replace('{' . $key . '}', rawurlencode($value), $url);
        }
        return $url;
    }

    /**
     * Append additional path segments to the base URL.
     *
     * @param string $path The path segment to append
     * @return self
     */
    public function appendPath(?string $path = ""): self
    {
        $this->baseURL = rtrim($this->baseURL, '/') . '/' . ltrim($path, '/');
        return $this;
    }

    /**
     * Return the base URL as a string.
     *
     * @return string
     */
    public function __toString(): string
    {
        return $this->getURL();
    }
}
