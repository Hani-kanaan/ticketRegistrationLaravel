<?php

namespace App\Http\Controllers;

use App\Models\Flight;
use App\Models\Passenger;
use Symfony\Component\HttpFoundation\Request;

class PassengerController extends Controller
{

    public function index(Flight $flight)
    {

        $passengers = $flight->passengers;
        return response()->json($passengers);
    }

    public function show(Passenger $passengers)
    {
        return response()->json($passengers);
    }

    public function destroy(Passenger $passengers)
    {
        $passengers->delete();
    }

    public function create(Request $req)
    {
        $passenger = new Passenger;
        $passenger->first_name = $req->first_name;
        $passenger->last_name = $req->last_name;
        $passenger->email =   $req->email;
        $passenger->password = $req->password;
        $passenger->date_of_birth = $req->date_of_birth; 
        $passenger->save();
        return redirect()->back();
    }

    public function update(Request $request, Flight $flight)
    {
        $validatedData = $request->validate([
            'number' => 'required',
            'departure_city' => 'required',
            'arrival_city' => 'required',
            'departure_time' => 'required',
            'arrival_time' => 'required',
        ]);
        $flight->update($validatedData);
        return response()->json($flight);
    }
}
