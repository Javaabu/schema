<?php

namespace Javaabu\Schema\Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Javaabu\Schema\Tests\TestCase;
use Javaabu\Schema\Tests\TestSupport\Enums\CityStatus;

class BlueprintTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function it_can_create_an_enum_column(): void
    {
        $this->assertDatabaseColumnHasComment('cities', 'status', 'enum:' . CityStatus::class);
    }
}
