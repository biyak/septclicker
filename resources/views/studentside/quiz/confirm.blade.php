@extends('layouts.app')

@section('content')



<body>
    <div class = "container">
        <div class = "jumbotron">
            <div class= "row">
                <div class="col-md-8">
                    @if($expired === false)
                        <h2> Starting quiz </h2>
                        <p>Please confirm that you wish to start the following quiz:</p>
                        <p>Quiz name: {{$quiz->quiz_name}}</p>
                        <p>Course: TODO, WE DON'T HAVE ANY CONCEPT OF COURSES YET</p>
                        <p>Instructor: {{$instructorName}}</p>
                        <p>Time limit: {{$quiz->timelimit === null ? "None, you may submit this quiz as long as it remains open" : $quiz->timelimit + " minutes"}}</p>
                        <p>Upon clicking "Start quiz", you will have until the mentioned time limit to complete and submit the quiz. If you experience technical issues, you may re-enter this quiz as long as you still have time remaining.</p>

                        <p>If you click "Go back" your attempt will not be consumed and you may choose to start the quiz at a later time.</p>

                        <a href="/studentquizlist/1"><button class="btn">Go back</button></a>
                        <a href="/active/{{$quiz->id}}/confirmlaunch"><button class="btn btn-primary float-right">Start quiz</button></a>
                    @else
                        <h2>Already Submitted</h2>
                        <p>You have already submitted this quiz, and may not attempt it again. If your instructor has allowed for it, you may view your results on the quiz results page.</p>
                        <a href="/studentquizlist/1"><button class="btn">Go back</button></a>
                    @endif
                </div>
            </div>
        </div>
    </div>
</body>

@endsection
