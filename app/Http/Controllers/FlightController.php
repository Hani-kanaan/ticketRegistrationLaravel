<?php

namespace App\Http\Controllers;

use App\Models\Flight;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class FlightController extends Controller
{
    public function getFlightsAPI(Request $request) {

        $query = DB::table('flights');
    //filtering departure time greater than input departure time
    if($request->has('departure_time')){   
    $departure_time = $request->query('departure_time');
    $query->where('departure_time', '>=', $departure_time);
    }
   
    //sorting:
    if ($request->has('sort_by')) {
    $sortOrder = $request->query('sort_by', 'desc');
    $query = $query->orderBy('departure_time',$sortOrder);
    }
    //pagination: 
    $query = $query->paginate(10);
    return response()->json($query);    
    }

public function getPassengersByFlightAPI($flightId){
    $flight = Flight::find($flightId);
    $passengers = $flight->passenger;
    return response()->json($passengers);
}

}
