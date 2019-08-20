@extends('layouts.app')

@section('content')
<div class = "container">
                    <div class = "jumbotron"> 
                        <div class= "row"> 
                                <div class="col-md-8">
                                    <h2> {{$quiz->quiz_name}} </h2>
                                        <p>Instructor: {{$quiz->user->name}} </p>
                                        <p> Weight: {{$quiz->quiz_weight}}%</p>
                                        <p> You cannot come back to this question once you have clicked Submit Answer.</p>
                                </div>
                        </div>
                    </div>
                </div>

</div>
<div class = "container">
    <div class="jumbotron">
    <div class="col-md-8">

<!-- The Quiz itself-->
<form action="/{{$quiz->id}}/question/{{$question->id}}" method="post" enctype="multipart/form-data">
@csrf
<input type="hidden" value="{{$question->id}}" name="question_id">
<input type="hidden" value="{{Auth::user()->id}}" name="user_id">
            
            <div class="question"> <b> {{$question->question_text}}</b> </div>

            @if ($question->image !== null)
                <img src="/storage/{{$question->image}}" width="150" height = "100" style="border:2px solid black">
            @endif
<p>
            @if ($question->option_a !== null)
            <input type="radio" name="selected_answer" value="a">
            a) {{$question->option_a}}
              </label>
            @endif
            </p>
            <p>

            @if ($question->option_b !== null)
            <input type="radio" name="selected_answer" value="b">
            b) {{$question->option_b}}
              </label>
            @endif
            </p>
            <p>
            @if ($question->option_c !== null)
            <input type="radio" name="selected_answer" value="c">
            c) {{$question->option_c}}
              </label>
            @endif
            </p>
            <p>
            @if ($question->option_d !== null)
            <input type="radio" name="selected_answer" value="d">
            d) {{$question->option_d}}
              </label>
            @endif
            </p>
            <p>
            @if ($question->option_e !== null)
            <input type="radio" name="selected_answer" value="e">
            e) {{$question->option_e}}
              </label>
            @endif
            </p>
            <p>
            <br>
            <button type="submit" class="btn btn-primary" > 
                
                Submit Answer
           </button> 
            </p>
            </form>


</div>
</div>           
</div> 

    
<!-- jQuery first, then Popper.js, then Bootstrap JS -->
<script src="http://code.jquery.com/jquery-1.11.0.min.js"></script>
<script src="//netdna.bootstrapcdn.com/bootstrap/3.1.1/js/bootstrap.min.js"></script>



<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.0/jquery.min.js"></script>
    

@endsection