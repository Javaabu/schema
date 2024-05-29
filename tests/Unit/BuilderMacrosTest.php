<?php

namespace Javaabu\Schema\Tests\Unit;

use Illuminate\Database\Schema\Builder;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Javaabu\Schema\BuilderMacros;
use Javaabu\Schema\Tests\TestCase;
use Javaabu\Schema\Tests\TestSupport\Enums\CityStatus;

class BuilderMacrosTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function it_can_get_column_comments(): void
    {
        $this->assertEquals('enum:' . CityStatus::class, BuilderMacros::getColumnComment(app()->make(Builder::class), 'cities', 'status'));
    }

    /** @test */
    public function it_can_get_table_comments(): void
    {
        $this->assertEquals('files', BuilderMacros::getTableComment(app()->make(Builder::class), 'cities'));
    }
}
