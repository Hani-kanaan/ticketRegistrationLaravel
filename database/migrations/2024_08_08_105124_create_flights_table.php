<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('flights', function (Blueprint $table) {
            $table->id();
            $table->integer('number')->unique();
            $table->string('departure_city');
            $table->string('arrival_city');
            $table->dateTime('departure_time');
            $table->dateTime('arrival_time');
            $table->timestamps();

        });
         Schema::table('users', function (Blueprint $table) {
            $table->softDeletes(); 
        });
        Schema::create('flight_passenger', function (Blueprint $table) {
            $table->id(); // unsignedBigInteger
            $table->unsignedBigInteger('flight_id'); // Match the primary key type
            $table->unsignedBigInteger('passenger_id'); // Match the primary key type
            $table->timestamps();

            // Adding foreign key constraints
            $table->foreign('flight_id')->references('id')->on('flights')->onDelete('cascade');
            $table->foreign('passenger_id')->references('id')->on('passengers')->onDelete('cascade');

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('flight_passenger');

        Schema::dropIfExists('flights');
    
  
    }
};
