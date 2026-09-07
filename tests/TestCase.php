<?php

namespace Shureban\LaravelSumsubSdk\Tests;

use Illuminate\Config\Repository;
use Illuminate\Container\Container;
use Illuminate\Translation\ArrayLoader;
use Illuminate\Translation\Translator;
use PHPUnit\Framework\TestCase as BaseTestCase;
use ReflectionProperty;

/**
 * Standalone test case: boots a minimal container with the package config,
 * the object-mapper config and a translator, so the suite runs without a Laravel application.
 */
abstract class TestCase extends BaseTestCase
{
    protected const API_KEY    = 'app-token-123';
    protected const SECRET_KEY = 'secret-key';
    protected const KYC_LEVEL  = 'basic-kyc-level';
    protected const KYB_LEVEL  = 'basic-kyb-level';

    protected function setUp(): void
    {
        parent::setUp();

        $this->putEnv('SUMSUB_KYC_LEVEL', self::KYC_LEVEL);
        $this->putEnv('SUMSUB_KYB_LEVEL', self::KYB_LEVEL);
        $this->putEnv('SUMSUB_API_KEY', self::API_KEY);
        $this->putEnv('SUMSUB_SECRET_KEY', self::SECRET_KEY);

        $container = new Container();
        $container->instance('config', new Repository([
            'sumsub'        => require __DIR__ . '/../config/sumsub.php',
            'object_mapper' => require __DIR__ . '/../vendor/shureban/laravel-object-mapper/config/object_mapper.php',
            'app'           => ['timezone' => 'UTC'],
        ]));
        $container->instance('translator', new Translator(new ArrayLoader(), 'en'));

        Container::setInstance($container);
    }

    protected function tearDown(): void
    {
        Container::setInstance(null);

        parent::tearDown();
    }

    /**
     * @param string $name
     *
     * @return string
     */
    protected function fixture(string $name): string
    {
        return file_get_contents(__DIR__ . '/Fixtures/' . $name);
    }

    /**
     * @param object $object
     * @param string $property
     * @param mixed  $value
     *
     * @return void
     */
    protected function setPrivateProperty(object $object, string $property, mixed $value): void
    {
        $reflection = new ReflectionProperty($object, $property);
        $reflection->setValue($object, $value);
    }

    /**
     * @param string $key
     * @param string $value
     *
     * @return void
     */
    private function putEnv(string $key, string $value): void
    {
        putenv(sprintf('%s=%s', $key, $value));
        $_ENV[$key]    = $value;
        $_SERVER[$key] = $value;
    }
}
