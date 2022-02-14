<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Response;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Http;
use Symfony\Component\Console\Input\Input;
use Auth;

class UserController extends Controller
{
    /**
     * Get all information about user
     * 
     * @return \Illuminate\View\Profile
     */
    public function getUserInfo(Request $request)
    {   
        $user = Auth::user();
        return view('userProfile', $user);
    }

    public function getWorkingMuseum(Request $request)
    {
        $museums = DB::table('museums')->get();
        return view('chooseMuseumForTracking')->with(['museums' => $museums]);
    }

    /**
     * Track the user on the visit, async update
     * 
     * @return \Illuminate\View\Visit
     */
    public function userTracking(Request $request)
    {
        $user = Auth::user();
    }

    /**
     * Operator controll for visitor management on the museum
     * 
     * @return \Illuminate\View\VisitorControl
     */
    public function operatorTracking (Request $request)
    {
        $request->validate([
            'museum'=>'required',
        ]);
        $museum_id = $request->museum;
        $rooms_list = DB::table('rooms')->where("rooms.museum_id", "=", $museum_id)->get();
        $floors_list = DB::table('rooms')->where("rooms.museum_id", "=", $museum_id)->distinct()->get("height");
        return view('operatorTracking')->with([
            'museum_id' => $museum_id, 
            'floors_list' => $floors_list,
            'rooms_list' => $rooms_list
        ]);
    }

    public function operatorTrackingUpdate(Request $request) {

        $response = Http::post('http://127.0.0.1:5050/userPos', [
            'target' => "ALL",
            'museum' => $request->museum,
            'floor' => $request->floor,
        ]);
        $data = $response->json();
        return response()->json([
            'response' => $data,
        ]);
    }

}
