@extends('layouts.app')

@section('content')

<body>


            <div class = "container">
                    <div class = "jumbotron">
                        <div class= "row">
                                <div class="col-md-8">
                                    <h2> {{$quiz->quiz_name}} </h2>
                                    <p>Instructor: {{Auth::user()->name}} </p>
                                        <p> Weight: {{$quiz->quiz_weight}}%</p>
                                </div>
                        </div>
                    </div>
                </div>

</div>
<div class = "container">
    <div class="jumbotron">
    <div class="col-md-8">
<!-- The Quiz itself-->
@php
$num=1
@endphp
@foreach($quiz -> question as $question)
    <div > <a href="/{{$quiz->id}}/question/{{$question->id}}/edit" >
            <h3> Question {{$num}}</h3>
            <div class="question"> <b> {{$question->question_text}}</b> </div>

            @if ($question->option_a !== null)
            <p>
                    a){{$question->option_a}}

            </p>
            @endif

            @if ($question->option_b !== null)
                <p>
                    b){{$question->option_b}}
                </p>
            @endif

            @if ($question->option_c !== null)
                <p>
                    c){{$question->option_c}}
                </p>
                @endif

            @if ($question->option_d !== null)
                <p>
                    d){{$question->option_d}}
                </p>

                @endif

                @if ($question->option_e !== null)
                <p>
                    e){{$question->option_e}}
                </p>
                @endif
            <p>
                Correct answer: {{$question->question_ans}}
            </p>
                    <br>
                    <br>
        </a>
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
<a href = "#"> <button type="button" class="btn btn-primary" >

                Launch quiz
           </button> </a>
</div>
</div>

<!-- jQuery first, then Popper.js, then Bootstrap JS -->
<script src="http://code.jquery.com/jquery-1.11.0.min.js"></script>
<script src="//netdna.bootstrapcdn.com/bootstrap/3.1.1/js/bootstrap.min.js"></script>



<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.0/jquery.min.js"></script>



</body>
@endsection
