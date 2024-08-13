<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\Models\Flight;
use App\Models\Passenger;

class FlightPassengerSeeder extends Seeder
{
    public function run(): void
    {
        // Get all flights and passengers
        $flights = Flight::all()->pluck('id')->toArray();
        $passengers = Passenger::all()->pluck('id')->toArray();

        // Ensure that there are flights and passengers to associate
        if (empty($flights) || empty($passengers)) {
            return;
        }

        // Seed the flight_passenger table
        for ($i = 0; $i < 100; $i++) { // Seed 100 records
            DB::table('flight_passenger')->insert([
                'flight_id' => $flights[array_rand($flights)],
                'passenger_id' => $passengers[array_rand($passengers)],
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}
