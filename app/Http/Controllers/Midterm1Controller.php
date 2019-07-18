<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class Midterm1Controller extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        return view('instructor/quiz/midterm1');
    }
}
