<?php

arch('it will not use debugging functions')
    ->expect(['dd', 'dump', 'ray'])
    ->each->not->toBeUsed();

// expect BaseEntity to implement EntityInterface
arch('BaseEntity should implement EntityInterface')
    ->expect(\Lordjoo\LaraApigee\Entities\BaseEntity::class)
    ->toImplement(\Lordjoo\LaraApigee\Entities\EntityInterface::class);

// expect all Entities to extend BaseEntity
arch('All Entities should extend BaseEntity')
    ->expect('\Lordjoo\LaraApigee\Api\Edge\Entities')
    ->toExtend(\Lordjoo\LaraApigee\Entities\BaseEntity::class);
