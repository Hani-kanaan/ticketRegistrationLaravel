<?php

namespace App\Models;

use App\Models\Flight;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Passenger extends Model
{
    use HasFactory;

    protected $guarded = [];

    public  function flight(){
        return $this->belongsToMany(Flight::class , 'flight_passenger');
    }
}
