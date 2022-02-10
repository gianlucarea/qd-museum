<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
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
        $user = Auth::user();
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
        $user = Auth::user();
    }

}
