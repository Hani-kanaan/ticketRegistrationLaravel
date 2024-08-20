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
            ->allowedFilters('number')
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
        return response('flight deleted');
    }

    public function store(Request $req)
    {

        $validatedData = $req->validate([
            'number' => 'required|integer|unique:flights',
            'departure_city' => 'required|string',
            'arrival_city' => 'required|string',
            'departure_time' => 'required|date',
            'arrival_time' => 'required|date',
        ]);
        $flight = new Flight;
        $flight = Flight::create($validatedData);
        return response('flight created');
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
