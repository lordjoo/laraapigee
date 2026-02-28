<?php

use GuzzleHttp\Psr7\Response;
use Illuminate\Support\Collection;
use Lordjoo\LaraApigee\Api\Monetization\Edge\Entities\AcceptRatePlan;
use Lordjoo\LaraApigee\Api\Monetization\Edge\Entities\ApiPackage;
use Lordjoo\LaraApigee\Api\Monetization\Edge\Entities\IdOrgReference;
use Lordjoo\LaraApigee\Api\Monetization\Edge\Entities\MintCriteria;
use Lordjoo\LaraApigee\Api\Monetization\Edge\Entities\SimpleReference;
use Lordjoo\LaraApigee\Api\Monetization\Edge\Services\ApiPackageService;
use Lordjoo\LaraApigee\Api\Monetization\Edge\Services\ApiProductService;
use Lordjoo\LaraApigee\Api\Monetization\Edge\Services\BillingAdjustmentService;
use Lordjoo\LaraApigee\Api\Monetization\Edge\Services\CreditService;
use Lordjoo\LaraApigee\Api\Monetization\Edge\Services\DeveloperService;
use Lordjoo\LaraApigee\Api\Monetization\Edge\Services\RatePlanService;
use Lordjoo\LaraApigee\Api\Monetization\Edge\Services\RefundService;
use Lordjoo\LaraApigee\Api\Monetization\Edge\Services\ReportService;
use Lordjoo\LaraApigee\Api\Monetization\Edge\ValueObjects\IssueCreditRequest;
use Lordjoo\LaraApigee\Api\Monetization\Edge\ValueObjects\RefundRequest;
use Lordjoo\LaraApigee\Tests\Support\FakeConfigDriver;
use Lordjoo\LaraApigee\Tests\Support\FakeHttpClient;

it('lists api packages with typed mapping and metadata', function () {
    $http = new FakeHttpClient([
        new Response(200, [], json_encode([
            'monetizationPackage' => [[
                'id' => 'pkg-1',
                'name' => 'pkg-1',
                'displayName' => 'Package 1',
                'description' => 'Test package',
                'status' => 'CREATED',
                'product' => [['id' => 'prod-1', 'name' => 'prod-1']],
            ]],
            'totalRecords' => 1,
        ])),
    ]);

    $service = new ApiPackageService($http, new FakeConfigDriver);
    $result = $service->list(['all' => false, 'page' => 1, 'size' => 20, 'monetized' => true]);

    expect($result->getTotalRecords())->toBe(1)
        ->and($result->getMonetizationPackage())->toHaveCount(1)
        ->and($result->getMonetizationPackage()[0])->toBeInstanceOf(ApiPackage::class)
        ->and($result->getMonetizationPackage()[0]->getApiProducts()[0]->getId())->toBe('prod-1');

    expect($http->requests[0]['uri'])->toBe('monetization-packages')
        ->and($http->requests[0]['options']['query'])->toMatchArray([
            'all' => false,
            'page' => 1,
            'size' => 20,
            'monetized' => true,
        ]);
});

it('issues credit and sends required data as query parameters without json body', function () {
    $http = new FakeHttpClient([
        new Response(201, [], json_encode(['id' => 'tx-1', 'type' => 'CREDIT'])),
    ]);

    $request = (new IssueCreditRequest)
        ->setBillingMonth('JULY')
        ->setBillingYear(2024)
        ->setCurrencyId('usd')
        ->setDeveloperId('dev-1')
        ->setTransactionAmount('25.50')
        ->setTransactionNote('Promotional credit');

    $service = new CreditService($http, new FakeConfigDriver);
    $tx = $service->issueToDeveloper('pkg-1', 'plan-1', $request);

    expect($tx->getId())->toBe('tx-1');
    expect($http->requests[0]['method'])->toBe('POST');
    expect($http->requests[0]['uri'])->toBe('monetization-packages/pkg-1/rate-plans/plan-1/real-currency-credit-transactions');
    expect($http->requests[0]['options'])->not->toHaveKey('json');
    expect($http->requests[0]['options']['query'])->toMatchArray([
        'billingMonth' => 'JULY',
        'billingYear' => '2024',
        'currencyId' => 'usd',
        'developerId' => 'dev-1',
        'transactionAmount' => '25.50',
        'transactionNote' => 'Promotional credit',
    ]);
});

