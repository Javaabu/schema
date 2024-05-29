<?php

namespace Javaabu\Schema\Testing\Constraints;

use Illuminate\Database\Connection;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Illuminate\Testing\Exceptions\InvalidArgumentException;
use PHPUnit\Framework\Constraint\Constraint;

class HasDatabaseColumnComment extends Constraint
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
     * The database column
     *
     * @var string
     */
    protected string $column;

    /**
     * Create a new constraint instance.
     *
     * @param  \Illuminate\Database\Connection  $database
     * @return void
     */
    public function __construct(Connection $database, string $table, string $column)
    {
        $this->table = $table;
        $this->column = $column;
        $this->database = $database;
    }

    /**
     * Get the column comment
     */
    public function getColumnComment(): string
    {

        $column_info = $this->database->getSchemaBuilder()->getColumns($this->table);

        foreach ($column_info as $column) {
            if ($column['name'] == $this->column) {
                return $column['comment'];
            }
        }

        throw new InvalidArgumentException(sprintf("No such column [%s] in the table %s.", $this->column, $this->table));
    }

    /**
     * Check if the comment is found in the given column.
     *
     * @param  string  $other
     * @return bool
     */
    public function matches($other): bool
    {
        return $this->getColumnComment() == $other;
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
            "the column [%s] in the table [%s] has the comment \"%s\".",
            $this->column, $this->table, $other
        );
    }

    public function toString(): string
    {
        return json_encode([
            'table' => $this->table,
            'column' => $this->column
        ]);
    }
}
