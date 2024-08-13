<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Passenger;

class Flight extends Model
{
    use HasFactory;
    protected $guarded = [];

    public function passenger(){
        return $this->belongsToMany(Passenger::class, 'flight_passenger');

    }
}
