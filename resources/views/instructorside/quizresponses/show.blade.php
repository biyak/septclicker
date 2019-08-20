@extends('layouts.app')

@section('content')
            
<body>

            
            <div class = "container">
                    <div class = "jumbotron"> 
                        <div class= "row"> 
                                <div class="col-md-8">
                                    <h2> {{$quiz->quiz_name}} </h2>
                                        <p>Instructor: {{$quiz->user->name}} </p>
                                        <p> Weight: {{$quiz->quiz_weight}}%</p>
                                        <p> Refresh to see more responses. </p> 
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
@foreach($question -> submittedquestion as $question)
    <div > 
        <!-- <a href="/{{$quiz->id}}/question/{{$question->id}}/edit" > -->
        {{$question -> user_id}} has answered {{$question -> selected_answer}}       
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
<a href = "/q/{{$quiz->id}}"> <button type="button" class="btn btn-primary" > 
                
                Back to Questions
           </button> </a> 
</div>
</div>
    
<!-- jQuery first, then Popper.js, then Bootstrap JS -->
<script src="http://code.jquery.com/jquery-1.11.0.min.js"></script>
<script src="//netdna.bootstrapcdn.com/bootstrap/3.1.1/js/bootstrap.min.js"></script>



<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.0/jquery.min.js"></script>
    

    
</body>
@endsection