<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class QuestionController extends Controller
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
            'quiz_id' => '',
            'option_a' => '',
            'option_b' => '',
            'option_c' => '',
            'option_d' => '',
            'option_e' => '',
            
        ]);
        //Takes the quiz we are working on tht was passed into the create function
        //Create a new question object with question()
        //And add the data to the new question for the quiz we're working on
        $quiz->question()->create($data);
        return view('instructorside.quiz.addquestion', compact('quiz'));
    }

    public function edit(\App\Quiz $quiz, \App\Question $question){
        return view('instructorside/quiz/question/edit', compact('quiz', 'question'));
    }

    // public function show(\App\Quiz $quiz){
    //     return view('instructorside.quiz.addquestion', compact('quiz'));
    // }

    public function update(\App\Question $question){
        $data = request()->validate(
            ['question_text' => '',
            'question_ans' => '',
            'image' => '',
            'quiz_id' => '',
            'option_a' => '',
            'option_b' => '',
            'option_c' => '',
            'option_d' => '',
            'option_e' => '',
            ]
        );

        $question-> update($data);

        //auth()->user()->quiz()->update($data);

        //dd(auth()->user()->quiz->where('id',$quiz->id));

        //return redirect('instructorquizlist/'. auth()->user()->id);
        //return redirect('question');
    }
}
