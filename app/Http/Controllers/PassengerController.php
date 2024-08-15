<?php

namespace App\Http\Controllers;

use App\Models\Flight;
use Illuminate\Http\Request;

class PassengerController extends Controller
{

    public function index(Flight $flight)
    {
         
        $passengers = $flight->passengers;
        return response()->json($passengers);
    }
}
