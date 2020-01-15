<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
require_once __DIR__ . "/../../TimeUtils.php";

class ActiveQuizController extends Controller
{
    private function attemptedQuiz(\App\Quiz $quiz){
        $student = auth()->user();
        $attempts = $quiz->attempts()->where('student_id',$student->id)->get();
        return sizeof($attempts) > 0;
    }

    private function mayEnterQuiz(\App\Quiz $quiz){
        // Check for existing attempts
        $student = auth()->user();
        $attempts = $quiz->attempts()->where('student_id',$student->id)->get();

        // If the user has attempted this quiz, check if they're allowed back into the quiz.
        if (sizeof($attempts) > 0){
            $attempt = $attempts[0];
            if ($attempt->finalized){
                // The user submitted, they shall not enter.
                return false;
            } else if ($quiz->timelimit != null && getTimestampDifference($attempt->attempt_begin) > 60 * $quiz->timelimit) {
                // Gets the unix timestamp, aligns it to EST (this is how Laravel will store timestamps), and compares it against the quiz limit
                // If we're past the time limit, we're also expireds
                return false;
            } else {
                // The user did not submit and they're still within their time limit - we want to let them back into the quiz
                return  true;
            }
        }
    }

    public function __construct()
    {
        $this->middleware('auth');
    }

    public function show(\App\Quiz $quiz){
        return view('studentside.quiz.show', compact('quiz'));
    }

    // Logic for the confirmation page before launching a quiz
    public function showConfirmation(\App\Quiz $quiz){
        // Get the quiz's creator
        $creator = $quiz->user()->first();

        // Whether the user is eligible to enter the quiz
        $mayEnter = $this->mayEnterQuiz($quiz);

        // If the user already has a running attempt and may enter, redirect them into the quiz
        if ($this->attemptedQuiz($quiz) && $mayEnter){
            return redirect("/active/" . $quiz->id . "/show");
        }
        $data = ['instructorName' => $creator->name,
            'expired' => !$mayEnter];
        return view('studentside.quiz.confirm', compact('quiz') + $data + compact('attempts'));
    }

    // This endpoint marks the quiz as started for the user, then redirects them to the quiz
    public function launchQuiz(\App\Quiz $quiz){
        if ($this->attemptedQuiz($quiz)){
            // The user should not be able to get here if they already have an attempt in progress...
            return abort(403,"Don't do that");
        }

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
