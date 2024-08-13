<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Database\Seeders\PassengerSeeder;

class DatabaseSeeder extends Seeder
{
    
    public function run(): void
    {
      $this->call(FlightSeeder::class);
      $this->call(PassengerSeeder::class);
      $this->call(UserSeeder::class);

    }
}
