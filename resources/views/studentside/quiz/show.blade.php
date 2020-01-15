@extends('layouts.app')

@section('content')

<body>

<!-- Quiz info header-->
<div class = "container">
        <div class = "jumbotron">
            <div class= "row">
                <div class="col-md-8">
                    <h2>{{$quiz->quiz_name}}</h2>
                    <p>Instructor: {{Auth::user()->name}}</p>
                    <p>Weight: {{$quiz->quiz_weight}}%</p>
                    <p id="timer"></p>
                </div>
            </div>
        </div>
    </div>

</div>
<!-- The Quiz itself-->
<div class = "container">
    <div class="jumbotron">
@php
$num=1
@endphp
@foreach($quiz -> question as $question)
    <div >
    <form action="/active" method="post" enctype="multipart/form-data">
        @csrf

        <input type="hidden" value="{{$quiz->id}}" name="quiz_id">
        <input type="hidden" value="{{Auth::user()->id}}" name="student_id">
        <input type="hidden" value="{{$question->id}}" name="question_id">
    <h3> Question {{$num}}</h3>
            <div > <b> {{$question->question_text}}</b> </div>

            <label>


                @if ($question->option_a !== null)
                 <p> <input type="radio" name="answer{{$num}}" value="option_a">
                {{$question->option_a}}
                 </p>
                @endif

                @if ($question->option_b !== null)
                 <p> <input type="radio" name="answer{{$num}}"  value="option_b">
                {{$question->option_b}}
                 </p>
                @endif

                @if ($question->option_c !== null)
                 <p> <input type="radio" name="answer{{$num}}"  value="option_c">
                {{$question->option_c}}
                 </p>
                @endif

                @if ($question->option_d !== null)
                 <p> <input type="radio" name="answer{{$num}}" value="option_d">
                {{$question->option_ad}}
                 </p>
                @endif

                @if ($question->option_e !== null)
                 <p> <input type="radio" name="answer{{$num}}" value="option_e">
                {{$question->option_e}}
                 </p>
                @endif


                    <br>
                    <br>
        </div>
        <form>
@php
$num++
@endphp
@endforeach

    <button type="submit" class="btn btn-primary" >

                Submit
           </button> </a>
    </div>



</div>
</div>

<!-- Button trigger modal -->


      <!-- Modal -->
      <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="exampleModalLabel">Are you sure you want to submit?</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
              ~ Review of their input ~
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-secondary" data-dismiss="modal">Review Answers</button>
              <a href = "../StudentSubmit/studentsubmit.html"> <button type="button" class="btn btn-primary" >

                    Submit Quiz
               </button> </a>
            </div>
          </div>
        </div>
      </div>

    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="http://code.jquery.com/jquery-1.11.0.min.js"></script>
    <script src="//netdna.bootstrapcdn.com/bootstrap/3.1.1/js/bootstrap.min.js"></script>

    @if ($endtime !== null)
        <script>

            const padNumber = function(num){
                const stringified = num + "";
                return stringified.length === 2 ? stringified : "0" + stringified;
            }

            const formatTime = function(time) {
                const seconds = time % 60;
                const minutes = Math.floor(time / 60) % 60
                const hours = Math.floor(Math.floor(time / 60) / 60);

                return padNumber(hours) + ":" + padNumber(minutes) + ":" + padNumber(seconds)
            }

            const updateTime = function() {
                let timeDifference = {{$endtime}} - Math.floor(Date.now()/1000);
                if (timeDifference > 0) {
                    $("#timer").text("Time remaining: " + formatTime(timeDifference));
                    setTimeout(updateTime, 1000);
                } else {
                    // TODO: Once we have a submission endpoint working, use it
                    alert("Hi this really should auto submit");
                }
            };

            updateTime();
        </script>
    @endif

</body>

@endsection
