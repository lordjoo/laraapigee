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

### Edge (Mint) monetization

Set `APIGEE_MONETIZATION_PLATFORM=edge` and configure `APIGEE_MONETIZATION_ENDPOINT` to your Edge management endpoint (for example `https://api.enterprise.apigee.com/v1/mint`). The Edge monetization driver now covers the core Mint domains used by NinjaPortal:

- API packages
- API products (including eligible products for companies/developers)
- Billing adjustments
- Developers (monetization developer profile lookups)
- Rate plans (organization/package/developer acceptance flows)
- Credits
- Refunds
- Reports (definitions, transaction search, and report generation)

```php
$mint = \Lordjoo\LaraApigee\Facades\LaraApigee::monetization();

// List monetization packages (wrapper keeps totalRecords metadata)
$packages = $mint->apiPackages()->list(['page' => 1, 'size' => 20]);

// Add a product to a package (pass product-specific rate plans only when needed)
$mint->apiPackages()->addProduct('package-id', 'product-id');

// Find monetization information for a developer
$developer = $mint->developers()->find('developer@example.com');

// Create a package rate plan
$ratePlan = new \Lordjoo\LaraApigee\Api\Monetization\Edge\Entities\RatePlan([
    'name' => 'standard-plan',
    'displayName' => 'Standard Plan',
]);
$mint->ratePlans()->createForPackage('package-id', $ratePlan);

// Issue a credit (query-parameter based API)
$credit = (new \Lordjoo\LaraApigee\Api\Monetization\Edge\ValueObjects\IssueCreditRequest())
    ->setBillingMonth('JULY')
    ->setBillingYear(2024)
    ->setCurrencyId('usd')
    ->setDeveloperId('developer-id')
    ->setTransactionAmount('25.00')
    ->setTransactionNote('Promotional credit');

$mint->credits()->issueToDeveloper('package-id', 'plan-id', $credit);

// Search transaction activity
$criteria = new \Lordjoo\LaraApigee\Api\Monetization\Edge\Entities\MintCriteria([
    'billingMonth' => 'JULY',
    'billingYear' => '2024',
]);
$transactions = $mint->reports()->searchTransactions($criteria, ['page' => 1, 'size' => 50]);
```

`generateReport()` and `generateRevenueReportForDeveloper()` return a `ReportOutput` value object so you can safely handle JSON/CSV payloads and response headers.

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
