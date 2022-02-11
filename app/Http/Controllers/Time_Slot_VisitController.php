<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Museum;
use App\Models\Time_Slot_Visit;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;



class Time_Slot_VisitController extends Controller
{
    public static function show(Request $request)
    {
        $museum_id = $request->museum;
        $time_slots = DB::table('time_slots_visit')->where('museum_id', '=' , $museum_id)->get();
        $museum = Museum::where('id','=',$museum_id)->first();
        return view('showTimeSlots')->with(compact('time_slots'))->with(compact('museum'));
    }

    public static function store(Request $request){
        $request->validate([
            'slot_number'=>'required',
            'description'=>'required',
            'museum_id'=>'required'
        ]);
        if (Auth::user()->role == 2 || Auth::user()->role == 3 ) {
            DB::table('time_slots_visit')->insert([
                'slot_number' => $request->slot_number,
                'description' => $request->description,
                'museum_id' => $request->museum_id,
            ]);
            $museum = Museum::where('id','=',$request->museum_id)->first();
            $time_slots = DB::table('time_slots_visit')->where('museum_id', '=' , $request->museum_id)->get();
            return view('showTimeSlots')->with(compact('time_slots'))->with(compact('museum'));
        } else {
            return redirect()->back()->with('message','Not Authorized');
        }
    }

    public  function delete($id){
        $time_slot = DB::table('time_slots_visit')->find($id);
        $museum = DB::table('museums')->where('id','=',$time_slot->museum_id)->first();

        if (Auth::user()->role == 2 || Auth::user()->role == 3 ) {

            if(is_null($time_slot)){
                $time_slots = DB::table('time_slots_visit')->where('museum_id','=',$museum->id)->get();
                return view('showTimeSlots')->with(compact('time_slots'))->with(compact('museum'));
            }
            $time_slot = DB::table('time_slots_visit')->where('id', '=', $id)->get()->first();
            $tickets_to_update = DB::table('tickets')->where('time_slot_number', '=', $time_slot->slot_number)->where('museum_id', '=', $time_slot->museum_id)->get();
            foreach($tickets_to_update as $ticket_to_update){
                DB::table('tickets')->where('id', '=', $ticket_to_update->id)->update(['time_slot_number' => 0]);
            }
            $time_slot = DB::table('time_slots_visit')->where('id','=',$id)->delete();
            $time_slots = DB::table('time_slots_visit')->where('museum_id','=',$museum->id)->get();
            return view('showTimeSlots')->with(compact('time_slots'))->with(compact('museum'));
        } else {
            $time_slots = DB::table('time_slots_visit')->where('museum_id','=',$museum->id)->get();
            return view('showTimeSlots')->with(compact('time_slots'))->with(compact('museum'));
        }
    }
    public function chooseMuseumForRemoveTimeSlot()
    {
        $museums = DB::table('museums')->get();
        return view('timeslot_choose_museum')->with(['museums' => $museums]);

    }

    public function chooseMuseumToShow()
    {
        $museums = DB::table('museums')->get();
        return view('timeslot_museum_delete')->with(['museums' => $museums]);
    }

}
