<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class TFQuestionController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    } 

    public function create(\App\Quiz $quiz){
        return view('instructorside.quiz.addquestion', compact('quiz'));
    }

    public function store(\App\Quiz $quiz){

        $data = request()->validate([
            'question_text' => 'required',
            'question_ans' => 'required',
            'image' => '',
            'quiz_id' => ''
        ]);
        //need to get authenticated user
        $quiz->tfquestion()->create($data);
        return view('instructorside.quiz.addquestion', compact('quiz'));
    }


    // public function show(\App\Quiz $quiz){
    //     return view('instructorside.quiz.addquestion', compact('quiz'));
    // }
}
