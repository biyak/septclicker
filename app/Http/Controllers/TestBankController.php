<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;

class TestBankController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {

        $instructor = auth()->user()->id;

        $questions = DB::select('select * from questions left join test_bank on questions.id = test_bank.question_id where test_bank.instructor_id = ?',array($instructor));

        return view('instructorside/quiz/testbank/testbank',compact('questions'));
    }
}
