<?php

namespace Javaabu\Schema\Testing\Concerns;

use Javaabu\Schema\Testing\Constraints\HasDatabaseColumnComment;

trait InteractsWithDatabaseSchema
{
    /**
     * Assert that the given column has the given comment
     *
     * @param  \Illuminate\Database\Eloquent\Model|string  $table
     * @param  string  $column
     * @param  string  $comment
     * @param  string|null  $connection
     * @return $this
     */
    protected function assertDatabaseColumnHasComment($table, string $column, string $comment, $connection = null)
    {
        $constraint = new HasDatabaseColumnComment($this->getConnection($connection, $table),  $this->getTable($table), $column);

        $this->assertThat($comment, $constraint);

        return $this;
    }
}
