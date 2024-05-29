---
title: Introduction
sidebar_position: 1.0
---

# Schema


[Schema](https://github.com/Javaabu/schema) Extends the Laravel database schema with convenience methods used by javaabu/generators.


```php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use App\Enums\CityStatus;

return new class () extends Migration {
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cities', function (Blueprint $table) {
            $table->id();
            $table->nativeEnum('status', CityStatus::class)->index();
            $table->timestamps();
        });
    }
    
    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('cities');
    }
};
```
