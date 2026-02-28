<?php

namespace Lordjoo\LaraApigee\Api\Monetization\Edge\Contracts\Services;

use Illuminate\Support\Collection;
use Lordjoo\LaraApigee\Api\Monetization\Edge\Entities\MintCriteria;
use Lordjoo\LaraApigee\Api\Monetization\Edge\Entities\ReportDefinition;
use Lordjoo\LaraApigee\Api\Monetization\Edge\Entities\ReportDefinitions;
use Lordjoo\LaraApigee\Api\Monetization\Edge\Entities\Transactions;
use Lordjoo\LaraApigee\Api\Monetization\Edge\ValueObjects\ReportOutput;
use Lordjoo\LaraApigee\Contracts\Services\EntityServiceInterface;

/**
 * @extends EntityServiceInterface<ReportDefinition>
 */
interface ReportServiceInterface extends EntityServiceInterface
{
    public function listDefinitions(array $query = []): ReportDefinitions;

    /**
     * @return Collection<int, ReportDefinition>
     */
    public function getDefinitions(array $query = []): Collection;

    public function createDefinition(ReportDefinition $reportDefinition): ReportDefinition;

    public function findDefinition(string $reportDefinitionId): ?ReportDefinition;

    public function updateDefinition(string $reportDefinitionId, ReportDefinition $reportDefinition): ReportDefinition;

    public function deleteDefinition(string $reportDefinitionId): bool;

    public function listDefinitionsForDeveloper(string $developerEmail, array $query = []): ReportDefinitions;

    /**
     * @return Collection<int, ReportDefinition>
     */
    public function getDefinitionsForDeveloper(string $developerEmail, array $query = []): Collection;

    public function createDefinitionForDeveloper(string $developerEmail, ReportDefinition $reportDefinition): ReportDefinition;

    public function searchTransactions(MintCriteria $criteria, array $query = []): Transactions;

    public function generateRevenueReportForDeveloper(string $developerEmail, MintCriteria $criteria): ReportOutput;

    public function generateReport(string $reportType, MintCriteria $criteria): ReportOutput;
}
