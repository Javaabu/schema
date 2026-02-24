<?php

namespace Javaabu\Schema\Tests\Unit;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Schema;
use Javaabu\Schema\Tests\TestCase;
use Javaabu\Schema\Tests\TestSupport\Enums\CityStatus;

class SchemaFacadeTest extends TestCase
{
    use RefreshDatabase;

    public function setUp(): void
    {
        parent::setUp();

        if (static::isLaravel9()) {
            $this->markTestSkipped('Builder macro\'s not supported in Laravel 9. So skipping SchemaFacadeTest.');
        }
    }

    public function test_it_can_get_column_comments_with_schema_facade(): void
    {
        $this->assertEquals('enum:' . CityStatus::class, Schema::getColumnComment('cities', 'status'));
    }

    public function test_it_can_get_table_comments_with_schema_facade(): void
    {
        $this->assertEquals('files', Schema::getTableComment('cities'));
    }
}
