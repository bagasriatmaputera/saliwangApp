<?php

namespace App\Http\Controllers;

use App\Models\Bus;
use Illuminate\Http\Request;

class BusController extends Controller
{
    public function home()
{
    $bus = Bus::with('seats')->first();

    return view('home', [
        'bus' => $bus,
        'seats' => $bus->seats
    ]);
}

}
