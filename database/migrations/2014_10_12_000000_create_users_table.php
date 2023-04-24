<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('users', function (Blueprint $collection) {
            $collection->id();
            $collection->string('name');
            $collection->string('email')->unique();
            $collection->string('password');
            $collection->rememberToken();
            $collection->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('users');
    }
};
