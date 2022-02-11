<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Ticket;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Symfony\Component\Console\Input\Input;
use Illuminate\Support\Str;
use Auth;

class TicketController extends Controller
{
    /**
     * Show first page for booking Tickets .
     *
     * @return \Illuminate\View\View
     */
    public function show()
    {
        $museums = DB::table('museums')->get();
        return view('booking')->with(['museums' => $museums]);
    }

    /**
     * Show page for buy Tickets after see the availability.
     *
     * @return \Illuminate\View\View
     */
    public function seeAvailability(Request $request)
    {
        // make the check of validity of passed data (understand how they are exactly passed)
        // and return the view with this passed data plus the statistical data of tickets bought for that date.
        if ($request->museum == null or $request->visitDate == null) {
            $museums = DB::table('museums')->get();
            $error = 'please choose both the museum and the date in which the visit is intended (of course set a date which is not in the past)';
            return view('booking')
                ->with(['museums' => $museums])
                ->with(['error' => $error]);
        } else {
            $date = $request->visitDate;
            if (Carbon::now()->startOfDay()->gt($date)) {
                $museums = DB::table('museums')->get();
                $error = 'please choose both the museum and the date in which the visit is intended (of course set a date which is not in the past)';
                return view('booking')
                    ->with(['museums' => $museums])
                    ->with(['error' => $error]);
            } else {
                $tickets_already_bought = DB::table('tickets')->where('visit_date', '=', $date)->where('museum_id', '=', $request->museum)->count();
                if ($tickets_already_bought > 500) {
                    $museums = DB::table('museums')->get();
                    $error = 'in the selected date the available tickets are already sold';
                    return view('booking')
                        ->with(['museums' => $museums])
                        ->with(['error' => $error]);
                } else {
                    $museum = DB::table('museums')->where('id', '=', $request->museum)->get();
                    $time_slots = DB::table('time_slots_visit')->where('museum_id', '=', $request->museum)->get();
                    $time_slot_statistic_collection = collect([]);
                    foreach($time_slots as $time_slot) {
                        $time_slot_statistic_collection->put($time_slot->id, DB::table('tickets')->where('museum_id', '=', $request->museum)->where('visit_date', '=', $request->visitDate)->where('time_slot_number', '=', $time_slot->slot_number)->count());
                    }
                    return view('seeAvailability')
                        ->with(['museums' => $museum])
                        ->with(['visit_date' => $date])
                        ->with(['time_slots' => $time_slots])
                        ->with(['time_slot_statistic_collection' => $time_slot_statistic_collection]);
                }
            }
        }
    }

    /**
     * Show page for confirmation of buy of the selected ticket.
     *
     * @return \Illuminate\View\View
     */
    public function ticketConfirmation(Request $request)
    {
        //data are already validate in seeAvailability
        $museum_id = $request->museum_id;
        $user = Auth::user();
        $museum = DB::table('museums')->where('id', '=', $museum_id)->get();
        if ($request->timeSlot != null) {
            DB::table('tickets')->insert(["museum_id" => $museum_id, "user_id" => $user->id, "visit_date" => $request->visit_date, "time_slot_number" => $request->timeSlot]);
            $time_slots = DB::table('time_slots_visit')->where('museum_id', '=', $museum_id)->where('slot_number', '=', $request->timeSlot)->get();
            return view('ticketConfirmation')
                ->with(['museums' => $museum])
                ->with(['visit_date' => $request->visit_date])
                ->with(['time_slots' => $time_slots]);
        } else {
            DB::table('tickets')->insert(["museum_id" => $museum_id, "user_id" => $user->id, "visit_date" => $request->visit_date, "time_slot_number" => 0]);
            return view('ticketConfirmation')
                ->with(['museums' => $museum])
                ->with(['visit_date' => $request->visit_date]);
        }
    }

    /**
     * Show page for choose museum before page for ticket validation (operator only).
     *
     * @return \Illuminate\View\View
     */
    public function ticketValidator_choose_museum()
    {
        $user = Auth::user();
        if ($user->role == 2) {
            $museums = DB::table('museums')->get();
            return view('ticketValidator_choose_museum')
                ->with(['museums' => $museums]);
        } else {
            return view('home');
        }
    }

    /**
     * Show page for choose tag before page for ticket validation (operator only).
     *
     * @return \Illuminate\View\View
     */
    public function ticketValidator_choose_tag(Request $request)
    {
        $user = Auth::user();
        if ($user->role == 2) {
            if($request->museum == null){
                $museums = DB::table('museums')->get();
                $message = "you don't have choose a museum";
                return view('ticketValidator_choose_museum')
                    ->with(['museums' => $museums])
                    ->with(['message' => $message]);
            } else {
            $museum_id = $request->museum;
            $museums = DB::table('museums')->where('id', '=', $museum_id)->get();
            $tags = DB::table('museum_tags')->where('museum_id', '=', $museum_id)->get();
            return view('ticketValidator_choose_tag')
                ->with(['museums' => $museums])
                ->with(['tags' => $tags]);
            }
        } else {
            return view('home');
        }
    }

