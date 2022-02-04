<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Ticket;

class TicketController extends Controller
{
    /**
     * Show page for booking Tickets .
     *
     * @return \Illuminate\View\View
     */
    public function show()
    {
        return view('booking');
    }
    public function seeAvailability()
    {
        // make the check of validity of passed data (understand how they are exactly passed)
        // and return the view with this passed data plus the statistical data of tickets bought for that date.
        return view('seeAvailability');
    }
}