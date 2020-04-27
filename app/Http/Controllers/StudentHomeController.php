<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class StudentHomeController extends Controller {
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        // If the logged in user is an instructor, send them to instructorhome
        if (auth()->user()->instructor === 1){
            return redirect('/instructorhome');
        }
        return view('studentside/studenthome');
    }
}

?>
