<?php
use App\Livewire\Admin\DashboardManager;
use App\Livewire\BusSeatPicker;
use Illuminate\Support\Facades\Route;


Route::get('/', BusSeatPicker::class)->name('booking');

Route::get('/login', BusSeatPicker::class)->name('login');

Route::get('/admin-dashboard', DashboardManager::class)->name('adminDashboard');


Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');
    
    // Tempat admin input data/cek pesanan
    // Route::get('/admin/orders', OrderIndex::class)->name('admin.orders');
});

require __DIR__.'/auth.php';