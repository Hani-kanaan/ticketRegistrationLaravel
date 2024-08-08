<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Passenger;

class Flight extends Model
{
    use HasFactory;
    protected $fillable = ['number',
    'departure_city', 'arrival_city', 'departure_time',
    'arrival_time'];

    public function passenger(){
        return $this->belongsToMany(Passenger::class, 'flight_passenger');

    }
}