    /**
     * Show page for ticket validation (operator only).
     *
     * @return \Illuminate\View\View
     */
    public function ticketValidator_qrCodeReader(Request $request)
    {
        $user = Auth::user();
        if ($user->role == 2) {
            if($request->tag_id == null){
                $museum_id = $request->museum_id;
                $museums = DB::table('museums')->where('id', '=', $museum_id)->get();
                $tags = DB::table('museum_tags')->where('museum_id', '=', $museum_id)->get();
                $message = "you don't have choose a museum";
                return view('ticketValidator_choose_tag')
                    ->with(['museums' => $museums])
                    ->with(['tags' => $tags])
                    ->with(['message' => $message]);
            }
            else {
                $museum_id = $request->museum_id;
                $tag_id = $request->tag_id;
                $museums = DB::table('museums')->where('id', '=', $museum_id)->get();
                $tags = DB::table('museum_tags')->where('id', '=', $tag_id)->get();
                return view('ticketValidator_qrCodeReader')
                    ->with(['museums' => $museums])
                    ->with(['tags' => $tags]);
            }
        } else {
            return view('home');
        }
    }

    public function tickets()
    {
        $user = Auth::user();
        $tickets = DB::table('tickets')->where('user_id', '=', $user->id)->orderBy('visit_date')->get();
        $museums = DB::table('museums')->get();
        $time_slots = DB::table('time_slots_visit')->get();
        return view('tickets')
            ->with(['tickets' => $tickets])
            ->with(['museums' => $museums])
            ->with(['time_slots' => $time_slots]);
    }

    public function ticketQrCode($ticket_id)
    {
        $tickets = DB::table('tickets')->where('id', '=', $ticket_id)->get();
        return view('ticketQrCode')
            ->with(['tickets' => $tickets]);
    }

    public function requestRefund($ticket_id)
    {
        $tickets = DB::table('tickets')->where('id', '=', $ticket_id)->get();
        $museums = DB::table('museums')->get();
        $time_slots = DB::table('time_slots_visit')->get();
        $message = "";
        $success = 1;
        foreach ($tickets as $ticket){
            if ($ticket->validated == 1){
                $message = "the ticket is already used, you can't request the refund.\n";
                $success = 0;
            }
            if($ticket->refundRequest == 1){
                $message = "the request for the refund of this ticket is already sent.\n";
                $success = 0;
            }
            $now = Carbon::now();
            $visit_date = Carbon::createFromFormat('Y-m-d', $ticket->visit_date);
            if($visit_date->gt($now)){
                $message = $message."You can request the refund only after the visit date of the ticket.\n";
                $success = 0;
            }
        }
        if($success == 1){
            DB::table('tickets')->where('id', '=', $ticket_id)->update(['refundRequest' => 1]);
        }
        return view('requestRefund')
            ->with(['tickets' => $tickets])
            ->with(['museums' => $museums])
            ->with(['time_slots' => $time_slots])
            ->with(['success' => $success])
            ->with(['message' => $message]);
    }

    public function validation($museum_id, $tag_id, $ticket_id, $user_id)
    {
        $ticket = DB::table('tickets')->where('id', '=', $ticket_id)->get()->first();
        $tag = DB::table('museum_tags')->where('id', '=', $tag_id)->get()->first();
        $success = 1;
        $description = "";
        if($ticket->user_id == $user_id)
        {
            if($ticket->museum_id == $museum_id)
            {
                if ($ticket->validated == 0)
                {
                    $now = Carbon::now()->toDateString();
                    $visit_date = Carbon::createFromFormat('Y-m-d', $ticket->visit_date)->toDateString();
                    if ($now == $visit_date)
                    {
                        DB::table('tickets')->where('id', '=', $ticket_id)->update(['validated' => 1]);
                        DB::table('museum_tags')->where('id', '=', $tag_id)->update(['available' => 0]);
                        DB::table('museum_tag_user')->insert(['museum_tag_id' => $tag_id, 'user_id' => $user_id, 'piano' => '0', 'posX' => '0', 'posY' => '0']);
                    } else {
                        $success = 0;
                        $description = "the visit date of the ticket is not today";
                        error_log("the date of ticket is: ".$visit_date." while now is: ".$now);

                    }
                } else {
                    $success = 0;
                    $description = "the ticket is already used";
                }
            }else{
                $success = 0;
                $description = "the ticket it's not for this museum";
            }
        }else{
            $success = 0;
            $description = "the ticket don't belong to you";
        }
        return view('validation')->with(['success' => $success])->with(['description' => $description]);
    }
}