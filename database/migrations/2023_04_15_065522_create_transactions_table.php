<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('transactions', function (Blueprint $collection) {
            $collection->id();
            $collection->foreignId('user_id')->constrained('users');
            $collection->foreignId('account_id')->constrained('accounts');
            $collection->decimal('amount', 15, 2);
            $collection->text('description')->nullable();
            $collection->enum('transaction_type', ['expense', 'income']);
            $collection->string('category');
            $collection->string('payment_method');
            $collection->date('date');
            $collection->timestamps();
        });
    }
    public function down(): void
    {
        Schema::dropIfExists('transactions');
    }
};
