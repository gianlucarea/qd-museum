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
Route::get('/feedbackMuseumsAndArtworks', [App\Http\Controllers\UserController::class, 'feedbackMuseumsAndArtworks'])->name('feedbackMuseumsAndArtworks');
Route::get('/feedbackMuseumsAndArtworks/ChosenMuseum', [App\Http\Controllers\UserController::class, 'feedbackMuseumsAndArtworksChosenMuseum'])->name('feedbackMuseumsAndArtworksChosenMuseum');
Route::get('/feedbackMuseumsAndArtworks/ChosenMuseum/feedbackMuseumPage/{museum_id}', [App\Http\Controllers\UserController::class, 'feedbackMuseumPage'])->name('feedbackMuseumPage');
Route::post('/feedbackMuseumsAndArtworks/ChosenMuseum/feedbackMuseum', [App\Http\Controllers\UserController::class, 'feedbackMuseum'])->name('feedbackMuseum');
Route::get('/feedbackMuseumsAndArtworks/ChosenMuseum/feedbackArtworkPage/{museum_id}/{artwork_id}', [App\Http\Controllers\UserController::class, 'feedbackArtworkPage'])->name('feedbackArtworkPage');
Route::post('/feedbackMuseumsAndArtworks/ChosenMuseum/feedbackArtwork', [App\Http\Controllers\UserController::class, 'feedbackArtwork'])->name('feedbackArtwork');
Route::get('socialArea', [App\Http\Controllers\UserController::class, 'showSocialArea'])->name('socialArea');
Route::get('socialArea/museum/{museum_id}', [App\Http\Controllers\UserController::class, 'showSocialAreaByMuseum'])->name('socialAreaMuseum');

Route::get('/addArtwork/{museum_id}', [App\Http\Controllers\ArtworkController::class, 'showAddArtworkPage'])->name('addArtwork');
Route::post('/storeArtwork', [App\Http\Controllers\ArtworkController::class, 'store'])->name('storeArtwork');
Route::get('/museum/artworks/{id}', [App\Http\Controllers\ArtworkController::class, 'show'])->name('showArtworks');
Route::get('/chooseMuseumForArtworkAndManagement', [App\Http\Controllers\ArtworkController::class, 'chooseMuseumForArtworkAndManagement'])->name('chooseMuseumForArtworkAndManagement');
Route::get('/museum/showArtworks', [App\Http\Controllers\ArtworkController::class, 'getArtworksByMuseum'])->name('getArtworksByMuseum');
Route::get('/museum/showArtworks/{museum_id}', [App\Http\Controllers\ArtworkController::class, 'getArtworksByMuseum2'])->name('getArtworksByMuseum2');
Route::get('/museum/update/artwork/{id}', [App\Http\Controllers\ArtworkController::class, 'getArtworkToUpdate'])->name('getArtworkToUpdate');
Route::put('/museum/update/artwork/by/{id}', [App\Http\Controllers\ArtworkController::class, 'update'])->name('artworkUpdate');
Route::get('/museum/artwork/{id}', [App\Http\Controllers\ArtworkController::class, 'getArtwork'])->name('getArtworks');
Route::get('/museum/artworks/delete/{id}', [App\Http\Controllers\ArtworkController::class, 'delete'])->name('deleteArtwork');
Route::get('/museum/slots/{id}', [App\Http\Controllers\Time_Slot_VisitController::class, 'show'])->name('showMuseumTimeSlot');
Route::get('/museum/slot/delete/{id}',[App\Http\Controllers\Time_Slot_VisitController::class, 'delete'])->name('deleteTimeSlot');
Route::get('/museum/addTimeslot/{museum_id}', [App\Http\Controllers\Time_Slot_VisitController::class, 'showAddTimeSlotPage'])->name('showAddTimeSlotPage');
Route::post('/museum/storeTimeslot', [App\Http\Controllers\Time_Slot_VisitController::class, 'store'])->name('storeTimeslot');
Route::get('/timeslot/chooseMuseum', [App\Http\Controllers\Time_Slot_VisitController::class, 'chooseMuseumForRemoveTimeSlot'])->name('timeslot_choose_museum');
Route::get('/timeslot/chooseMuseumToShow', [App\Http\Controllers\Time_Slot_VisitController::class, 'chooseMuseumToShow'])->name('chooseMuseumToShow');
Route::get('/museum/showSlots', [App\Http\Controllers\Time_Slot_VisitController::class, 'show_time_slots_by_museum'])->name('show_time_slots_by_museum');
Route::get('/museum/showSlots/{museum_id}', [App\Http\Controllers\Time_Slot_VisitController::class, 'show_time_slots_by_museum2'])->name('show_time_slots_by_museum2');
Route::get('/museum/update/slot/{id}', [App\Http\Controllers\Time_Slot_VisitController::class, 'getSlotToUpdate'])->name('getSlotToUpdate');
Route::put('/museum/update/slot/by/{id}', [App\Http\Controllers\Time_Slot_VisitController::class, 'update'])->name('slotUpdate');
Route::post('/museum/reg_visit', [App\Http\Controllers\UserController::class, 'reg_visit_time'])->name('reg_visit_time');
Route::post('/museum/reg_art_visit', [App\Http\Controllers\UserController::class, 'reg_art_visit'])->name('reg_art_visit');

Route::get('/user/profile', [App\Http\Controllers\UserController::class, 'getUserInfo'])->name('UserProfile');
Route::get('/user/visit', [App\Http\Controllers\UserController::class, 'userTracking'])->name('userVisit');
Route::post('/user/visit/update', [App\Http\COntrollers\UserController::class, 'userTrackingUpdate'])->name('userVisitUpdate');
Route::get('/chooseMuseumForTracking', [App\Http\Controllers\UserController::class, 'getWorkingMuseum'])->name('getWorkingMuseum');
Route::get('/operator/tracking', [App\Http\Controllers\UserController::class, 'operatorTracking'])->name('operatorTracking');
Route::post('/operator/tracking/update', [App\Http\Controllers\UserController::class, 'operatorTrackingUpdate'])->name('operatorTrackingUpdate');
Route::post('/operator/tracking/art', [App\Http\Controllers\ArtworkController::class, 'Ajax_getArtworkByMuseum'])->name('Ajax_getArtworkByMuseum');