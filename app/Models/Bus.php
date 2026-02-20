<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Bus extends Model
{
    use HasFactory;
    protected $fillable = [
        'nama_bus',
        'owner_phone'
    ];

    public function seats(){
        return $this->hasMany(Seat::class,'bus_id');
    }
    public function bookings(){
        return $this->hasMany(Booking::class,'bus_id');
    }
}
