<?php

namespace Lordjoo\LaraApigee\Api\Monetization\Edge\Services;

use Illuminate\Support\Collection;
use Lordjoo\LaraApigee\Api\Monetization\Edge\Contracts\Services\ReportServiceInterface;
use Lordjoo\LaraApigee\Api\Monetization\Edge\Entities\MintCriteria;
use Lordjoo\LaraApigee\Api\Monetization\Edge\Entities\ReportDefinition;
use Lordjoo\LaraApigee\Api\Monetization\Edge\Entities\ReportDefinitions;
use Lordjoo\LaraApigee\Api\Monetization\Edge\Entities\Transactions;
use Lordjoo\LaraApigee\Api\Monetization\Edge\ValueObjects\ReportOutput;

class ReportService extends AbstractEdgeMonetizationService implements ReportServiceInterface
{
    /**
     * @var array<string, string>
     */
    private const LIST_QUERY_SCHEMA = [
        'all' => 'bool',
        'size' => 'int',
        'page' => 'int',
        'sort' => 'string',
    ];

    /**
     * @var array<string, string>
     */
    private const TRANSACTION_SEARCH_QUERY_SCHEMA = [
        'all' => 'bool',
        'size' => 'int',
        'page' => 'int',
    ];

    public function listDefinitions(array $query = []): ReportDefinitions
    {
        $payload = $this->getJson('report-definitions', $this->validateQuery($query, self::LIST_QUERY_SCHEMA));

        return $this->denormalizeEntity($payload, ReportDefinitions::class);
    }

    public function getDefinitions(array $query = []): Collection
    {
        return collect($this->listDefinitions($query)->getReportDefinition());
    }

    public function createDefinition(ReportDefinition $reportDefinition): ReportDefinition
    {
        $payload = $this->postJson('report-definitions', $reportDefinition, expectedStatus: [200, 201]);

        return $this->denormalizeEntity($payload, ReportDefinition::class);
    }

    public function findDefinition(string $reportDefinitionId): ?ReportDefinition
    {
        $this->assertIdentifier($reportDefinitionId, 'reportDefinitionId');

        $payload = $this->getJsonOrNull($this->path('report-definitions/{reportDefinitionId}', [
            'reportDefinitionId' => $reportDefinitionId,
        ]));

        if ($payload === null) {
            return null;
        }

        return $this->denormalizeEntity($payload, ReportDefinition::class);
    }

    public function updateDefinition(string $reportDefinitionId, ReportDefinition $reportDefinition): ReportDefinition
    {
        $this->assertIdentifier($reportDefinitionId, 'reportDefinitionId');

        $payload = $this->putJson($this->path('report-definitions/{reportDefinitionId}', [
            'reportDefinitionId' => $reportDefinitionId,
        ]), $reportDefinition);

        return $this->denormalizeEntity($payload, ReportDefinition::class);
    }

    public function deleteDefinition(string $reportDefinitionId): bool
    {
        $this->assertIdentifier($reportDefinitionId, 'reportDefinitionId');

        return $this->deleteRequest($this->path('report-definitions/{reportDefinitionId}', [
            'reportDefinitionId' => $reportDefinitionId,
        ]), expectedStatus: [204]);
    }

    public function listDefinitionsForDeveloper(string $developerEmail, array $query = []): ReportDefinitions
    {
        $this->assertIdentifier($developerEmail, 'developerEmail');

        $payload = $this->getJson(
            $this->path('developers/{developerEmail}/report-definitions', ['developerEmail' => $developerEmail]),
            $this->validateQuery($query, self::LIST_QUERY_SCHEMA)
        );

        return $this->denormalizeEntity($payload, ReportDefinitions::class);
    }

    public function getDefinitionsForDeveloper(string $developerEmail, array $query = []): Collection
    {
        return collect($this->listDefinitionsForDeveloper($developerEmail, $query)->getReportDefinition());
    }

    public function createDefinitionForDeveloper(string $developerEmail, ReportDefinition $reportDefinition): ReportDefinition
    {
        $this->assertIdentifier($developerEmail, 'developerEmail');

        $payload = $this->postJson(
            $this->path('developers/{developerEmail}/report-definitions', ['developerEmail' => $developerEmail]),
            $reportDefinition,
            expectedStatus: [201]
        );

        return $this->denormalizeEntity($payload, ReportDefinition::class);
    }

    public function searchTransactions(MintCriteria $criteria, array $query = []): Transactions
    {
        $payload = $this->postJson(
            'transaction-search',
            $criteria,
            $this->validateQuery($query, self::TRANSACTION_SEARCH_QUERY_SCHEMA),
            [200]
        );

        return $this->denormalizeEntity($payload, Transactions::class);
    }

    public function generateRevenueReportForDeveloper(string $developerEmail, MintCriteria $criteria): ReportOutput
    {
        $this->assertIdentifier($developerEmail, 'developerEmail');

        $response = $this->postRaw(
            $this->path('developers/{developerEmail}/revenue-reports', ['developerEmail' => $developerEmail]),
            $criteria,
            expectedStatus: [200]
        );

        return ReportOutput::fromResponse($response);
    }

    public function generateReport(string $reportType, MintCriteria $criteria): ReportOutput
    {
        $this->assertIdentifier($reportType, 'reportType');

        $response = $this->postRaw($this->path('{reportType}', ['reportType' => $reportType]), $criteria, expectedStatus: [200]);

        return ReportOutput::fromResponse($response);
    }
}
