<?php

namespace Lordjoo\LaraApigee\Tests;

use Illuminate\Database\Eloquent\Factories\Factory;
use Lordjoo\LaraApigee\LaraApigeeServiceProvider;
use Orchestra\Testbench\TestCase as Orchestra;

class TestCase extends Orchestra
{
    protected function setUp(): void
    {
        parent::setUp();
    }

    protected function getPackageProviders($app)
    {
        return [
            LaraApigeeServiceProvider::class,
        ];
    }

    public function getEnvironmentSetUp($app)
    {
        config()->set('database.default', 'testing');
    }
}
