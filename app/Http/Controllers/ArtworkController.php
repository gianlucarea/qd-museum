<?php

namespace App\Http\Controllers;

use App\Models\Museum;
use App\Models\Room;
use Illuminate\Http\Request;
use App\Models\Artwork;
use Illuminate\Support\Facades\Auth;

class ArtworkController extends Controller
{

    public function show($museum_id)
    {
        $rooms = Room::where('museum_id', '=' , $museum_id)->select('id')->get();
        $artworks = Artwork::get();

        return view('showArtworks')->with(compact('artworks'))->with(compact('rooms'));
    }

    public function getArtwork($id){
        $artwork = Artwork::where('id','=',$id)->first();
        return view('showArtwork')->with(compact('artwork'));
    }

    public static function store(Request $request){
        $request->validate([
            'title'=>'required',
            'description'=>'required',
            'room_id'=>'required',
        ]);
        $room = Room::where('id','=', $request->room_id)->first();
        $museum_id = $room->museum_id;
        if (Auth::user()->role == 2 || Auth::user()->role == 3 ) {
            $artwork = new Artwork();
            $artwork->title = $request->title;
            $artwork->description = $request->description;
            $artwork->room_id = $request->room_id;
            $artwork->save();
            return redirect()->route('showArtworks', ['id' => $museum_id]);
        } else {
            return redirect()->back()->with('message','Not Authorized');
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
            $Artwork = Artwork::find($id);
            if (is_null($Artwork)) {
                return response()->json(["message" => 'Record not found'], 404);
            }
            $Artwork->update($request->all());
            return redirect()->back()->with('message','Updated');
        } else {
            return redirect()->back()->with('message','Not Authorized');
        }
    }
}
