<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TripAvailable extends Model
{
    protected $fillable = [
        'jadwal_trip',
        'rute'
    ];

    public function bookings(){
        return $this->hasMany(Booking::class);
    }
}
