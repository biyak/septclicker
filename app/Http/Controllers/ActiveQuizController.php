<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ActiveQuizController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function show(\App\Quiz $quiz){
        return view('studentside.quiz.show', compact('quiz'));
    }

    public function store(){

        $data = request()->validate([
            'quiz_id' => '',
            'student_id' => '',
            'question_id' => '',
            'answer' => '',

        ]);
        //need to get authenticated user
        $submittedquiz = auth()->user()->submittedquiz()->create($data); 

        dd($submittedquiz);

        //return redirect($quiz->id.'/question/create'); //. auth()->user()->id
    }

}
