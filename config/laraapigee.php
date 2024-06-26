<?php

return [

    /*
     * The type of the Apigee which we are using
     *
     * Available options are: edge, x
     */
    "type" => env('APIGEE_TYPE', 'edge'),

    /*
     * The driver which is responsible for reading the configuration.
     *
     * it should implements the ConfigReaderInterface
     */
    'driver' => \Lordjoo\LaraApigee\ConfigReaders\ConfigFileDriver::class,

    /*
     * The endpoint which we will use in the API calls
     *
     * NOTE: if you are using the ConfigFileDriver, you should set the endpoint in the config file
     */
    'endpoint' => env('APIGEE_ENDPOINT', 'https://api.enterprise.apigee.com/v1'),

    /*
     * The organization name which we will use in the API calls
     *
     * NOTE: if you are using the ConfigFileDriver, you should set the organization name in the config file
     */
    'organization' => env('APIGEE_ORGANIZATION', 'default'),

    /*
     * The username which we will use in the API calls
     *
     * NOTE: if you are using the ConfigFileDriver, you should set the username in the config file
     */
    'username' => env('APIGEE_USERNAME', 'default'),

    /*
     * The password which we will use in the API calls
     *
     * NOTE: if you are using the ConfigFileDriver, you should set the password in the config file
     */
    'password' => env('APIGEE_PASSWORD', 'default'),

    /*
     * The monetization endpoint which we will use in the API calls
     *
     * NOTE: if you are using the ConfigFileDriver, you should set the monetization endpoint in the config file
     */
    'monetization' => [
        'enabled' => env('APIGEE_MONETIZATION_ENABLED', false),
        'endpoint' => env('APIGEE_MONETIZATION_ENDPOINT', 'https://api.enterprise.apigee.com/v1/mint/organizations'),
    ],

    // Only When using the ConfigDBDriver you should set the following values
    'db' => [
        'table_name' => 'apigee_config',
        'columns' => [
            'organization' => 'organization',
            'endpoint' => 'endpoint',
            'username' => 'username',
            'password' => 'password',
            'monetization' => [
                'enabled' => 'monetization_enabled',
                'endpoint' => 'monetization_endpoint',
            ],
        ],
    ],


    /**
     *
     * Only for Apigee X authentication
     * The path to the service account key file
     * The file should be in the storage/app folder
     *
     */
    "key_file" => storage_path('app/service_account_key.json'),
];
