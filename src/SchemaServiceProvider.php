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
        if (! method_exists(Builder::class, 'macro')) {
            return;
        }

        Builder::macro('getColumnComment', function (string $table, string $column, bool $fail_on_missing = false) {
            /** @var $this Builder */
            return BuilderMacros::getColumnComment($this, $table, $column, $fail_on_missing);
        });

        Builder::macro('getTableComment', function (string $table, bool $fail_on_missing = false) {
            /** @var $this Builder */
            return BuilderMacros::getTableComment($this, $table, $fail_on_missing);

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
