<?php

namespace App\Http\Controllers;

use App\Models\Flight;
use Illuminate\Http\Request;
use Spatie\QueryBuilder\QueryBuilder;
use Spatie\QueryBuilder\AllowedFilter;

class FlightController extends Controller
{
    public function index()
    {

        $flights = QueryBuilder::for(Flight::class)
            ->allowedFilters(AllowedFilter::callback('number', function ($flights, $value) {
                $flights->where('number', '>=', $value);
            }))
            ->allowedSorts('number')
            ->defaultSort('-number')
            ->paginate(50);
        return response()->json($flights);
    }

    //read a single flight :
    public function show(Flight $flight)
    {
        return response()->json($flight);
    }

    public function destroy(Flight $flight)
    {
        $flight->delete();
    }

    public function create(Request $req)
    {
        $flight = new Flight;
        $flight->number = $req->number;
        $flight->departure_city = $req->departure_city;
        $flight->arrival_city = $req->arrival_city;
        $flight->departure_time = $req->departure_time;
        $flight->arrival_time = $req->arrival_time;

        $flight->save();
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
