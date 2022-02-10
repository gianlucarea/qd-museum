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
Route::get('ticketValidator/chooseMuseum', [App\Http\Controllers\TicketController::class, 'ticketValidator_choose_museum'])->name('ticketValidator_choose_museum');
Route::get('ticketValidator/chooseTag', [App\Http\Controllers\TicketController::class, 'ticketValidator_choose_tag'])->name('ticketValidator_choose_tag');
Route::get('ticketValidator/QrCodeReader', [App\Http\Controllers\TicketController::class, 'ticketValidator_qrCodeReader'])->name('ticketValidator_qrCodeReader');
Route::get('tickets', [App\Http\Controllers\TicketController::class, 'tickets'])->name('tickets');
Route::get('ticketQrCode/{ticket_id}', [App\Http\Controllers\TicketController::class, 'ticketQrCode'])->name('ticketQrcode');
Route::get('validation/{ticket_id}/{user_id}', [App\Http\Controllers\TicketController::class, 'validation'])->name('validation');
Route::get('requestRefund/{ticket_id}', [App\Http\Controllers\TicketController::class, 'requestRefund'])->name('requestRefund');
Route::get('validation/{museum_id}/{tag_id}/{ticket_id}/{user_id}', [App\Http\Controllers\TicketController::class, 'validation'])->name('validation');
Route::get('tagDecoupling', [App\Http\Controllers\Museum_TagController::class, 'tagDecoupling'])->name('tagDecoupling');
Route::post('/tagDecoupling/outcome', [App\Http\Controllers\Museum_TagController::class, 'tagDecoupling_effective'])->name('tagDecoupling_effective');

Route::get('/addArtwork', function (){return view('addArtwork');})->name('addArtwork');
Route::post('/storeArtwork', [App\Http\Controllers\ArtworkController::class, 'store'])->name('storeArtwork');
Route::get('/museum/artworks/{id}', [App\Http\Controllers\ArtworkController::class, 'show'])->name('showArtworks');
Route::get('/chooseMuseumForRemoveArtwork', [App\Http\Controllers\ArtworkController::class, 'chooseMuseumForRemoveArtwork'])->name('chooseMuseumForRemoveArtwork');
Route::get('/museum/showArtworks', [App\Http\Controllers\ArtworkController::class, 'getArtworksByMuseum'])->name('getArtworksByMuseum');
Route::get('/museum/artwork/{id}', [App\Http\Controllers\ArtworkController::class, 'getArtwork'])->name('getArtworks');
Route::get('/museum/artworks/delete/{id}', [App\Http\Controllers\ArtworkController::class, 'delete'])->name('deleteArtwork');
Route::get('/museum/slots/{id}', [App\Http\Controllers\Time_Slot_VisitController::class, 'show'])->name('showMuseumTimeSlot');
Route::get('/museum/slot/delete/{id}',[App\Http\Controllers\Time_Slot_VisitController::class, 'delete'])->name('deleteTimeSlot');
Route::get('/museum/{id}/addTimeslot',function(){return view('addTimeSlot');})->name('addTimeSlot');
Route::post('/museum/storeTimeslot', [App\Http\Controllers\Time_Slot_VisitController::class, 'store'])->name('storeTimeslot');

