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
