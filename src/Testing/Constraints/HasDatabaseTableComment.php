<?php

namespace Javaabu\Schema\Testing\Constraints;

use Illuminate\Database\Connection;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Illuminate\Testing\Exceptions\InvalidArgumentException;
use PHPUnit\Framework\Constraint\Constraint;

class HasDatabaseTableComment extends Constraint
{
    /**
     * The database connection.
     *
     * @var \Illuminate\Database\Connection
     */
    protected Connection $database;

    /**
     * The database table
     *
     * @var string
     */
    protected string $table;

    /**
     * Create a new constraint instance.
     *
     * @param  \Illuminate\Database\Connection  $database
     * @return void
     */
    public function __construct(Connection $database, string $table)
    {
        $this->table = $table;
        $this->database = $database;
    }

    /**
     * Get the column comment
     */
    public function getTableComment(): ?string
    {
        return $this->database->getSchemaBuilder()->getTableComment($this->table);
    }

    /**
     * Check if the comment is found in the given column.
     *
     * @param  string  $other
     * @return bool
     */
    public function matches($other): bool
    {
        return $this->getTableComment() == $other;
    }

    /**
     * Get the description of the failure.
     *
     * @param  string  $other
     * @return string
     */
    public function failureDescription($other): string
    {
        return sprintf(
            "the table [%s] in the database [%s] has the comment \"%s\".",
            $this->table, $this->database->getDatabaseName(), $other
        );
    }

    public function toString(): string
    {
        return json_encode([
            'table' => $this->table
        ]);
    }
}
