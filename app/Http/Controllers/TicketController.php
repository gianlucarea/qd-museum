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
        if ($request->museum == null or $request->visitDate == null){
            $museums = DB::table('museums')->get();
            $error = 'please choose both the museum and the date in which the visit is intended (of course set a date which is not in the past)';
            return view('booking')
                ->with(['museums' => $museums])
                ->with(['error' => $error]);
        }
        else{
            $date = $request->visitDate;
            if (Carbon::now()->startOfDay()->gt($date)){
                $museums = DB::table('museums')->get();
                $error = 'please choose both the museum and the date in which the visit is intended (of course set a date which is not in the past)';
                return view('booking')
                    ->with(['museums' => $museums])
                    ->with(['error' => $error]);
            }
            else{
                $tickets_already_bought = DB::table('tickets')->where('visit_date', '=', $date)->where('museum_id', '=', $request->museum)->count();
                if ($tickets_already_bought > 500){
                    $museums = DB::table('museums')->get();
                    $error = 'in the selected date the available tickets are already sold';
                    return view('booking')
                        ->with(['museums' => $museums])
                        ->with(['error' => $error]);
                }
                else{
                    $museum = DB::table('museums')->where('id', '=', $request->museum)->get();
                    $time_slots = DB::table('time_slots_visit')->where('museum_id', '=', $request->museum)->get();
                    $first_time_slot_statistic = DB::table('tickets')->where('museum_id', '=', $request->museum)->where('visit_date', '=', $request->visitDate)->where('time_slot_number', '=', 1)->count();
                    $second_time_slot_statistic = DB::table('tickets')->where('museum_id', '=', $request->museum)->where('visit_date', '=', $request->visitDate)->where('time_slot_number', '=', 2)->count();
                    return view('seeAvailability')
                        ->with(['museums' => $museum])
                        ->with(['visit_date' => $date])
                        ->with(['time_slots' => $time_slots])
                        ->with(['first_time_slot_statistic' => $first_time_slot_statistic])
                        ->with(['second_time_slot_statistic' => $second_time_slot_statistic]);
                }
            }
        }
    }

    /**
     * Show page for confirmation of buy of the selected ticket.
     *
     * @return \Illuminate\View\View
     */
    public function ticketConfirmation(Request $request){
        //data are already validate in seeAvailability
        $museum_id = $request->museum_id;
        $user = Auth::user();
        $museum = DB::table('museums')->where('id', '=', $museum_id)->get();
        if ($request->timeSlot != null){
            DB::table('tickets')->insert(["museum_id" => $museum_id, "user_id" => $user->id, "visit_date" => $request->visit_date, "time_slot_number" => $request->timeSlot]);
            $time_slots = DB::table('time_slots_visit')->where('museum_id', '=', $museum_id)->where('slot_number', '=', $request->timeSlot)->get();
            return view('ticketConfirmation')
                ->with(['museums' => $museum])
                ->with(['visit_date' => $request->visit_date])
                ->with(['time_slots' => $time_slots]);
        }
        else{
            DB::table('tickets')->insert(["museum_id" => $museum_id, "user_id" => $user->id, "visit_date" => $request->visit_date, "time_slot_number" => 0]);
            return view('ticketConfirmation')
                ->with(['museums' => $museum])
                ->with(['visit_date' => $request->visit_date]);
        }
    }
}