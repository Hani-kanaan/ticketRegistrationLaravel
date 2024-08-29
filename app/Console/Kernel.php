<?php

namespace App\Console;

use Carbon\Carbon;
use App\Models\Flight;
use App\Mail\FlightReminder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;
use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;

class Kernel extends ConsoleKernel
{
    /**
     * Define the application's command schedule.
     */
    protected function schedule(Schedule $schedule): void
    {
      
     $schedule->call(function () {
        Log::info('Current Time: ' . Carbon::now());
        Log::info('24 Hours from Now: ' . Carbon::now()->addDay());
        Log::info('24 Hours and 1 Minute from Now: ' . Carbon::now()->addDay()->addMinute());
            $flights = Flight::where('departure_time', '>=', Carbon::now()->addDay())
                             ->where('departure_time', '<', Carbon::now()->addDay()->addMinute())
                             ->get();
    
            foreach ($flights as $flight) {
                Log::info('Flight found: ' . $flight->id . ', Departure Time: ' . $flight->departure_time);

                foreach ($flight->passengers as $passenger) {
                    Mail::to($passenger->email)->send(new FlightReminder($flight, $passenger));
                    Log::info($passenger->email . " has received an email");
                }
            }
         })->everyMinute();
    
    }

    /**
     * Register the commands for the application.
     */
    protected function commands(): void
    {
        $this->load(__DIR__.'/Commands');

        require base_path('routes/console.php');
    }
    
}
