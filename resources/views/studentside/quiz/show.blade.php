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
        @if(!$quiz->singular_questions)
@foreach($quiz -> question as $question)
    <div >
    <form action="/active" method="post" enctype="multipart/form-data">
        @csrf

        <input type="hidden" value="{{$quiz->id}}" name="quiz_id">
        <input type="hidden" value="{{Auth::user()->id}}" name="student_id">
        <input type="hidden" value="{{$question->id}}" name="question_id">
    <h3> Question {{$num}}</h3>
            <div > <b> {{$question->question_text}}</b> </div>


                @if ($question->option_a !== null)
                    <p>
                 <input type="radio" id="{{$num}}-option_a" qid="{{$question->id}}" name="answer{{$num}}" value="option_a" {{$answers[$question->id] === 'a' ? "checked" : ""}}/>
                    <label for="{{$num}}-option_a">{{$question->option_a}}</label>
                    </p>
                @endif

                @if ($question->option_b !== null)
                    <p>
                 <input type="radio"  id="{{$num}}-option_b" qid="{{$question->id}}"  name="answer{{$num}}"  value="option_b" {{$answers[$question->id] === 'b' ? "checked" : ""}}/>
                <label for="{{$num}}-option_b">{{$question->option_b}}</label>
                    </p>
                @endif

                @if ($question->option_c !== null)
                    <p>
                 <input type="radio" id="{{$num}}-option_c" qid="{{$question->id}}"  name="answer{{$num}}"  value="option_c" {{$answers[$question->id] === 'c' ? "checked" : ""}}/>
                <label for="{{$num}}-option_c">{{$question->option_c}}</label>
                    </p>

                @endif

                @if ($question->option_d !== null)
                    <p>
                 <input type="radio" id="{{$num}}-option_d" qid="{{$question->id}}"  name="answer{{$num}}" value="option_d" {{$answers[$question->id] === 'd' ? "checked" : ""}}>
                <label for="{{$num}}-option_d">{{$question->option_d}}</label>
                    </p>

                @endif

                @if ($question->option_e !== null)
                    <p>
                 <input type="radio" id="{{$num}}-option_e" qid="{{$question->id}}"  name="answer{{$num}}" value="option_e" {{$answers[$question->id] === 'e' ? "checked" : ""}}/>
                <label for="{{$num}}-option_e">{{$question->option_e}}</label>
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
            @else
                @php($num = 1)
                <p>This quiz only allows you to answer one question at a time. Some of these questions may be timed, the time will start ticking when you open the question. After you submit a question, you can review it here, but you cannot change your answer</p>
                @foreach($quiz -> question as $question)
                    @if($attempts[$question->id] === 0)
                        <h3>Question {{$num}}</h3>
                        <p>You have not attempted this question yet. Click here to begin your attempt.</p>
                        @if ($question->timelimit > 0)
                            <p><b>Note: This question has a time limit of {{$question->timelimit}} seconds</b></p>
                        @endif
                    @endif
                    @php($num++)
                @endforeach
            @endif

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

    <script>
        $(document).ready(() => {
            $("input[type='radio']").click(e => {
                const qid = e.target.getAttribute("qid");
                const answer = e.target.value.substring(7);
                console.log(qid + ": " + answer)
                $.get("/ajax/submitanswer/" + qid + "/" + answer + "/" + Math.floor(Date.now() / 1000))
            })
        })

    </script>

</body>

@endsection
