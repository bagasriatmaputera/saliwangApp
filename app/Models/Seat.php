<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Seat extends Model
{
    use HasFactory;
    protected $fillable = [
        'bus_id'
    ];

    public function buses(){
        $this->belongsTo(Bus::class);
    }
}
