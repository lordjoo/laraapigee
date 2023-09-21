# Laravel Apigee API Client
This package provides a Laravel-based API client for interacting with Apigee


## Installation

You can install the package via composer:

```bash
composer require lordjoo/laravel-apigee
```

## How to use
So first of all, we're registering a single instance of the Apigee Client in the Service Container. This is done in the `register` method of the `ApigeeServiceProvider` class (singleton).   
We also have a facade for the client ```Apigee```

```php
use Lordjoo\Apigee\Facades\Apigee;

// this will return a collection of ApiProxyResource
$apiProxies = Apigee::apiProxy()->get();

// this will return a collection of ApiProductResource
$apiProducts = Apigee::apiProduct()->get();

Apigee::apiProduct()->create([...])
Apigee::apiProduct()->update([...])
Apigee::apiProduct()->delete([...])

// this will return a collection of DeveloperResource
$developers = Apigee::developer()->get();

Apigee::developer()->create([...])
Apigee::developer()->update([...])
Apigee::developer()->delete([...])

// to get developer apps, you can use aoos() method on the DeveloperResource or use the Facade
$apps = Apigee::developer()->get()->first()->apps();
// or
$apps = Apigee::developerApps($developerIdOrEmail)->get();


// To Be Continued...
```


## Endpoints
### Edge API

* API Proxies
  * [x] List API Proxies
* API Products
  * [x] List API Products
  * [x] Create API Product
  * [x] Update API Product
  * [x] Delete API Product
* Developers
  * [x] List Developers
  * [x] Get By Email or ID
  * [x] Create Developer
  * [x] Update Developer
  * [x] Delete Developer
  * Apps
    * [x] List Apps
    * [x] Get By ID
    * [x] Create App
    * [x] Update App
    * [x] Delete App
    * [x] Generate Key
    * [x] Update Key
    * [x] Delete Key
  * [ ] Subscriptions
* [ ] Companies
* [-] Monetization
* [ ] Analytics
* [x] Environments

