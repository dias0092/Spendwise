<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('goals', function (Blueprint $collection) {
            $collection->id();
            $collection->foreignId('user_id')->constrained('users');
            $collection->string('name');
            $collection->decimal('target_amount', 15, 2);
            $collection->date('deadline');
            $collection->text('description')->nullable();
            $collection->decimal('initial_target_amount', 15, 2);
            $collection->string('color');
            $collection->string('icon');
            $collection->decimal('progress', 5, 2)->default(0);
            $collection->string('status')->default('active');
            $collection->timestamps();
        });
    }
    public function down(): void
    {
        Schema::dropIfExists('goals');
    }
};
