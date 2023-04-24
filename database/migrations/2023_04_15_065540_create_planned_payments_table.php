<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('planned_payments', function (Blueprint $collection) {
            $collection->id();
            $collection->foreignId('user_id')->constrained('users');
            $collection->foreignId('account_id')->constrained('accounts');
            $collection->decimal('amount', 15, 2);
            $collection->timestamp('timestamp');
            $collection->text('description')->nullable();
            $collection->timestamps();
        });
    }
    public function down(): void
    {
        Schema::dropIfExists('planned_payments');
    }
};
