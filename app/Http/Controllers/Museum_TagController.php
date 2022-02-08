<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class Museum_TagController extends Controller
{
    public function tagDecoupling()
    {
        $tags = DB::table('museum_tags')->where('available', '=', 0)->get();
        return view('tagDecoupling')
            ->with(['tags' => $tags]);
    }

    public function tagDecoupling_effective(Request $request)
    {
        if($request->tag_id == null){
            $tags = DB::table('museum_tags')->where('available', '=', 0)->get();
            $message = "you don't have choose any tag";
            return view('tagDecoupling')
                ->with(['tags' => $tags])
                ->with(['message' => $message]);
        } else {
            $tag_id = $request->tag_id;
            DB::table('museum_tag_user')->where('museum_tag_id', '=', $tag_id)->delete();
            DB::table('museum_tags')->where('id', '=', $tag_id)->update(['available' => 1]);
            return view('tagDecouplingOutcome');
        }
    }
}
