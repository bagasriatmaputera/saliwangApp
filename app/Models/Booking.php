<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Booking extends Model
{
    protected $fillable = [
        'bus_id',
        'seat_id',
        'trip_id',
        'nama_pemesan',
        'no_hp',
        'tujuan',
        'titik_jemput',
        'status'
    ];

    /**
     * Relasi ke model Bus
     */
    public function bus(): BelongsTo
    {
        return $this->belongsTo(Bus::class);
    }

    /**
     * Relasi ke model Seat
     */
    public function seat(): BelongsTo
    {
        return $this->belongsTo(Seat::class, 'seat_id');
    }

    /**
     * Relasi ke model TripAvailable
     */
    public function trip(): BelongsTo
    {
        return $this->belongsTo(TripAvailable::class, 'trip_id');
    }
}
