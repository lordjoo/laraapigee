<?php

namespace Lordjoo\LaraApigee\Api\Edge\Entities;

class DeveloperApp extends App
{
    protected string $developerId;

    public function getDeveloperId(): string
    {
        return $this->developerId;
    }

    public function setDeveloperId(string $developerId): self
    {
        $this->developerId = $developerId;
        return $this;
    }
}
