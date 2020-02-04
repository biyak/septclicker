<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\SubmittedQuestion;
use Charts;
use DB;

class QuizController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }

    public function create(){
        return view('instructorside/quiz/create');
    }

    public function store(){

        $data = request()->validate([
            'quiz_name' => 'required',
            'quiz_weight' => 'required',
            'singular_questions' => 'required'
        ]);
        //need to get authenticated user
        $quiz = auth()->user()->quiz()->create($data);

        //dd($quiz);

        return redirect($quiz->id.'/question/create'); //. auth()->user()->id
    }

    public function show(\App\Quiz $quiz){
        return view('instructorside.quiz.show', compact('quiz'));
    }

    public function edit(\App\Quiz $quiz){
        return view('instructorside/quiz/edit', compact('quiz'));
    }

    public function launch(\App\Quiz $quiz){
        return view('instructorside/quiz/launch', compact('quiz'));
    }

    public function update(\App\Quiz $quiz){
        $data = request()->validate(
            ['quiz_name' => '',
            'quiz_weight' => '',
            ]
        );

        $quiz-> update($data);

        //auth()->user()->quiz()->update($data);

        //dd(auth()->user()->quiz->where('id',$quiz->id));

        //return redirect('instructorquizlist/'. auth()->user()->id);
        return redirect('q/'.$quiz->id);
    }

    public function index(\App\Quiz $quiz) {
      $charts = [];
      foreach($quiz->question()->get() as $question){
          $sq = DB::table("submitted_questions")->select('selected_answer', DB::raw("COUNT(selected_answer) AS total"))->where("question_id", $question->id)->groupBy("selected_answer")->get();
          $chart = Charts::create('bar', 'highcharts')
                      ->title('Statistics')
                      ->labels($sq->pluck('selected_answer'))
                      ->elementLabel('Total')
                      ->values($sq->pluck('total'))
                      ->dimensions(400, 250)
                      ->colors(['red', 'green', 'blue', 'yellow', 'orange', 'cyan', 'magenta'])
                      ->responsive(true);
          $charts[$question->id] = $chart;
      }

        return view('instructorside.quiz.show', compact('charts', 'quiz'));
    }
}
