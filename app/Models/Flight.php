<?php

namespace App\Models;

use OwenIt\Auditing\Contracts\Auditable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Passenger;

class Flight extends Model implements Auditable
{
    use \OwenIt\Auditing\Auditable;
    use HasFactory;
    protected $guarded = [];

    protected $auditInclude = [
        'number', 'departure_time', 'arrival_time', 'status',  'updated_at',
    ];

    protected $auditExclude = [
        'created_at',
    ];
    public function passengers()
    {
        return $this->belongsToMany(Passenger::class, 'flight_passenger');
    }
}
