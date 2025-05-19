<?php

namespace Lordjoo\LaraApigee\Api\ApigeeX\Entities;

use Lordjoo\LaraApigee\Api\Edge\Entities\App as EdgeApp;

class App extends EdgeApp
{
    public string $developerId;

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
