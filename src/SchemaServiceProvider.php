<?php

namespace Javaabu\Schema;

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Schema\Builder;
use Illuminate\Support\ServiceProvider;

class SchemaServiceProvider extends ServiceProvider
{
    /**
     * Register the builder macros
     */
    protected function registerBuilderMacros()
    {
        Builder::macro('getColumnComment', function (string $table, string $column) {
            /** @var $this Builder */
            $column_info = $this->getColumns($table);

            foreach ($column_info as $col) {
                if ($col['name'] == $column) {
                    return $col['comment'];
                }
            }

            return null;
        });

        Builder::macro('getTableComment', function (string $table) {
            /** @var $this Builder */
            $table_info = $this->getTables();

            foreach ($table_info as $info) {
                if ($info['name'] == $table) {
                    return $info['comment'];
                }
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
