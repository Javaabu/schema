<?php

namespace Javaabu\Schema;

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\ServiceProvider;

class SchemaServiceProvider extends ServiceProvider
{
    /**
     * Register the schema macros
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
        $this->registerBlueprintMacros();
    }

    /**
     * Register the application services.
     */
    public function register()
    {

    }
}
