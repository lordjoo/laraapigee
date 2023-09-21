---
prev: 
    link: /getting-started
    text: Getting Started
---

# How to use
The main entry for the package is the `Apigee.php` class, and we have made a singleton for it so you can access it anywhere in your application,
and of you can use the `Apigee` Facade to access it as well.

By default when the package is booted the configuration will automatically be loaded from the config driver you specified in the config file, and then configure the http client with the loaded configuration.


## Usage Example

::: tip
Since at the moment we only support the edge management APIs, we will asume that the `$client` variable is defined as follows 
```php
$client = app(\Lordjoo\Apigee\Apigee::class)->edge();
```
:::

### List all API Proxies
```php
$apis = $client->apis()->get();
```
this will return a collection of `\Lordjoo\Apigee\Api\Edge\Entities\ApiProxy` objects.

### List all environments
This will be an example of how you can call an API that isn't supported by the package yet, but you can still use the package to make the call.
```php
$environments = $client->httpClient->get('environments')->json();
```
the `httpClient` property is an instance of `Illuminate\Http\Client\PendingRequest` and it's already been configured with the loaded configuration.

::: info
we already have a `enviornmenrs()` method in the Edge client, but this is just an example.
:::



