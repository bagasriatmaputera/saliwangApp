<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Booking extends Model
{
    protected $fillable = [
        'nama_pemesan',
        'no_hp',
        'tujuan',
        'titik_jemput',
        'status'
    ];
}
