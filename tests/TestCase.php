<?php

namespace Javaabu\Schema\Tests;

use Javaabu\Schema\Testing\Concerns\InteractsWithDatabaseSchema;
use Orchestra\Testbench\TestCase as BaseTestCase;
use Javaabu\Schema\SchemaServiceProvider;
use Javaabu\Schema\Tests\TestSupport\Providers\TestServiceProvider;

abstract class TestCase extends BaseTestCase
{
    use InteractsWithDatabaseSchema;

    public static function isLaravel9(): bool
    {
        return version_compare(app()->version(), '9.0', '>=') && version_compare(app()->version(), '10.0', '<');
    }

    public function setUp(): void
    {
        parent::setUp();

        $this->app['config']->set('app.key', 'base64:yWa/ByhLC/GUvfToOuaPD7zDwB64qkc/QkaQOrT5IpE=');

        $this->app['config']->set('session.serialization', 'php');

    }

    protected function getPackageProviders($app)
    {
        return [
            SchemaServiceProvider::class,
            TestServiceProvider::class
        ];
    }
}
