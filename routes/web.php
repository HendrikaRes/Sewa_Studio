<?php

use Illuminate\Support\Facades\Route;
use App\Http\Middleware\RoleMiddleware;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\StudioController;
use App\Http\Controllers\BookingController;


// Home
Route::get('/', function () {
    return view('home');
});

Route::get('/login', function () {
    return view('auth.login');
})->name('login');

Route::get('/register', function () {
    return view('auth.register');
});

Route::post('/register', [AuthController::class, 'register'])->name('register');
Route::post('/login', [AuthController::class, 'login'])->name('login');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');


Route::middleware([RoleMiddleware::class])->group(function () {
    
Route::get('/dashboard', [BookingController::class, 'showDashboard'])->name('admin.dashboard');

    Route::get('/studio', [StudioController::class, 'tampiladmin']);
    Route::get('/tambahstudio', [StudioController::class, 'create']);
    Route::post('/tambahstudio', [StudioController::class, 'store']);
    Route::get('/editstudio/{id}', [StudioController::class, 'edit']);
    Route::post('/editstudio/{id}', [StudioController::class, 'update']);
    Route::delete('/hapusstudio/{id}', [StudioController::class, 'destroy']);
    
});

Route::get('/studios', [StudioController::class, 'index'])->name('studios.index');
Route::post('/studios/{id}/book', [StudioController::class, 'book'])->name('studios.book');


Route::get('/bookings', [BookingController::class, 'index'])->name('bookings.index');
Route::post('/bookings/{id}/pay', [BookingController::class, 'pay'])->name('bookings.pay');



