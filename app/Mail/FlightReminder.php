<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;
use App\Models\Flight;
use App\Models\Passenger;

class FlightReminder extends Mailable
{
    use Queueable, SerializesModels;

    public $flight;
    public $passenger;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(Flight $flight, Passenger $passenger)
    {
        $this->flight = $flight;
        $this->passenger = $passenger;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->subject('Flight Reminder')
            ->view('flight_reminder')
            ->with([
                'flight' => $this->flight,
                'passenger' => $this->passenger,
            ]);
    }
}
