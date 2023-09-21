<?php

namespace Lordjoo\Apigee\Tests;

use Lordjoo\Apigee\LaravelApigeeServiceProvider;
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
            LaravelApigeeServiceProvider::class
        ];
    }

    public function getEnvironmentSetUp($app)
    {
        //        $username = env("APIGEE_USERNAME");
        //        $password = env("APIGEE_PASSWORD");
        //        $organization = env("APIGEE_ORGANIZATION");
        //        $host = env("APIGEE_ENDPOINT");
    }
}
