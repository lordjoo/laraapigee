---
next:
    text: How to use
    link: /how-to-use
---

# Getting Started
Lara Apigee is a blazing fast and easy HTTP client to allow interaction with the Management APIs for Apigee.

## Installation

You can install the package via composer:

```bash
composer require lordjoo/laraapigee
```
The package will automatically register itself.

Publish the config file with:
```bash
php artisan vendor:publish --provider="Lordjoo\Apigee\LaravelApigeeServiceProvider" --tag="config"
```

## Configuration
We built our package to work with multiple sources to load the configuration from, in the `config.php` you will find a key called `driver` which you can set to one of the following values:
```php
\Lordjoo\Apigee\ConfigReaders\ConfigFileDriver::class,
\Lordjoo\Apigee\ConfigReaders\ConfigDBDriver::class,
```

### Config File Driver
This driver will load the configuration from the `config/apigee.php` file, which have the following keys and by default they load their values from the environment variables:
```php
'endpoint' => env('APIGEE_ENDPOINT', 'https://api.enterprise.apigee.com/v1'),
'organization' => env('APIGEE_ORGANIZATION', 'default'),
'username' => env('APIGEE_USERNAME', 'default'),
'password' => env('APIGEE_PASSWORD', 'default'),
```

### DB Driver
This driver will load the configuration from the database, if you want to use this driver you need to create a table with the following columns as defined in the config file 
```php
'db' => [
    'table_name' => 'apigee_config',
    'columns' => [
        'organization' => 'organization',
        'endpoint' => 'endpoint',
        'username' => 'username',
        'password' => 'password',
    ],
],
```

### Creating a custom driver
Let's say you want to load the configuration from a custom source,
you can do that by creating a class that implements the `Lordjoo\Apigee\ConfigReaders\ConfigReaderInterface` interface, 
and then you can set the driver to the full class name in the `config.php` file.

