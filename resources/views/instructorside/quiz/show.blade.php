@extends('layouts.app')

@section('content')

<body>


            <div class = "container">
                    <div class = "jumbotron">
                        <div class= "row">
                                <div class="col-md-8">
                                    <h2> {{$quiz->quiz_name}}</h2>
                                        <p>Instructor: {{$quiz->user->name}} </p>
                                        <p> Weight: {{$quiz->quiz_weight}}%</p>
                                        <p> Select questions to update or add more questions: </p>

                                        <a href ='../{{$quiz->id}}/question/create' > <button type="button" class="btn btn-primary" >
                                            Add Questions
                                            </button>
                                        </a>
                                </div>
                        </div>
                    </div>
                </div>

</div>
<div class = "container">
    <div class="jumbotron">
    <div class="col-md-8" style="max-width:100%;">
<!-- The Quiz itself-->
@php
$num=1
@endphp
@foreach($quiz -> question as $question)
    <div >
            <div style="display:inline-block;"><h3> Question {{$num}}</h3> </div>
            <div class="buttons" style="float:right;">
              <a href="/{{$quiz->id}}/question/{{$question->id}}/edit" ><button type="button" class="btn btn-light">Edit</button></a>
              <form action="" method="post" style="display:inline-block;">
                 @csrf
                 <input type="hidden" name="question_id" value={{$question->id}} />
                 <input type="submit" class="btn btn-danger" name="delete_question" value="Delete" onclick="return confirm('Are you sure to delete the question?');"/>
              </form>
            </div>
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
            <p style="color:blue;">
                <b>Correct answer: {{$question->question_ans}} </b>
            </p>
            <br>
            <br>
          </div>
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

<a href = "{{$quiz->id}}/responses"> <button type="button" class="btn btn-primary">

                Go back to quiz
           </button> </a>
</div>
</div>

<!-- jQuery first, then Popper.js, then Bootstrap JS -->
<script src="http://code.jquery.com/jquery-1.11.0.min.js"></script>
<script src="//netdna.bootstrapcdn.com/bootstrap/3.1.1/js/bootstrap.min.js"></script>



<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.0/jquery.min.js"></script>



</body>
@endsection