it('parses developer accepted rate plan payloads even when the schema shape is inconsistent', function () {
    $http = new FakeHttpClient([
        new Response(201, [], json_encode([[
            'id' => 'drp-1',
            'startDate' => '2024-01-01 00:00:00',
            'developer' => ['email' => 'dev@example.com'],
            'ratePlan' => ['id' => 'rp-1', 'name' => 'rate-plan'],
        ]])),
    ]);

    $payload = (new AcceptRatePlan)
        ->setDeveloper((new SimpleReference)->setId('dev-1'))
        ->setRatePlan((new SimpleReference)->setId('rp-1'))
        ->setStartDate('2024-01-01 00:00:00');

    $service = new RatePlanService($http, new FakeConfigDriver);
    $accepted = $service->acceptForDeveloper('dev@example.com', $payload);

    expect($accepted)->toHaveCount(1)
        ->and($accepted->first()->getId())->toBe('drp-1')
        ->and($accepted->first()->getRatePlan()->getId())->toBe('rp-1');
});

it('returns report output for generate report and maps transaction search responses', function () {
    $http = new FakeHttpClient([
        new Response(200, [], json_encode([
            'totalRecords' => 1,
            'transaction' => [['id' => 'tx-1', 'type' => 'PURCHASE']],
        ])),
        new Response(200, ['Content-Type' => 'application/json'], json_encode([
            'reportRows' => [['id' => 'r1']],
        ])),
    ]);

    $criteria = (new MintCriteria)
        ->setBillingMonth('JULY')
        ->setBillingYear('2024')
        ->setDevCriteria([(new IdOrgReference)->setId('dev-1')->setOrgId('test-org')]);

    $service = new ReportService($http, new FakeConfigDriver);
    $transactions = $service->searchTransactions($criteria, ['page' => 1, 'size' => 20, 'all' => false]);
    $report = $service->generateReport('revenue-reports', $criteria);

    expect($transactions->getTotalRecords())->toBe(1)
        ->and($transactions->getTransaction()[0]->getId())->toBe('tx-1')
        ->and($report->isJson())->toBeTrue()
        ->and($report->json())->toMatchArray(['reportRows' => [['id' => 'r1']]]);
});

it('posts refunds using query parameters and no json payload', function () {
    $http = new FakeHttpClient([
        new Response(201, [], json_encode(['id' => 'tx-ref-1', 'type' => 'REFUND'])),
    ]);

    $request = (new RefundRequest)
        ->setParentTxId('tx-parent-1')
        ->setRefundAmount(10.5)
        ->setRevenueType('RATECARD')
        ->setTransactionNote('Customer refund');

    $service = new RefundService($http, new FakeConfigDriver);
    $tx = $service->post('pkg-1', $request);

    expect($tx->getType())->toBe('REFUND')
        ->and($http->requests[0]['options'])->not->toHaveKey('json')
        ->and($http->requests[0]['options']['query']['parentTxId'])->toBe('tx-parent-1');
});

it('returns collections from edge monetization convenience list methods', function () {
    $config = new FakeConfigDriver;

    $apiPackages = new ApiPackageService(new FakeHttpClient([
        new Response(200, [], json_encode([
            'monetizationPackage' => [['id' => 'pkg-1', 'name' => 'pkg-1']],
            'totalRecords' => 1,
        ])),
    ]), $config);

    $apiProducts = new ApiProductService(new FakeHttpClient([
        new Response(200, [], json_encode([
            'product' => [['id' => 'prod-1', 'name' => 'prod-1']],
        ])),
    ]), $config);

    $billingAdjustments = new BillingAdjustmentService(new FakeHttpClient([
        new Response(200, [], json_encode([
            'billingAdjustment' => [[
                'id' => 'adj-1',
                'name' => 'adj-1',
                'billingMonth' => 'JULY',
                'billingYear' => 2024,
                'adjustmentPercentageFactor' => 10,
                'organization' => ['id' => 'org-1'],
            ]],
            'totalRecords' => 1,
        ])),
    ]), $config);

    $developers = new DeveloperService(new FakeHttpClient([
        new Response(200, [], json_encode([
            'developer' => [['id' => 'dev-1', 'email' => 'dev@example.com']],
            'totalRecords' => 1,
        ])),
    ]), $config);

    $ratePlans = new RatePlanService(new FakeHttpClient([
        new Response(200, [], json_encode([
            'ratePlan' => [['id' => 'rp-1', 'name' => 'rp-1']],
            'totalRecords' => 1,
            'total' => 1,
        ])),
    ]), $config);

    $reports = new ReportService(new FakeHttpClient([
        new Response(200, [], json_encode([
            'reportDefinition' => [['id' => 'rd-1', 'name' => 'Revenue report']],
            'totalRecords' => 1,
        ])),
    ]), $config);

    expect($apiPackages->get())->toBeInstanceOf(Collection::class)
        ->and($apiProducts->get())->toBeInstanceOf(Collection::class)
        ->and($billingAdjustments->get())->toBeInstanceOf(Collection::class)
        ->and($developers->get())->toBeInstanceOf(Collection::class)
        ->and($ratePlans->getForOrganization())->toBeInstanceOf(Collection::class)
        ->and($reports->getDefinitions())->toBeInstanceOf(Collection::class);
});
