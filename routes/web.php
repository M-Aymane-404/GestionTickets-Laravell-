<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\TicketController\ClientController;
use App\Http\Controllers\MessageController\clientMessageController;

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});





     Route::middleware(['auth', 'verified'])
    ->prefix('client')
    ->group(function () {
        Route::get('dashboard', [clientController::class, 'index'])->name('dashboard.client');
        Route::get('ticket/{ticket}', [clientController::class, 'ticketDetails'])->name('ticketDetails.client');
        Route::post('storeMessage/{ticket}', [clientMessageController::class, 'commenteStore'])->name('storeMessage');
       // Route::get('ticket/create', [clientController::class, 'create'])->name('createTicket.client');
       // Route::post('ticket/create', [clientController::class, 'store'])->name('ticketStore');
Route::get('create/ticket', [clientController::class, 'create'])->name('createTicket.client');
    Route::post('create/ticket', [clientController::class, 'store'])->name('ticketStore');




    });













Route::get('assistant/dashboard', function () {
    return view('dashboard.assistant');
})->middleware(['auth', 'verified'])->name('dashboard.assistant');
Route::get('admin/dashboard', function () {
    return view('dashboard.admin');
})->middleware(['auth', 'verified'])->name('dashboard.admin');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
