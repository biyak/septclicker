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
        $user = auth()->user();
        //$this->authorize('view', $user->profile);
        //dd($user->profile);
        return view('instructorside/quiz/instructorquizlist', ['user' => $user]);
    }

    public function delete(\App\Quiz $quiz) {
          $quiz -> update(
            ['deleted' => 1]
          );

        $user = auth()->user();
        return view('instructorside/quiz/instructorquizlist/'.auth()->user()->id, compact('user'));
    }

}
