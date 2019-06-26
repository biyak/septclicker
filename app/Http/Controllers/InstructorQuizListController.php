<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class InstructorQuizListController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
 
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index($user)
    {
        $user = \App\User::findOrFail($user);
        return view('instructorside/quiz/instructorquizlist', ['user' => $user]);
    }

}