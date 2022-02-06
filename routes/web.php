<?php

use Illuminate\Support\Facades\Route;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('/museum/', [App\Http\Controllers\MuseumController::class, 'addMuseum'])->name('addMuseum');
Route::get('/bookingTicket', [App\Http\Controllers\TicketController::class, 'show'])->name('bookingTicket');
Route::get('/bookingTicket/seeAvailability', [App\Http\Controllers\TicketController::class, 'seeAvailability'])->name('seeAvailability');
Route::post('/bookingTicket/ticketConfirmation', [App\Http\Controllers\TicketController::class, 'ticketConfirmation'])->name('ticketConfirmation');
Route::get('ticketValidator', [App\Http\Controllers\TicketController::class, 'ticketValidator'])->name('ticketValidator');
Route::get('tickets', [App\Http\Controllers\TicketController::class, 'tickets'])->name('tickets');
Route::get('ticketQrCode/{ticket_id}', [App\Http\Controllers\TicketController::class, 'ticketQrCode'])->name('ticketQrcode');
Route::get('validation/{ticket_id}/{user_id}', [App\Http\Controllers\TicketController::class, 'validation'])->name('validation');
