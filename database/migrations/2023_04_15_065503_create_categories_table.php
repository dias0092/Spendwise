<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('categories', function (Blueprint $collection) {
            $collection->id();
            $collection->string('category_name');
            $collection->foreignId('parent_id')->nullable()->constrained('categories');
            $collection->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('categories');
    }
};
