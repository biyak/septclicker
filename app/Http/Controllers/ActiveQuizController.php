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

        // We haven't even attempted the quiz yet - return true
        return true;
    }

    public function __construct()
    {
        $this->middleware('auth');
    }

    public function show(\App\Quiz $quiz){
        // If we haven't started an attempt or we cannot enter this quiz, return false
        if (!$this->attemptedQuiz($quiz) || !$this->mayEnterQuiz($quiz)){
            return abort(403, "You are not eligible to view this quiz");
        }

        // Calculate the end time based on the quiz's time limit and the user's start time
        $student = auth()->user();
        $attempt = $quiz->attempts()->where('student_id',$student->id)->get()[0];

        // Build the list of saved answers to repopulate the quiz on client re-entry
        $answers = [];
        foreach($quiz->question()->get() as $question){
            $questionAttempt = $question->attempts()->where('student_id',$student->id)->get();
            if (sizeof($questionAttempt) > 0){
                $qAttempt = $questionAttempt[0];
                $answers[$question->id] = $qAttempt->selected_answer;
            }
        }

        // If this is a singular question quiz, also build a list of attempted questions
        $attempts = [];
        // We only care about this if we're in singular mode
        if ($quiz->singular_questions){
            foreach($quiz->question()->get() as $question){
                $attempts[$question->id] = sizeof($question->attempts()->where('student_id', $student->id)->get());
            }
        }

        $endtime = $quiz->timelimit ?  strtotime($attempt->attempt_begin) + $quiz->timelimit * 60 : null;


        return view('studentside.quiz.show', compact('quiz') + ['endtime' => $endtime] + compact('answers') + compact('attempts'));
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

        // TODO: Check that the user is registered in the course this quiz belongs to

        // Create a new attempt for this user
        $attempt = new \App\QuizAttempt;
        $student = auth()->user();
        $attempt->quiz_id = $quiz->id;
        $attempt->student_id = $student->id;
        $attempt->attempt_begin = date_create();
        $attempt->finalized = false;
        $attempt->save();

        if (!$quiz->singular_questions){
            $questions = $quiz->question()->get();
            foreach($questions as $question){
                $qAttempt = new \App\QuestionAttempt;
                $qAttempt->question_id = $question->id;
                $qAttempt->student_id = $student->id;
                $qAttempt->attempt_begin = date_create();
                $qAttempt->finalized = false;
                $qAttempt->client_timestamp = 0;
                $qAttempt->selected_answer = '';
                $qAttempt->save();
            }
        }

        // Redirect the user to their quiz
        return redirect("/active/" . $quiz->id . "/show");

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
