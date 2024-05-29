<?php

namespace Javaabu\Schema\Tests\Feature;

use Javaabu\Schema\Tests\TestCase;
use Javaabu\Schema\Tests\TestSupport\Enums\CityStatus;

class SchemaTest extends TestCase
{
    /** @test */
    public function it_can_create_an_enum_column(): void
    {
        $this->assertDatabaseColumnHasComment('cities', 'status', 'enum:' . CityStatus::class);
    }
}