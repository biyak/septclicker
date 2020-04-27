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

        $questions = DB::select('select * from test_bank where instructor_id = ?', array($instructor));

        $questionData = [];

        foreach ($questions as $q){

            $values = DB::select('select * from questions where id = ?', array($q->question_id));

            array_push($questionData,$values);

        }
        
        return view('instructorside/quiz/testbank/testbank',compact('questions','questionData'));
    }
}
