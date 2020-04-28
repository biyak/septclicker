<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\SubmittedQuestion;
use Charts;
use DB;
use Excel;
use Maatwebsite\Excel\Concerns\FormCollection;

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
            'quiz_weight' => 'required'
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

      $result = DB::table('quizzes')->select('active')->where('id', $quiz -> id)->first();
      $active = $result -> active;

      if ($active==1) {
        return view('instructorside.quiz.show', compact('quiz', 'active'));
      }
      return view('instructorside.quiz.launch', compact('quiz', 'active'));
    }

    public function responses(\App\Quiz $quiz){

        if ($quiz->user_id !== auth()->user()->id){
            return abort(403, "Only the creator of this quiz can view the results");
        }


        $results = array();

        $total = 0;

        // Initialize everyone who attempted the quiz
        foreach($quiz->attempts()->get() as $attempt){
            $results[$attempt->student_id] = 0;
        }

        foreach($quiz->question()->get() as $question){
            $total++;
            foreach($question->attempts()->get() as $attempt){
                if ($attempt->selected_answer === $question->question_ans){
                    $results[$attempt->student_id] += 1;
                }
            }
        }

        $resolvedResults = array();

        foreach($results as $sid => $grade){
            $resolvedResults[\App\User::where('id',$sid)->get()[0]->name] = $grade;
        }

        // Also return an array of questions + ids for use in the detailed view
        $questions = [];

        foreach($quiz->question()->get() as $question){
            $questions[$question->id] = $question->question_text;
        }

        //show chart
        $charts = $this -> getCharts($quiz);
        if(request()->launch_button) {
           $quiz->update(
             ['active'=>1]
           );
        }
        $active =  DB::table('quizzes')->select('active')->where('id', $quiz -> id)->get()[0]->active;
        return view('instructorside/quizresponses/show', ['results' => $resolvedResults, 'total' => $total, 'questions' => $questions] + compact('quiz','charts', 'active'));
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

    private function getCharts($quiz) {
      $charts = [];
      foreach($quiz->question()->get() as $question){
          $sq = DB::table("submitted_questions")->select('selected_answer', DB::raw("COUNT(selected_answer) AS total"))->where("question_id", "=",$question->id)->groupBy("selected_answer")->get();
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

      return $charts;
    }

    public function result(\App\Quiz $quiz){

      if ($quiz->user_id !== auth()->user()->id){
          return abort(403, "Only the creator of this quiz can view the results");
      }

      $results = array();

      $total = 0;

      // Initialize everyone who attempted the quiz
      foreach($quiz->attempts()->get() as $attempt){
          $results[$attempt->student_id] = 0;
      }

      foreach($quiz->question()->get() as $question){
          $total++;
          foreach($question->attempts()->get() as $attempt){
              if ($attempt->selected_answer === $question->question_ans){
                  $results[$attempt->student_id] += 1;
              }
          }
      }

      $resolvedResults = array();

      foreach($results as $sid => $grade){
          $resolvedResults[\App\User::where('id',$sid)->get()[0]->name] = $grade;
      }

      $charts = $this -> getCharts($quiz);
      return view('instructorside.quizresponses.result', ['results' => $resolvedResults, 'total' => $total] + compact('quiz'));
    }

    public function download(\App\Quiz $quiz){
      $results = array();

      $total = 0;

      // Initialize everyone who attempted the quiz
      foreach($quiz->attempts()->get() as $attempt){
          $results[$attempt->student_id] = 0;
      }

      foreach($quiz->question()->get() as $question){
          $total++;
          foreach($question->attempts()->get() as $attempt){
              if ($attempt->selected_answer === $question->question_ans){
                  $results[$attempt->student_id] += 1;
              }
          }
      }

      $resolvedResults = array();

      foreach($results as $sid => $grade){
          $s = \App\User::select('id','name', 'email')->where('id',$sid)->get()[0];
          $resolvedResults[\App\User::select('id')->where('id',$sid)->get()[0]->id] = ['id'=> $s-> id, 'grade'=>round($grade/$total,2), 'name'=> $s->name, 'email'=> $s->email];
      }

      $headers = array(
          "Content-type" => "text/csv"
      );

      $columns = array('student_id', 'student_name', 'student_email', 'grade');

          $name = "result.csv";
          $file = fopen($name, 'w');
          fputcsv($file, $columns);

          foreach($resolvedResults as $sid) {
              fputcsv($file, array($sid['id'], $sid['name'], $sid['email'], $sid['grade']));
          }
          fclose($file);
      return response()->download($name, 'result.csv', $headers);
    }

    public function changeStatus(\App\Quiz $quiz){
      $results = array();

      $total = 0;

      // Initialize everyone who attempted the quiz
      foreach($quiz->attempts()->get() as $attempt){
          $results[$attempt->student_id] = 0;
      }

      foreach($quiz->question()->get() as $question){
          $total++;
          foreach($question->attempts()->get() as $attempt){
              if ($attempt->selected_answer === $question->question_ans){
                  $results[$attempt->student_id] += 1;
              }
          }
      }
      $resolvedResults = array();

      foreach($results as $sid => $grade){
          $resolvedResults[\App\User::where('id',$sid)->get()[0]->name] = $grade;
      }

      $result = DB::table('quizzes')->select('active')->where('id', $quiz -> id)->first();
      $active = $result -> active;
      if(request()->stop_button) {
        $change = request()->stop_button;
      } else if(request()->start_button) {
        $change = request()->start_button;
      } else {
        $change = 0;
      }

      if($result->active == 1 && $change === "Stop Quiz") {
        $quiz -> update(
            ['active' => 0]
        );
        $active = 0;
      } else if ($result->active == 0 && $change === "Start Quiz") {
        $quiz -> update(
            ['active' => 1]
        );
        $active = 1;
      }

      $charts = $this->getCharts($quiz);
      return view('instructorside.quizresponses.show', ['results'=>$resolvedResults]+compact('active','quiz','charts'));
    }

    public function delete(\App\Quiz $quiz){
      $question_id = request()->question_id;
      foreach($quiz -> question() -> get() as $question) {
        if($question->id == $question_id) {
          $question->update(
              ['quiz_id' => 0]
            );
        }
      }
      return view('instructorside.quiz.show', compact('quiz'));
    }
}
