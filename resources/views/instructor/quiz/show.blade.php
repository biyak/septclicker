@extends('layouts.app')

@section('content')
<style>
        .jumbotron{
            background-color: #fff;
            color: black;
            padding: 5px;
        }
    </style>
        <head>
                <title>Quiz</title>
                <!-- Required meta tags -->
                <meta charset="utf-8">
                <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
            
                <!-- Bootstrap CSS -->
                <style>
                    body {
                        background-color: #cccccc;
                    }
            
                    .jumbotron {
                        background-color: #d1d3d3
                    }
            
                    .card-img-top {
                        width: 100%;
                        height: 14.85rem;
                        object-fit: cover;
                    }
                    #logo {
                        height: 50px;
                        
                    }


                    .hidden {
                        display:none;
                    }
                </style>
            
            
                <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css"
                    integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
            
            </head>
            
<body>

            
            <div class = "container">
                    <div class = "jumbotron"> 
                        <div class= "row"> 
                                <div class="col-md-8">
                                    <h2> {{$quiz->quiz_name}} </h2>
                                        <p>Instructor: {{$quiz->user->name}} </p>
                                        <p> Weight: {{$quiz->quiz_weight}}%</p>
                                        <p> You cannot come back to this question once you have clicked Next.</p>
                                </div>
                        </div>
                    </div>
                </div>

</div>
<div class = "container">
    <div class="jumbotron">
    <div class="col-md-8">
<!-- The Quiz itself-->
@foreach($quiz -> tfquestion as $question)
            
            <h3> Question</h3>
            <div class="question"> <b> {{$question->question_text}}</b> </div>

            <label>
                <input type="radio" name="q" value="v">
                  True
              </label>
              <label>
                <input type="radio" name="q" value="v">
                  False
              </label>
                    <br>
                    <br>

@endforeach
</div>
</div>           
</div> 
<!-- Button trigger modal -->

    
<!-- jQuery first, then Popper.js, then Bootstrap JS -->
<script src="http://code.jquery.com/jquery-1.11.0.min.js"></script>
<script src="//netdna.bootstrapcdn.com/bootstrap/3.1.1/js/bootstrap.min.js"></script>



<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.0/jquery.min.js"></script>
    

    
</body>
@endsection