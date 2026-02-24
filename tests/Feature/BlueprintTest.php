<?php

namespace Javaabu\Schema\Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Schema;
use Javaabu\Schema\Tests\TestCase;
use Javaabu\Schema\Tests\TestSupport\Enums\CityStatus;

class BlueprintTest extends TestCase
{
    use RefreshDatabase;

    public function test_it_can_create_an_enum_column(): void
    {
        $this->assertTrue(Schema::hasColumn('cities', 'status'));
        $this->assertEquals(static::isLaravel9() ? 'string' : 'varchar', Schema::getColumnType('cities', 'status'));

        if (! static::isLaravel9()) {
            $this->assertDatabaseColumnHasComment('cities', 'status', 'enum:' . CityStatus::class);
        }
    }
}
