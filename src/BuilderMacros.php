<?php

namespace Javaabu\Schema;

use Illuminate\Database\Schema\Builder;
use InvalidArgumentException;

class BuilderMacros
{
    public static function getColumnComment(Builder $builder, string $table, string $column, bool $fail_on_missing = false): ?string
    {
        $column_info = $builder->getColumns($table);

        foreach ($column_info as $col) {
            if ($col['name'] == $column) {
                return $col['comment'];
            }
        }

        if ($fail_on_missing) {
            throw new InvalidArgumentException(sprintf("No such column [%s] in the table [%s].", $column, $table));
        }

        return null;
    }

    public static function getTableComment(Builder $builder, string $table, bool $fail_on_missing = false): ?string
    {
        $table_info = $builder->getTables();

        foreach ($table_info as $info) {
            if ($info['name'] == $table) {
                return $info['comment'];
            }
        }

        if ($fail_on_missing) {
            throw new InvalidArgumentException(sprintf("No such table [%s] in the database [%s].", $table, $builder->getConnection()->getDatabaseName()));
        }

        return null;
    }
}
