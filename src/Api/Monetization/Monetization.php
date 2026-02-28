<?php

namespace Lordjoo\LaraApigee\Api\Monetization;

use BadMethodCallException;
use InvalidArgumentException;
use Lordjoo\LaraApigee\Api\Monetization\ApigeeX\Monetization as ApigeeXMonetization;
use Lordjoo\LaraApigee\Api\Monetization\Edge\Monetization as EdgeMonetization;
use Lordjoo\LaraApigee\ConfigReaders\ConfigDriver;

/**
 * @mixin EdgeMonetization
 * @mixin ApigeeXMonetization
 */
class Monetization
{
    public const PLATFORM_EDGE = 'edge';
    public const PLATFORM_APIGEE_X = 'apigee_x';

    private EdgeMonetization|ApigeeXMonetization $driver;

    public function __construct(ConfigDriver $config)
    {
        $platform = strtolower($config->getMonetizationPlatform());

        $this->driver = match ($platform) {
            self::PLATFORM_APIGEE_X => new ApigeeXMonetization($config),
            self::PLATFORM_EDGE, '' => new EdgeMonetization($config),
            default => throw new InvalidArgumentException("Unsupported monetization platform: {$platform}"),
        };
    }

    public function getDriver(): EdgeMonetization|ApigeeXMonetization
    {
        return $this->driver;
    }

    public function __call(string $name, array $arguments)
    {
        if (!method_exists($this->driver, $name)) {
            throw new BadMethodCallException(sprintf('Method %s is not supported by the %s monetization driver.', $name, $this->driver::class));
        }

        return $this->driver->$name(...$arguments);
    }
}
