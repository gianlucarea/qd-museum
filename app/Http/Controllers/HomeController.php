<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Auth;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $user = Auth::user();
        $tickets_used = DB::table('tickets')->where('user_id', '=', $user->id)->where('validated', '=', 1)->count();
        if($tickets_used > 0)
        {
            return view('home')
                ->with(['ticket_used' => True]);
        }else{
            return view('home')
                ->with(['ticket_used' => False]);
        }
    }
}
