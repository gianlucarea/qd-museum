<?php

namespace App\Http\Controllers;

use App\Models\Museum;
use App\Models\Room;
use Illuminate\Http\Request;
use App\Models\Artwork;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class ArtworkController extends Controller
{

    public function show($museum_id)
    {
        $rooms = Room::where('museum_id', '=' , $museum_id)->select('id')->get();
        $artworks = Artwork::get();

        return view('showArtworks')->with(compact('artworks'))->with(compact('rooms'));
    }

    public function getArtworkToUpdate($id){
        $artwork = Artwork::where('id','=',$id)->first();
        return view('editArtwork')->with(compact('artwork'));
    }

    public function chooseMuseumForRemoveArtwork()
    {
        $museums = DB::table('museums')->get();
        return view('chooseMuseumForRemoveArtwork')->with(['museums' => $museums]);
    }

    public function getArtwork($id){
        $artwork = Artwork::where('id','=',$id)->first();
        return view('showArtwork')->with(compact('artwork'));
    }

    public function getArtworksByMuseum(Request $request){
        $request->validate([
            'museum'=>'required',
        ]);
        $museum_id = $request->museum;
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
        $request->validate([
            'title'=>'required',
            'description'=>'required',
            'room_id'=>'required',
        ]);
        $room = Room::where('id','=', $request->room_id)->first();
        if (empty($room)){
            return View('addArtwork');
        } else {
            $museum_id = $room->museum_id;
            if (Auth::user()->role == 2 || Auth::user()->role == 3) {
                $artwork = new Artwork();
                $artwork->title = $request->title;
                $artwork->description = $request->description;
                $artwork->room_id = $request->room_id;
                $artwork->save();
                return redirect()->route('showArtworks', ['id' => $museum_id]);
            } else {
                return redirect()->back()->with('message', 'Not Authorized');
            }
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
        if (Auth::user()->role == 2 || Auth::user()->role == 3 ) {
            $artwork = Artwork::find($id);
            if (is_null($artwork)) {
                return response()->json(["message" => 'Record not found'], 404);
            }
            $artwork->title = $request->input('title');
            $artwork->description = $request->input('description');
            $artwork->room_id = $request->input('room_id');
            $artwork->update();

            $room = Room::where('id','=', $request->room_id)->first();
            $museum_id = $room->museum_id;
            return redirect()->route('showArtworks', ['id' => $museum_id]);
        } else {
            return redirect()->back()->with('message','Not Authorized');
        }
    }
}
