<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class SubmittedQuestionController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function live(\App\Quiz $quiz, \App\Question $question){
        return view('instructorside/quiz/question/live', compact('quiz', 'question'));
    }

    public function store(\App\Quiz $quiz, \App\Question $question){

        $data = request()->validate([
            'user_id' => '',
            'question_id' => '',
            'selected_answer' => '',

        ]);

        $submitted = auth()->user()->submittedquestion()->create($data);

        //dd($submitted);
        return redirect($quiz->id.'/question' . '/'.$question->id .'/responses');
    }

    public function show(\App\Quiz $quiz, \App\Question $question){
        if ($quiz->user_id !== auth()->user()->id){
            return abort(403, "Results are only visible to the creating instructor");
        }
        return view('instructorside.quizresponses.questionresponses', compact('quiz', 'question'));
    }

}
