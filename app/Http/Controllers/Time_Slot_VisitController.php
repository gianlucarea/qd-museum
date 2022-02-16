<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Museum;
use App\Models\Time_Slot_Visit;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;



class Time_Slot_VisitController extends Controller
{
    public static function show($museum_id)
    {
        $time_slots = DB::table('time_slots_visit')->where('museum_id', '=' , $museum_id)->get();
        $museum = Museum::where('id','=',$museum_id)->first();
        return view('showTimeSlots')->with(compact('time_slots'))->with(compact('museum'));
    }

    public function showAddTimeSlotPage($museum_id)
    {
        $museum = DB::table('museums')->where('id', '=', $museum_id)->get()->first();
        return view('addTimeSlot')->with(compact('museum'));
    }

    public function show_time_slots_by_museum(Request $request)
    {
        if($request->museum != null){
            $museum_id = $request->museum;
            return redirect()->route('showMuseumTimeSlot', ['id' => $museum_id]);
        } else {
            $museums = DB::table('museums')->get();
            $message = "choose a museum before go";
            return view('timeslot_choose_museum_to_show')->with(['museums' => $museums])->with(compact('message'));
        }
    }

    public function show_time_slots_by_museum2($museum_id){
        return redirect()->route('showMuseumTimeSlot', ['id' => $museum_id]);
    }

    public static function store(Request $request){
        if (Auth::user()->role == 2 || Auth::user()->role == 3 ) {
            $museum = Museum::where('id','=',$request->museum_id)->first();
            if ($request->slot_number != null and $request->description != null) {
                DB::table('time_slots_visit')->insert(['museum_id' => $request->museum_id, 'description' => $request->description, 'slot_number' => $request->slot_number]);
                return redirect()->route('showMuseumTimeSlot', ['id' => $request->museum_id]);
            } else {
                $error = "you must fill in all the fields of the form!";
                return View('addTimeSlot')->with(compact('museum'))->with(compact('error'));
            }

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

    public static function update(Request $request, $id){
        if (Auth::user()->role == 2 || Auth::user()->role == 3 ) {
            $time_slot = DB::table('time_slots_visit')->where('id','=',$id)->first();
            if (is_null($time_slot)) {
                return response()->json(["message" => 'Record not found'], 404);
            }

            DB::table('time_slots_visit')->where('id','=',$id)->update([
                
                    'slot_number'      => $request->input('slot_number'),
                    'description'      => $request->input('description')
                
            ]);

            $museum = Museum::where('id','=',$time_slot->museum_id)->first();
            $time_slots = DB::table('time_slots_visit')->where('museum_id', '=' , $time_slot->museum_id)->get();
            return redirect()->route('showMuseumTimeSlot', ['id' => $time_slot->museum_id]);
        } else {
            return redirect()->back()->with('message','Not Authorized');
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
        return view('timeslot_choose_museum_to_show')->with(['museums' => $museums]);
    }

    public function getSlotToUpdate($id){
        $slot = DB::table('time_slots_visit')->where('id','=',$id)->first();
        $museum = DB::table('museums')->where('id', '=', $slot->museum_id)->get()->first();
        return view('editTimeSlot')->with(compact('slot'))->with(compact('museum'));
    }

}
