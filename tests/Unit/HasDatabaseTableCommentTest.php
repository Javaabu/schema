<?php

namespace Javaabu\Schema\Tests\Unit;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Javaabu\Schema\Testing\Constraints\HasDatabaseColumnComment;
use Javaabu\Schema\Testing\Constraints\HasDatabaseTableComment;
use Javaabu\Schema\Tests\TestCase;
use Javaabu\Schema\Tests\TestSupport\Enums\CityStatus;

class HasDatabaseTableCommentTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function it_can_get_table_comments(): void
    {
        $constraint = new HasDatabaseTableComment($this->getConnection(null, 'cities'), 'cities');

        $this->assertEquals('files', $constraint->getTableComment());
    }
}
