<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Visit_Route;
use Illuminate\Http\Request;
use Response;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Http;
use Symfony\Component\Console\Input\Input;
use Auth;

class Visit_RouteController extends Controller
{
    //Retrieve information of a Visit Route
    public function getVRoute(Request $request) {
        $request->validate([
            'id_route'=>'required',
        ]);
        $VRoute = DB::table('visit_route')->where('id', '=', $request->id_route)->first();
        $Artwork_id_list = explode("|", $VRoute->artwork_list);
        $Artworks_list = DB::table('artworks')->whereIn("id", $Artwork_id_list)->get();
        //response on view
    }

    //Retrieve all Visit Route of a User
    public function getVRoutesByUser(Request $request) {
        $user = Auth::user();
        $VRoutes_list = DB::table('visit_route')->where('user_id', '=', $user->id)->get();

    }

    //Add a new Visit Route on DB
    public function addVRoute(Request $request) {

    }

    //Delete a Visit Route from DB
    public function deleteVRoute(Request $request) {

    }

}
