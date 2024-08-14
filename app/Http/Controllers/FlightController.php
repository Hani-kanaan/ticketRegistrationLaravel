<?php

namespace App\Http\Controllers;

use App\Models\Flight;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Spatie\QueryBuilder\QueryBuilder;
use Spatie\QueryBuilder\AllowedFilter;

class FlightController extends Controller
{
    public function index(Request $request) {

        $query = QueryBuilder::for(Flight::class)
        // Filtering departure time greater than input departure time
        ->allowedFilters(AllowedFilter::callback('departure_time', function ($query, $value) {
            $query->where('departure_time', '>=', $value);
        }))
        // Sorting
        ->allowedSorts('departure_time')
        ->defaultSort('-departure_time')
        // Pagination
       ->paginate(50);
    
    return response()->json($query);
    }
}
