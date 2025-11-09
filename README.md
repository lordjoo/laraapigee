# Laravel Apigee

## Getting Started
1. Install the package via composer:
```bash
composer require lordjoo/laraapigee
```

2. Set the environment variables in your `.env` file:
```dotenv
APIGEE_USERNAME=
APIGEE_PASSWORD=
APIGEE_ENDPOINT=
APIGEE_ORGANIZATION=
APIGEE_MONETIZATION_ENABLED=false
APIGEE_MONETIZATION_PLATFORM=edge # or apigee_x
APIGEE_MONETIZATION_ENDPOINT=https://api.enterprise.apigee.com/v1/mint
```

## Usage Example
```php
// fetch all developers
\Lordjoo\LaraApigee\Facades\LaraApigee::edge()->developers()->get();


// create a developer
$dev = new \Lordjoo\LaraApigee\Api\Edge\Entities\Developer();
$dev->setFirstName('Ammar')->setLastName("Agha")->setEmail('ammar@apigee.com')->setUserName('ammar');

$dev = \Lordjoo\LaraApigee\Facades\LaraApigee::edge()->developers()->create($dev);

// update a developer
$dev->setFirstName('Ammar')->setLastName("Aghaa");
$dev = \Lordjoo\LaraApigee\Facades\LaraApigee::edge()->developers()->update($dev->getEmail(), $dev);

```

## Monetization

### Edge (Mint) monetization packages

Edge organizations continue to use the existing monetization package APIs:

```php
// requires APIGEE_MONETIZATION_PLATFORM=edge
\Lordjoo\LaraApigee\Facades\LaraApigee::monetization()->apiPackages()->get();
```

### Apigee X monetization

Set `APIGEE_MONETIZATION_PLATFORM=apigee_x`, point `APIGEE_MONETIZATION_ENDPOINT` to `https://apigee.googleapis.com/v1`, and provide a service-account key file that has the Apigee Monetization scopes. You can then manage rate plans, developer subscriptions, balances, and monetization settings:

```php
$monetization = \Lordjoo\LaraApigee\Facades\LaraApigee::monetization();

// List rate plans for a product
$plans = $monetization->ratePlans('my-product')->list();

// Create a developer subscription
$subscription = new \Lordjoo\LaraApigee\Api\Monetization\ApigeeX\Entities\DeveloperSubscription([
    'apiproduct' => 'organizations/my-org/apiproducts/my-product',
    'startTime' => (string) (time() * 1000),
]);

$monetization->developerSubscriptions('developer@example.com')->create($subscription);

// Enable monetization at the organization level
$monetization->addons()->setMonetizationEnabled(true);
```
