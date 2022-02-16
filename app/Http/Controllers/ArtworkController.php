<?php

namespace App\Http\Controllers;

use App\Models\Museum;
use App\Models\Room;
use Illuminate\Http\Request;
use App\Models\Artwork;
use App\Models\Museum_Review;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class ArtworkController extends Controller
{

    public function show($museum_id)
    {
        $rooms = Room::where('museum_id', '=' , $museum_id)->select('id')->get();
        $artworks = Artwork::get();
        $museum = DB::table('museums')->where('id', '=', $museum_id)->get()->first();
        $stars =  DB::table('museum_reviews')->where('museum_id','=',$museum_id)->avg('stars');
        if($museum->total_visit != 0){
            $avg_time = $museum->total_time/$museum->total_visit;
            $avg_time_minutes = floor($avg_time/60);
            $avg_time_seconds = $avg_time%60;
        } else {
            $avg_time = 0;
        }
        return view('showArtworks')
            ->with(compact('artworks'))
            ->with(compact('rooms'))
            ->with(compact('museum'))
            ->with(compact('avg_time'))
            ->with(compact('avg_time_minutes'))
            ->with(compact('avg_time_seconds'))
            ->with(compact('stars'));
    }

    public function showAddArtworkPage($museum_id)
    {
        $museum = DB::table('museums')->where('id', '=', $museum_id)->get()->first();
        return view('addArtwork')->with(compact('museum'));
    }

    public function getArtworkToUpdate($id){
        $artwork = Artwork::where('id','=',$id)->first();
        $museum = DB::table('rooms')->join('museums', 'rooms.museum_id', '=', 'museums.id')->where('rooms.id', '=', $artwork->room_id)->get()->first();
        return view('editArtwork')->with(compact('artwork'))->with(compact('museum'));
    }

    public function chooseMuseumForArtworkAndManagement()
    {
        $museums = DB::table('museums')->get();
        return view('chooseMuseumForArtworkAndManagement')->with(['museums' => $museums]);
    }

    public function getArtwork($id){
        $artwork = Artwork::where('id','=',$id)->get()->first();
        $museum = DB::table('rooms')->join('museums', 'rooms.museum_id', '=', 'museums.id')->where('rooms.id', '=', $artwork->room_id)->get()->first();
        $stars =  DB::table('artwork_reviews')->where('artwork_id','=',$id)->avg('stars');
        if($artwork->total_visit != 0){
            $avg_time = $artwork->total_time/$artwork->total_visit;
            $avg_time_minutes = floor($avg_time/60);
            $avg_time_seconds = $avg_time%60;
        } else {
            $avg_time = 0;
        }

        return view('showArtwork')
            ->with(compact('artwork'))
            ->with(compact('stars'))
            ->with(compact('museum'))
            ->with(compact('avg_time'))
            ->with(compact('avg_time_minutes'))
            ->with(compact('avg_time_seconds'));
    }

    public function getArtworksByMuseum(Request $request){
        $request->validate([
            'museum'=>'required',
        ]);
        $museum_id = $request->museum;
        return redirect()->route('showArtworks', ['id' => $museum_id]);
    }

    public function getArtworksByMuseum2($museum_id){
        return redirect()->route('showArtworks', ['id' => $museum_id]);
    }

    public function Ajax_getArtworkByMuseum(Request $request){
        $request->validate([
            'museum'=>'required',
        ]);
        $floor_id = $request->floor;
        $museum_id = $request->museum;
        $artworks = DB::table('artworks')->join('rooms', 'artworks.room_id', '=', 'rooms.id')->where('rooms.museum_id', '=', $museum_id)->where('rooms.height', '=', $floor_id)->get();
        $rooms_list = DB::table('rooms')->where("rooms.museum_id", "=", $museum_id)->where('rooms.height', '=', $floor_id)->get();
        //$artworks = DB::table('artworks')->where('room_id', '=', $floor_id)->get();
        return response()->json([
            'response' => $artworks,
            'rooms' => $rooms_list,
        ]);
    }

    public static function store(Request $request){
        $museum = DB::table('museums')->where('id', '=', $request->museum_id)->get()->first();
        $room = Room::where('id','=', $request->room_id)->first();
        if (Auth::user()->role == 2 || Auth::user()->role == 3) {
            if (empty($room)){
                $error = "there's not room with that id!";
                return View('addArtwork')->with(compact('museum'))->with(compact('error'));
            } else {
                if ($request->title != null and $request->description != null and $request->room_id != null) {
                    if ($room->museum_id == $museum->id) {
                        $museum_id = $room->museum_id;

                        $artwork = new Artwork();
                        $artwork->title = $request->title;
                        $artwork->description = $request->description;
                        $artwork->room_id = $request->room_id;
                        $artwork->save();
                        return redirect()->route('showArtworks', ['id' => $museum_id]);
                    } else {
                        $error = "the room selected it's not owned by the museum" . $museum->name;
                        return View('addArtwork')->with(compact('museum'))->with(compact('error'));
                    }
                } else {
                    $error = "you must fill in all the fields of the form!";
                    return View('addArtwork')->with(compact('museum'))->with(compact('error'));
                }
            }
        } else {
            return redirect()->back()->with('message', 'Not Authorized');
        }
    }

    public  function delete($id){
        $Artwork = Artwork::find($id);
        if (Auth::user()->role == 2 || Auth::user()->role == 3 ) {
            if(is_null($Artwork)){
            return redirect()->back()->with('message','Alredy Deleted');
        }
            $Artwork -> delete();
            return redirect()->back()->with('message','Success');
        } else {
            return redirect()->back()->with('message','Not Authorized');
        }
    }

    public static function update(Request $request, $id){
        $museum = DB::table('museums')->where('id', '=', $request->museum_id)->get()->first();
        $room = Room::where('id','=', $request->room_id)->first();
        if (Auth::user()->role == 2 || Auth::user()->role == 3 ) {
            $artwork = Artwork::find($id);
            if (is_null($artwork)) {
                return response()->json(["message" => 'Record not found'], 404);
            } else {
                if (empty($room)){
                    $error = "there's not room with that id!";
                    return View('editArtwork')->with(compact('museum'))->with(compact('artwork'))->with(compact('error'));
                } else {
                    if ($request->title != null and $request->description != null and $request->room_id != null) {
                        if ($room->museum_id == $museum->id) {
                            $artwork->title = $request->input('title');
                            $artwork->description = $request->input('description');
                            $artwork->room_id = $request->input('room_id');
                            $artwork->update();
                            $museum_id = $room->museum_id;
                            return redirect()->route('showArtworks', ['id' => $museum_id]);
                        } else {
                            $error = "the room selected it's not owned by the museum" . $museum->name;
                            return View('editArtwork')->with(compact('museum'))->with(compact('artwork'))->with(compact('error'));
                        }
                    } else {
                        $error = "you must fill in all the fields of the form!";
                        return View('editArtwork')->with(compact('museum'))->with(compact('artwork'))->with(compact('error'));
                    }
                }
            }
        } else {
            return redirect()->back()->with('message','Not Authorized');
        }
    }
}
