<?php

namespace App\Models;

use App\Models\Flight;
use Illuminate\Http\Request;
use Intervention\Image\Facades\Image;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Symfony\Component\HttpFoundation\File\UploadedFile;

class Passenger extends Model
{
    use HasFactory, Notifiable;

    protected $guarded = [];

    public  function flight()
    {
        return $this->belongsToMany(Flight::class, 'flight_passenger');
    }
}
