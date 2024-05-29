<?php

namespace Javaabu\Schema\Tests\Unit;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Javaabu\Schema\Testing\Constraints\HasDatabaseColumnComment;
use Javaabu\Schema\Tests\TestCase;
use Javaabu\Schema\Tests\TestSupport\Enums\CityStatus;

class HasDatabaseColumnCommentTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function it_can_get_column_comments(): void
    {
        $constraint = new HasDatabaseColumnComment($this->getConnection(null, 'cities'), 'cities', 'status');

        $this->assertEquals('enum:' . CityStatus::class, $constraint->getColumnComment());
    }
}
