@extends('layouts.app')

@section('content')

<body>


            <div class = "container">
                    <div class = "jumbotron">
                                <div class="col-md-8">
                                  <div class="row-title" >
                                    <h2 style="display:inline;"> {{$quiz->quiz_name}} is
                                      @if ($active == 1)
                                    <b>  ACTIVE </b>
                                      @else
                                    <b>  INACTIVE </b>
                                      @endif
                                    </h2>
                                </div>

                                        <p>Instructor: {{$quiz->user->name}} </p>
                                        <p> Weight: {{$quiz->quiz_weight}}%</p>
                                        <p> Total number of students attended: {{count($results)}}</p>
                                        <p> Refresh to see more responses. </p>


                                </div>
                                @if ($active == 1)
                                <form method="post" action="" style="text-align:right;display:inline-block;">
                                  @csrf
                                  <input type="submit" class="btn btn-danger" name="stop_button" value="Stop Quiz"/>
                                </form>
                                @endif
                                @if ($active == 0)
                                <form method="post" action="" style="text-align:right;display:inline-block;">
                                  @csrf
                                <input type="submit" class="btn btn-primary" name="start_button" value= "Start Quiz"/>
                                @endif
                              </form>
                              <a href ='responses/result' > <button type="button" class="btn btn-warning" >
                                  See Results
                              </button>
                              </a>
                    </div>
                </div>

</div>

@php
$num=1
@endphp


</div>
</div>
</div>
<div class = "container">
    <div class="jumbotron">
    <div class="col-md-8" style="max-width:100%;">
@foreach($quiz -> question as $question)
    <div >
            <div style="display:inline-block;"><h3> Question {{$num}}</h3> </div>
          <div>
            <div class="question"> <b> {{$question->question_text}}</b> </div>
            @if ($question->image !== null)
            <img src="/storage/{{$question->image}}" width="150" height = "100" style="border:2px solid black">
            @endif

          <div style="display:inline-block;">
            @if ($question->option_a !== null)
            <p>
                    a) {{$question->option_a}}

            </p>
            @endif

            @if ($question->option_b !== null)
                <p>
                    b) {{$question->option_b}}
                </p>
            @endif

            @if ($question->option_c !== null)
                <p>
                    c) {{$question->option_c}}
                </p>
                @endif

            @if ($question->option_d !== null)
                <p>
                    d) {{$question->option_d}}
                </p>

                @endif

                @if ($question->option_e !== null)
                <p>
                    e) {{$question->option_e}}
                </p>
                @endif
            <p>
                Correct answer: {{$question->question_ans}}
            </p>
          </div>
            <div class="box">
              <div class="body">
                {!! $charts[$question->id]->html() !!}
              </div>
            </div>
            {!! Charts::scripts() !!}
            {!! $charts[$question->id]->script() !!}
                    <br>
                    <br>
        </div>
      </div>
@php
$num++
@endphp
@endforeach
</div>
</div>
</div>

<!-- Button trigger modal -->
<div class="container">
<div class ="jumbotron">
<a href = "/instructorquizlist/{{auth::user()->id}}"> <button type="button" class="btn btn-primary" >

                Back to Quizzes
           </button> </a>
    <a href = "/q/{{$quiz->id}}/edit"> <button type="button" class="btn btn-primary float-right" >

            Edit Quiz
        </button> </a>
</div>

</div>

<!-- jQuery first, then Popper.js, then Bootstrap JS -->
<script src="http://code.jquery.com/jquery-1.11.0.min.js"></script>
<script src="//netdna.bootstrapcdn.com/bootstrap/3.1.1/js/bootstrap.min.js"></script>



<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.0/jquery.min.js"></script>



</body>
@endsection
