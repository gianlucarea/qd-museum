<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Museum;
use App\Models\Time_Slot_Visit;
use Illuminate\Support\Facades\DB;


class Time_Slot_VisitController extends Controller
{
    public static function show($museum_id)
    {
        $time_slots = DB::table('time_slots_visit')->where('museum_id', '=' , $museum_id)->get();
        $museum = Museum::where('id','=',$museum_id)->first();
        return view('showTimeSlots')->with(compact('time_slots'))->with(compact('museum'));
    }
}
