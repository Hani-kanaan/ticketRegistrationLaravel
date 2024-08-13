<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('passengers', function (Blueprint $table) {
            $table->id();
            $table->string('first_name');
            $table->string('last_name');
            $table->string('email')->unique();
            $table->string('password');
            $table->date('dob');
            $table->dateTime('passport_expiry_date');
            $table->timestamps();  
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('passengers');
    }
};
