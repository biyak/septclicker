<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class InstructorQuizListController extends Controller
{

 
    public function index($user)
    {
        $user = auth()->user();
        //$this->authorize('view', $user->profile);
        //dd($user->profile);
        dd($user);
        return view('instructor/quiz/instructorquizlist', ['user' => $user]);
    }

}