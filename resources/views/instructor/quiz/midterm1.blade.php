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
                </style>
            
            
                <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css"
                    integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
            
            </head>
            
<body>

<!-- Quiz info header-->
<div class = "container">
        <div class = "jumbotron"> 
            <div class= "row"> 
                    
                    <div class="col-md-8">
                        <h2>Quiz Name</h2>
                            <p>Instructor: xxxxx xxxxx Time: xx:xx:xx Weight: xx%</p>
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
                        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal">
                                Submit
                        </button>

                        <div id="results"></div>
                </div>
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

    <script  src="js/quiz/quiz.js"> </script>
    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="http://code.jquery.com/jquery-1.11.0.min.js"></script>
    <script src="//netdna.bootstrapcdn.com/bootstrap/3.1.1/js/bootstrap.min.js"></script>

</body>

@endsection