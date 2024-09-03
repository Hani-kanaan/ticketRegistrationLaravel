<?php

namespace App\Jobs;

use Carbon\Carbon;
use App\Models\Flight;
use App\Mail\FlightReminder;
use Illuminate\Bus\Queueable;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;

class SendFlightReminder implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     */
    public function __construct()
    {
        //
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        Log::info('Current Time: ' . Carbon::now());
        Log::info('24 Hours from Now: ' . Carbon::now()->addDay());
        Log::info('24 Hours and 1 Minute from Now: ' . Carbon::now()->addDay()->addMinute());
        $flights = Flight::where('departure_time', '>=', Carbon::now()->addDay())
            ->where('departure_time', '<', Carbon::now()->addDay()->addMinute())
            ->get();

        foreach ($flights as $flight) {
            foreach ($flight->passengers as $passenger) {
                Log::info('Flight found: ' . $flight->id . ', Departure Time: ' . $flight->departure_time);
                Mail::to($passenger->email)->send(new FlightReminder($flight, $passenger));
                Log::info("{$passenger->email} has received an email");
            }
        }

        Log::info('Scheduled task: Reminder emails sent successfully.');
    }
}
