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
        return view('instructor.quiz.addquestion', compact('quiz'));
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
        return view('instructor.quiz.addquestion', compact('quiz'));
    }

    public function edit(\App\Quiz $quiz, \App\TFQuestion $question){
        return view('instructorside/quiz/question/edit', compact('quiz', 'question'));
    }

    // public function show(\App\Quiz $quiz){
    //     return view('instructor.quiz.addquestion', compact('quiz'));
    // }

    public function update(\App\Quiz $quiz, \App\TFQuestion $question){
        $data = request()->validate(
            ['quiz_name' => '',
            'quiz_weight' => '',
            ]
        );

        $quiz-> update($data);

        //auth()->user()->quiz()->update($data);

        //dd(auth()->user()->quiz->where('id',$quiz->id));

        //return redirect('instructorquizlist/'. auth()->user()->id);
        return redirect($quiz->id.'/question/create');
    }
}
