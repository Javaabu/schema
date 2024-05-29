<?php

namespace Javaabu\Schema;

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Schema\Builder;
use Illuminate\Support\ServiceProvider;
use InvalidArgumentException;

class SchemaServiceProvider extends ServiceProvider
{
    /**
     * Register the builder macros
     */
    protected function registerBuilderMacros()
    {
        if (! method_exists(Builder::class, 'macro')) {
            return;
        }

        Builder::macro('getColumnComment', function (string $table, string $column, bool $fail_on_missing = false) {
            /** @var $this Builder */
            $column_info = $this->getColumns($table);

            foreach ($column_info as $col) {
                if ($col['name'] == $column) {
                    return $col['comment'];
                }
            }

            if ($fail_on_missing) {
                throw new InvalidArgumentException(sprintf("No such column [%s] in the table [%s].", $column, $table));
            }

            return null;
        });

        Builder::macro('getTableComment', function (string $table, bool $fail_on_missing = false) {
            /** @var $this Builder */
            $table_info = $this->getTables();

            foreach ($table_info as $info) {
                if ($info['name'] == $table) {
                    return $info['comment'];
                }
            }

            if ($fail_on_missing) {
                throw new InvalidArgumentException(sprintf("No such table [%s] in the database [%s].", $table, $builder->getConnection()->getDatabaseName()));
            }

            return null;

        });
    }

    /**
     * Register the blue print macros
     */
    protected function registerBlueprintMacros()
    {
        Blueprint::macro('nativeEnum', function (string $column, string $enum_class, ?int $length = null) {
            /** @var $this Blueprint */
            return $this->string($column, $length)->comment('enum:' . $enum_class);
        });
    }

    /**
     * Bootstrap the application services.
     */
    public function boot()
    {
        $this->registerBuilderMacros();

        $this->registerBlueprintMacros();
    }

    /**
     * Register the application services.
     */
    public function register()
    {

    }
}
