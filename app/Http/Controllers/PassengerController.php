<?php

namespace App\Http\Controllers;

use App\Models\Flight;
use Illuminate\Http\Request;

class PassengerController extends Controller
{
    public function index($flightId){
        $flight = Flight::find($flightId);
        $passengers = $flight->passenger;
        return response()->json($passengers);
    }
    
}
