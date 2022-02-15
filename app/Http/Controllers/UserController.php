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
        $validation = DB::table('museum_tag_user')
        ->where('user_id', '=', Auth::user()->id)
        ->first();
        if (is_null($validation)){
            //nessun tag associato
        }
        else {
            //inizio la visita
            $museum_id = DB::table('museum_tags')->where('id', '=', $validation->museum_tag_id)->first('museum_id');
            $response = Http::post('http://127.0.0.1:5050/userPos', [
                'target' => $user->id,
            ]);
            $data = $response->json();
            $rooms_list = DB::table('rooms')->where("rooms.museum_id", "=", $museum_id->museum_id)->where('rooms.height', '=', strval($data['Floor']))->get();
            $artworks_list = DB::table('artworks')->whereIn("id", $data['NearArt'])->get();
            return view('userTracking')->with([
                'museum_id' => $museum_id->museum_id,
                'response' => $data,
                'rooms_list' => $rooms_list,
                'artworks_list' => $artworks_list
            ]);
        }
    }

    public function userTrackingUpdate(Request $request) {
        $user = Auth::user();
        $response = Http::post('http://127.0.0.1:5050/userPos', [
            'target' => $user->id,
        ]);
        $data = $response->json();
        $rooms_list = DB::table('rooms')->where("rooms.museum_id", "=", $request->museum_id)->where('rooms.height', '=', strval($data['Floor']))->get();
        $artworks_list = DB::table('artworks')->whereIn("id", $data['NearArt'])->get();
        return response()->json([
            'response' => $data,
            'rooms_list' => $rooms_list,
            'artworks_list' => $artworks_list
        ]);
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

    public function feedbackMuseumsAndArtworks(){
        $user = Auth::user();
        $museums = DB::table('museums')->join('tickets', 'museums.id', '=', 'tickets.museum_id')->where('tickets.user_id', '=', $user->id)->where('tickets.validated', '=', 1)->select('museums.*')->get();
        return view('feedbackMuseumsAndArtworks')
            ->with(['museums' => $museums]);
    }

    public function feedbackMuseumsAndArtworksChosenMuseum(Request $request){
        $user = Auth::user();
        if ($request->museum != null)
        {
            $museums = DB::table('museums')->where('id', '=', $request->museum)->get();
            $rooms = DB::table('rooms')->where('museum_id', '=', $request->museum)->get();
            $artworks = DB::table('artworks')->get();
            if(DB::table('museum_reviews')->where('museum_id', '=', $request->museum)->where('user_id', '=', $user->id)->count() > 0){
                $museum_reviewed = True;
            }else{
                $museum_reviewed = False;
            }
            $artwork_reviews = DB::table('artwork_reviews')->get();
            return view('feedbackMuseumsAndArtworksChosenMuseum')
                ->with(['museums' => $museums])
                ->with(['rooms' => $rooms])
                ->with(['artworks' => $artworks])
                ->with(['museum_reviewed' => $museum_reviewed])
                ->with(['artwork_reviews' => $artwork_reviews]);
        } else {
            $museums = DB::table('museums')->join('tickets', 'museums.id', '=', 'tickets.museum_id')->where('tickets.user_id', '=', $user->id)->where('tickets.validated', '=', 1)->select('museums.*')->get();
            $message = "you have to choose a museum before go to next page";
            return view('feedbackMuseumsAndArtworks')
                ->with(['museums' => $museums])
                ->with(['message' => $message]);
        }
    }

    public function feedbackMuseumPage($museum_id){
        $museums = DB::table('museums')->where('id', '=', $museum_id)->get();
        return view('feedbackMuseumPage')
            ->with(['museums' => $museums]);
    }

    public function feedbackMuseum(Request $request){
        $error = 0;
        $message = "";
        if ($request->title == null){
            $error = 1;
            $message = "You don't have insert title";
        }
        if($request->vote == null){ #should be 1 by default, but to be sure just a check
            if($error == 1){
                $message = "You don't have insert title and vote";
            }else{
                $error = 1;
                $message = "You don't have insert vote";
            }
        }
        if($error == 1){
            $museum = DB::table('museums')->where('id', '=', $request->museum)->get();
            return view('feedbackMuseumPage')
                ->with(['museums' => $museum])
                ->with(['message' => $message]);
        }else{
            $user = Auth::user();
            if(DB::table('museum_reviews')->where('museum_id', '=', $request->museum)->where('user_id', '=', $user->id)->count() > 0){  #prevent reload page error
                return($this->feedbackMuseumsAndArtworksChosenMuseum($request));
            }else{
                if($request->description == null){
                    DB::table('museum_reviews')->insert(['museum_id' => $request->museum, 'user_id' => $user->id, 'review_title' => $request->title, 'stars' => $request->vote]);
                }else{
                    DB::table('museum_reviews')->insert(['museum_id' => $request->museum, 'user_id' => $user->id, 'review_title' => $request->title, 'review_text' => $request->description, 'stars' => $request->vote]);
                }
                return($this->feedbackMuseumsAndArtworksChosenMuseum($request));
            }
        }
    }

    public function feedbackArtworkPage($museum_id, $artwork_id){
        $museums = DB::table('museums')->where('id', '=', $museum_id)->get();
        $artworks = DB::table('artworks')->where('id', '=', $artwork_id)->get();
        return view('feedbackArtworkPage')
            ->with(['museums' => $museums])
            ->with(['artworks' => $artworks]);
    }

    public function feedbackArtwork(Request $request){
        $error = 0;
        $message = "";
        if ($request->title == null){
            $error = 1;
            $message = "You don't have insert title";
        }
        if($request->vote == null){ #should be 1 by default, but to be sure just a check
            if($error == 1){
                $message = "You don't have insert title and vote";
            }else{
                $error = 1;
                $message = "You don't have insert vote";
            }
        }
        if($error == 1){
            $museums = DB::table('museums')->where('id', '=', $request->museum)->get();
            $artworks = DB::table('artworks')->where('id', '=', $request->artwork)->get();
            return view('feedbackArtworkPage')
                ->with(['museums' => $museums])
                ->with(['artworks' => $artworks])
                ->with(['message' => $message]);
        }else{
            $user = Auth::user();
            if(DB::table('artwork_reviews')->where('artwork_id', '=', $request->artwork)->where('user_id', '=', $user->id)->count() > 0){  #prevent reload page error
                return($this->feedbackMuseumsAndArtworksChosenMuseum($request));
            }else{
                if($request->description == null){
                    DB::table('artwork_reviews')->insert(['artwork_id' => $request->artwork, 'user_id' => $user->id, 'review_title' => $request->title, 'stars' => $request->vote]);
                }else{
                    DB::table('artwork_reviews')->insert(['artwork_id' => $request->artwork, 'user_id' => $user->id, 'review_title' => $request->title, 'review_text' => $request->description, 'stars' => $request->vote]);
                }
                return($this->feedbackMuseumsAndArtworksChosenMuseum($request));
            }
        }
    }

    public function showSocialArea()
    {
        $museums = DB::table('museums')->get();
        $museum_reviews = DB::table('museum_reviews')->join('museums', 'museums.id', '=', 'museum_reviews.museum_id')->join('users', 'users.id', '=', 'museum_reviews.user_id')->select('museum_reviews.*', 'museums.name AS name', 'users.username AS username')->get();
        $artwork_reviews = DB::table('artwork_reviews')->join('artworks', 'artworks.id', '=', 'artwork_reviews.artwork_id')->join('users', 'users.id', '=', 'artwork_reviews.user_id')->select('artwork_reviews.*', 'artworks.title AS name', 'users.username AS username')->get();
        $merged_reviews = $museum_reviews->merge($artwork_reviews)->sortByDesc('review_date');
        return view('socialArea')
            ->with(['merged_reviews' => $merged_reviews])
            ->with(['museums' => $museums]);
    }

    public function showSocialAreaByMuseum($museum_id)
    {
        $museums = DB::table('museums')->where('id', '=', $museum_id)->get();
        $museum_reviews = DB::table('museum_reviews')->join('museums', 'museums.id', '=', 'museum_reviews.museum_id')->join('users', 'users.id', '=', 'museum_reviews.user_id')->where('museum_reviews.museum_id', '=', $museum_id)->select('museum_reviews.*', 'museums.name AS name', 'users.username AS username')->get();
        $artwork_reviews = DB::table('artwork_reviews')->join('artworks', 'artworks.id', '=', 'artwork_reviews.artwork_id')->join('rooms', 'rooms.id', '=', 'artworks.room_id')->join('museums', 'museums.id', '=', 'rooms.museum_id')->join('users', 'users.id', '=', 'artwork_reviews.user_id')->where('museums.id', '=', $museum_id)->select('artwork_reviews.*', 'artworks.title AS name', 'users.username AS username')->get();
        $merged_reviews = $museum_reviews->merge($artwork_reviews)->sortByDesc('review_date');
        return view('socialAreaByMuseum')
            ->with(['merged_reviews' => $merged_reviews])
            ->with(['museums' => $museums]);
    }
}
