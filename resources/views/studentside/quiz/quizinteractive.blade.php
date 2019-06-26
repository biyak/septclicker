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
                                    <h2> Quiz Name</h2>
                                        <p>Instructor: xxxxx xxxxx Time: xx:xx:xx Weight: xx%</p>
                                        <p> You cannot come back to this question once you have clicked Next.</p>
                                </div>
                        </div>
                    </div>
                </div>

</div>
<!-- The Quiz itself-->
<div class = "container">
    <div class="jumbotron">
        <div class="row">
                <div class="col-md-8">

                        <div class="quiz-container">
                            <div id="quiz"> </div>
                        </div>

                        <div id="results"></div>
                </div>
            </div>
    </div>           
</div>     

<!-- Button trigger modal -->

    
<!-- jQuery first, then Popper.js, then Bootstrap JS -->
<script src="http://code.jquery.com/jquery-1.11.0.min.js"></script>
<script src="//netdna.bootstrapcdn.com/bootstrap/3.1.1/js/bootstrap.min.js"></script>



<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.0/jquery.min.js"></script>
    
<script src="js/quiz/StudentClickQuiz.js"> </script>
    <!-- Optional JavaScript -->
    
</body>
@endsection