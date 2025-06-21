<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\TicketController\ClientController;
use App\Http\Controllers\MessageController\clientMessageController;
use App\Http\Controllers\TicketController\assistantController;
use App\Http\Controllers\MessageController\assistantMessageController;

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});




//client routes
     Route::middleware(['auth', 'verified'])
    ->prefix('client')
    ->group(function () {
        Route::get('dashboard', [clientController::class, 'index'])->name('dashboard.client');
        Route::get('ticket/{ticket}', [clientController::class, 'ticketDetails'])->name('ticketDetails.client');
        Route::post('storeMessage/{ticket}', [clientMessageController::class, 'commenteStore'])->name('storeMessage');
        Route::get('create/ticket', [clientController::class, 'create'])->name('createTicket.client');
        Route::post('create/ticket', [clientController::class, 'store'])->name('ticketStore');




    });




// assistant routes

    Route::middleware(['auth', 'verified'])
    ->prefix('assistant')
    ->group(function () {
        Route::get('dashboard', [assistantController::class, 'index'])->name('dashboard.assistant');
        Route::get('ticket/{ticket}', [assistantController::class, 'ticketDetails'])->name('ticketDetails.assistant');
        Route::post('storeMessage/{ticket}', [assistantMessageController::class, 'commenteStore'])->name('storeMessage');
        Route::patch('updateEtat/{ticket}', [assistantController::class, 'updateEtat'])->name('updateEtat.assistant');




    });











Route::get('admin/dashboard', function () {
    return view('dashboard.admin');
})->middleware(['auth', 'verified'])->name('dashboard.admin');




Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
