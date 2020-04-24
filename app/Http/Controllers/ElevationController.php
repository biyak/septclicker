<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ElevationController extends Controller
{
    public function __construct()
    {
        $this->middleware("auth");
    }

    public function index(){
        // Instructors get sent back to their home because they don't need to elevate
        if (auth()->user()->instructor){
            return redirect('/instructorhome');
        }
        return view('auth.elevate', ['error' => NULL]);
    }

    public function elevate(Request $request){

        if (auth()->user()->instructor){
            return redirect('/instructorhome');
        }
        $code = $request->get("code");

        // Get the elevation entry associated with this code
        $elevations = \App\Elevations::get()->where('code',$code)->all();
        if (sizeof($elevations) === 0) {
            return view('auth.elevate', ['error' => 'This code is invalid, please ensure you have entered it correctly']);
        }

        $elevation = $elevations[0];
        if($elevation->used) {
            return view('auth.elevate', ['error' => 'This code has already been used.']);
        }

        $elevation->used = True;
        $elevation->save();
        auth()->user()->instructor = 1;
        auth()->user()->save();


        return redirect('/instructorhome');
    }
}
