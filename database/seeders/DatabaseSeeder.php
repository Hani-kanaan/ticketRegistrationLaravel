<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Database\Seeders\PassengerSeeder;

class DatabaseSeeder extends Seeder
{
    
    public function run(): void
    {
        // \App\Models\User::factory(10)->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);
      //  $this->call(FlightSeeder::class);
        $this->call(PassengerSeeder::class);


    }
}
