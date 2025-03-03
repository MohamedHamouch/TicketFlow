<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ClientTicketController;
use App\Http\Controllers\AdminTicketController;
use App\Http\Controllers\DeveloperTicketController;


Route::get('/', function () {
    return view('home');
});

Route::get('/home', function () {
    return view('home');
})->name('home');


// Route::get('/dashboard', function () {
//     return view('dashboard');
// })->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::middleware(['auth', 'role:client'])->prefix('client')->name('client.')->group(function () {
    Route::resource('tickets', ClientTicketController::class)->except(['show']);
});

Route::middleware(['auth', 'role:admin'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/tickets', [AdminTicketController::class, 'index'])->name('tickets.index');
    Route::post('/tickets/{ticket}/assign', [AdminTicketController::class, 'assignDeveloper'])->name('tickets.assign');
});

Route::middleware(['auth', 'role:developer'])->prefix('developer')->name('developer.')->group(function () {
    Route::get('/tickets', [DeveloperTicketController::class, 'index'])->name('tickets.index');
    Route::patch('/tickets/{ticket}/close', [DeveloperTicketController::class, 'closeTicket'])->name('tickets.close');
});

require __DIR__.'/auth.php';
