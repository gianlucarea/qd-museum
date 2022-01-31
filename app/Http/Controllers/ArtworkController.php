<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Artwork;

class ArtworkController extends Controller
{

    public static function addArtwork($id, Request $request){
        request->$validate([
            ''
        ]);
    }

}
