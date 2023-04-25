<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('wishlists', function (Blueprint $collection) {
            $collection->id();
            $collection->foreignId('user_id')->constrained('users');
            $collection->string('wish_name');
            $collection->decimal('target_amount', 15, 2);
            $collection->string('description');
            $collection->decimal('initial_target_amount', 15, 2);
            $collection->string('color');
            $collection->string('icon');
            $collection->timestamps();
        });
    }
    public function down(): void
    {
        Schema::dropIfExists('wishlists');
    }
};
