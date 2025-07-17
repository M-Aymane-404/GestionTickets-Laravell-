<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\TicketController\ClientController;
use App\Http\Controllers\MessageController\clientMessageController;
use App\Http\Controllers\TicketController\assistantController;
use App\Http\Controllers\MessageController\assistantMessageController;
use App\Http\Controllers\TicketController\adminController;
use App\Http\Controllers\MessageController\adminMessageController;



use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
})->name('welcome');

Route::get('create/admin',[adminController::class, 'addFirstAdmin'])->name('addFirstAdmin');
Route::post('store', [adminController::class, 'storeFirstAdmin'])->name('storeFirstAdmin');
// auth crud

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';




//client routes
     Route::middleware(['auth', 'verified'])
    ->prefix('client')
    ->group(function () {
        Route::get('dashboard', [clientController::class, 'index'])->name('dashboard.client');
        Route::get('ticket/{ticket}', [clientController::class, 'ticketDetails'])->name('ticketDetails.client');
        Route::post('storeMessage/{ticket}', [clientMessageController::class, 'commenteStores'])->name('storeMessages');
        Route::get('create/ticket', [clientController::class, 'create'])->name('createTicket.client');
        Route::post('create/ticket', [clientController::class, 'store'])->name('ticketStore');

    });




// assistant routes

    Route::middleware(['auth', 'verified'])
    ->prefix('assistant')
    ->group(function () {
        Route::get('dashboard', [assistantController::class, 'index'])->name('dashboard.assistant');
        Route::get('ticket/{ticket}', [assistantController::class, 'ticketDetails'])->name('ticketDetails.assistant');
        Route::post('storeMessage/{ticket}', [assistantMessageController::class, 'commenteStoreAssistant'])->name('storeMessageAssistant');
        Route::patch('updateEtat/{ticket}', [assistantController::class, 'updateEtats'])->name('updateEtats.assistant');
        Route::get('statistic', [assistantController::class, 'statistic'])->name('statistic.assistant');





    });


// admin routes

        Route::middleware(['auth', 'verified'])
    ->prefix('admin')
    ->group(function () {
        Route::get('dashboard', [adminController::class, 'index'])->name('dashboard.admin');
        Route::get('ticket/{ticket}', [adminController::class, 'ticketDetails'])->name('ticketDetails.admin');
        Route::post('storeMessage/{ticket}', [adminMessageController::class, 'commenteStore'])->name('storeMessage');
        Route::patch('updateEtat/{ticket}', [adminController::class, 'updateEtat'])->name('updateEtat.admin');
        Route::get('ticket/{ticket}/edit',[adminController::class, 'editTicket'])->name('editTicket.admin');
        Route::patch('ticket/{ticket}', [adminController::class, 'updateTicket'])->name('updateTicket.admin');
        Route::delete('/ticket/{ticket}',[adminController::class,'destroy'])->name('ticket.delete');
        Route::get('create/user',[adminController::class, 'addUser'])->name('addUser.admin');
        Route::post('store/user', [adminController::class, 'storeUser'])->name('storeUser.admin');
        Route::get('users',[adminController::class, 'assistantTicket'])->name('listerUsers.admin');
        Route::delete('user/{user}',[adminController::class,'destroyUser'])->name('user.delete');
        Route::get('statistic', [adminController::class, 'statistcs'])->name('statistic.admin');












    });




