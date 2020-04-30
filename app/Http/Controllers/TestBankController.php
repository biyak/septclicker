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

    public function create()
    {
        $data = request()->validate([
            'qIDs' => 'required'
        ]);
        
        $qArray = $data['qIDs']; 
        #str_split($data['qIDs']);
        
        //foreach($qArray as $q){
          //  $dogs = intVal($q);
        //}

        return view('instructorside/quiz/testbank/createTB', compact('qArray'));
    }

    public function show()
    {
        $data = request()->validate([
            'quiz_name' => 'required',
            'quiz_weight' => 'required',
            'qIDs' => 'required'
        ]);

        //need to get authenticated user
        $quiz = auth()->user()->quiz()->create([
            'quiz_name' => $data['quiz_name'],
            'quiz_weight' => $data['quiz_weight']
        ]);

        $qArray = str_split($data['qIDs']);

        foreach($qArray as $q){
            $qInt = intVal($q);

            //Get the question info from the database
            $info = DB::select('select * from questions where id = ?',array($qInt));

            //Add the question to the quiz
            foreach($info as $info1){
            $quiz->question()->create([
                'question_text' => $info1->question_text,
                'question_ans' => $info1->question_ans,
                'image' => $info1->image,
                'quiz_id' =>  $info1->quiz_id,
                'option_a' => $info1->option_a,
                'option_b' =>  $info1->option_b,
                'option_c' =>  $info1->option_c,
                'option_d' =>  $info1->option_d,
                'option_e' => $info1->option_e,
            ]);}
        }



        //Add the questions to the quiz
        //$quiz->question()->create([
          //  'question_text' => $data['question_text'],
        //    'question_ans' => $data['question_ans'],
        //    'image' => $imagePath,
        //    'quiz_id' =>  $data['quiz_id'],
        //    'option_a' => $data['option_a'],
        //    'option_b' =>  $data['option_b'],
        //    'option_c' =>  $data['option_c'],
        //    'option_d' =>  $data['option_d'],
        //    'option_e' => $data['option_e'],
        //]);
        
        return view('instructorside/quiz/testbank/showTB', compact('quiz'));

    }
}
