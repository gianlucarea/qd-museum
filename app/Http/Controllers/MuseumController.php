<?php

namespace App\Http\Controllers;

use App\Models\Museum;
use Illuminate\Http\Request;

class MuseumController extends Controller
{
    public static function addMuseum(Request $request){
        

        $request->validate([
            'name' => ['required', 'string', 'max:127'],
            'address' => ['required', 'string','max:127'],
            'description' => ['required','string']
        ]);
            $data=array(
                'name'=>  $request->name,
                'address' => $request->address,
                'description' => $request->description,
            );

            Museum::create($data);
             return redirect('/home');
         }

}
