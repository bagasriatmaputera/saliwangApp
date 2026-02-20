<?php
use App\Livewire\Actions\Logout;
use App\Livewire\Admin\DashboardManager;
use App\Livewire\BusSeatPicker;
use Illuminate\Support\Facades\Route;
use Livewire\Volt\Volt;


Route::get('/', BusSeatPicker::class)->name('booking');

Volt::route('login', 'pages.auth.login')
    ->name('login')
    ->middleware('guest');

    
    
    Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('/dashboard', DashboardManager::class)->name('dashboard');
    Route::post('/logout', Logout::class)->name(name: 'logout');
    
    // Tempat admin input data/cek pesanan
    // Route::get('/admin/orders', OrderIndex::class)->name('admin.orders');
});

require __DIR__.'/auth.php';