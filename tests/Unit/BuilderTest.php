<?php

namespace Javaabu\Schema\Tests\Unit;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Schema;
use Javaabu\Schema\Tests\TestCase;
use Javaabu\Schema\Tests\TestSupport\Enums\CityStatus;

class BuilderTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function it_can_get_column_comments(): void
    {
        $this->assertEquals('enum:' . CityStatus::class, Schema::getColumnComment('cities', 'status'));
    }

    /** @test */
    public function it_can_get_table_comments(): void
    {
        $this->assertEquals('files', Schema::getTableComment('cities'));
    }
}
