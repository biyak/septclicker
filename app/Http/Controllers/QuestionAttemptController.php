<?php

namespace App\Http\Controllers;
require_once __DIR__ . "/../../TimeUtils.php";

use App\QuestionAttempt;
use Illuminate\Http\Request;

class QuestionAttemptController extends Controller {
    public function __construct()
    {
        $this->middleware("auth");
    }

    // Quick function to return JSON errors
    private function error($code, $message){
        return [
            'success' => false,
            'code' => $code,
            'message' => $message
        ];
    }

    // Non-final submission endpoint - this is used to save progress in case the user's browser crashes or they run out of time
    public function submitAnswer(\App\Question $question, string $answer, int $clientTime){
        // Get the quiz this question belongs to
        $quiz = $question->quiz()->first();
        // Get the student
        $student = auth()->user();
        // Get the quiz attempt for this user
        $attempts = $quiz->attempts()->where('student_id', $student->id)->get();
        // Check that we have an active attempt
        if (sizeof($attempts) === 0){
            return $this->error(1, "User has not yet attempted this quiz");
        }
        $attempt = $attempts[0];
        // Check that this attempt is not yet final
        if ($attempt->finalized){
            return $this->error(2, "User has already submitted this quiz");
        }
        // Check that we are not yet out of time to submit this quiz
        if ($quiz->timelimit !== null && getTimestampDifference($attempt->attempt_begin) > $quiz->timelimit * 60){
            return $this->error(3, "User has run out of time for this quiz");
        }
        // We've validated that the student is in a good state to submit to the quiz, now we need to check for issues with the question
        // Get the question attempt - it must exist at this point.

        $question_attempts = $question->attempts()->where('student_id',$student->id)->get();
        if (sizeof($question_attempts) === 0){
            return $this->error(4, "The question attempt does not exist");
        }

        $question_attempt = $question_attempts[0];

        if ($question_attempt->finalized){
            return $this->error(5, "User has already submitted this question");
        }

        if ($clientTime < $question_attempt->client_timestamp){
            return $this->error(6, "A more recent submission exists on the server");
        }

        if ($answer !== 'a' && $answer !== 'b' && $answer !== 'c' && $answer !== 'd' && $answer !== 'e'){
            // There's no way this came from our frontend - say hi to the hacker!
            return $this->error(7, "User should spend more time answering questions and less time forging requests!");
        }

        // Build a table of allowed answers to avoid a five-way conditional
        $allowedAnswers = [
            'a' => $question->option_a !== null,
            'b' => $question->option_b !== null,
            'c' => $question->option_c !== null,
            'd' => $question->option_d !== null,
            'e' => $question->option_e !== null
        ];

        if ($allowedAnswers[$answer] === false) {
            return $this->error(8, "The chosen answer is not a valid option for this question");
        }

        // Check that the time limit for the question has not expired if it exists
        if ($question->timelimit !== null && getTimestampDifference($question_attempt->attempt_begin) > $question->timelimit){
            return $this->error(9, "User has run out of time for this question");
        }

        // Amazingly, nothing has gone wrong! Update the attempt with the selected answer and save.
        $question_attempt->selected_answer = $answer;
        // Note: I'm fully aware that the user can effectively DoS themselves by sending a really large number here and then being unable to submit in the future
        // However, there's no easy way to check this because we don't know if the server and client's clocks are in sync
        // TL;DR: If a user breaks their quiz by sending fraudulent input, we leave it as an exercise to the user to fix it.
        $question_attempt->client_timestamp = $clientTime;
        $question_attempt->save();

        return abort(403, $answer);
    }
}
