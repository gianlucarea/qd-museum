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
        if (Auth::user()->role == 2 || Auth::user()->role == 3 ) {
            if(is_null($time_slot)){
            return redirect()->back()->with('message','Alredy Deleted');
        }
            $time_slot = DB::table('time_slots_visit')->where('id','=',$id)->delete();
            return redirect()->back()->with('message','Success');
        } else {
            return redirect()->back()->with('message','Not Authorized');
        }
    }
}
