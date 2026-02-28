# LaraApigee Contributions Guide

This document defines how we keep LaraApigee maintainable and IDE-friendly across Apigee Edge and Apigee X implementations.

## Goals

- Keep service APIs discoverable in IDEs (autocomplete + static analysis).
- Keep shared behavior centralized while preserving platform-specific types.
- Make adding new services predictable and low-risk.

## Contract Layering (Required)

Use a 2-layer contract approach for services:

1. Shared contract in `src/Contracts/Services`
- Defines common behavior and method signatures.
- Uses phpdoc templates (`@template`) for entity-aware typing.

2. Platform contract in `src/Api/Edge/Contracts/Services` and/or `src/Api/ApigeeX/Contracts/Services`
- Extends the shared contract.
- Binds template types to concrete platform entities via `@extends`.

Why: this gives us one behavior contract with precise return types per platform.

## Service Implementation Rules

- Each concrete service must implement its platform contract (not only the shared contract).
- Public methods must have explicit return types where possible.
- Methods with entity return values must include phpdoc with concrete entity types.
- If a method returns a collection of entities, document it as `Collection<int, EntityType>`.
- Custom operations (for example `setStatus`, `traffic`, `deployed`) must be documented with precise params and return types.

## API Entry Points (Edge / ApigeeX)

Entry-point classes must return platform contracts:

- `src/Api/Edge/Edge.php`
- `src/Api/ApigeeX/ApigeeX.php`

Do not return shared contracts from these factories, otherwise IDEs lose platform context.

## Adding a New Service (Checklist)

1. Add or confirm entity class for each platform (if platform-specific).
2. Create/update shared contract in `src/Contracts/Services`.
3. Create platform contract(s) that extend shared contract with typed `@extends`.
4. Implement concrete service in platform `Services` namespace and implement platform contract.
5. Add/update factory method in `Edge.php` and/or `ApigeeX.php` with platform contract return type.
6. Add phpdoc for custom methods and collection shapes.
7. Run lint:
```bash
find backend/packages/laraapigee/src -name "*.php" -print0 | xargs -0 -n1 php -l
```

## Example Pattern

Shared contract:
```php
/**
 * @template TEntity of \Lordjoo\LaraApigee\Entities\EntityInterface
 * @extends EntityCrudServiceInterface<TEntity>
 */
interface DeveloperServiceInterface extends EntityCrudServiceInterface
{
    /**
     * @return TEntity|null
     */
    public function setStatus(string $email, string $status);
}
```

Edge contract:
```php
use Lordjoo\LaraApigee\Api\Edge\Entities\Developer;

/**
 * @extends \Lordjoo\LaraApigee\Contracts\Services\DeveloperServiceInterface<Developer>
 */
interface DeveloperServiceInterface extends \Lordjoo\LaraApigee\Contracts\Services\DeveloperServiceInterface
{
}
```

Edge service:
```php
class DeveloperService extends BaseService implements DeveloperServiceInterface
{
    /**
     * @return Developer|null
     */
    public function setStatus(string $email, string $status)
    {
        // ...
    }
}
```

## Platform Differences

- If a capability exists only in one platform, keep its contract and service in that platform namespace only.
- Avoid forcing unsupported methods into shared contracts.

## Backward Compatibility Notes

- Prefer adding new typed contracts over breaking existing class names.
- If you rename a service class, add a migration note in the changelog and update all factory methods.

## Review Criteria

A contribution is ready when:

- Contracts are layered correctly.
- IDE autocomplete shows concrete entity types from entry points.
- No ambiguous return docs remain on public service methods.
- PHP lint passes for touched files.
