<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class NewQuizController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    } 

    public function create(){
        return view('instructorside/quiz/create');
    }

    public function store(){

        $data = request()->validate([
            'quiz_name' => 'required',
            'quiz_weight' => 'required'
        ]);
        //need to get authenticated user
        auth()->user()->newquiz()->create($data); 

        //dd(request()->all());

        return redirect('instructorquizlist'); //. auth()->user()->id
    }
}
