<?php

use App\Http\Controllers\BusController;
use Illuminate\Support\Facades\Route;

// Route::get('/', function () {
//     return view('welcome');
// });

Route::get('/', [BusController::class, 'home'])->name('home');
