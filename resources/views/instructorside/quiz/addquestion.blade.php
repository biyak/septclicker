@extends('layouts.app')

@section('content')
<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!--<script src="https://code.jquery.com/jquery-3.4.1.min.js" integrity="sha256-CSXorXvZcTkaix6Yvo6HppcZGetbYMGWSFlBw8HfCJo=" crossorigin="anonymous"></script>-->
    <script src="https://code.jquery.com/jquery-3.4.1.js" integrity="sha256-WpOohJOqMqqyKL9FccASB9O0KwACQJpFTUBLTYOVvVU=" crossorigin="anonymous"></script>

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
  </head>


  <body>

    <!--Heading and Menu-->


   <div class="container whiteTxt pb-4 pt-5">
    <div class="jumbotron">
    <div class= "row"> 
                                <div class="col-md-8">
                                    <h1> {{$quiz->quiz_name}} </h1>
                                        <p>Instructor: {{$quiz->user->name}} </p>
                                        <p> Weight: {{$quiz->quiz_weight}}%</p>
                                </div>
                        </div>
    <div><h2>Create Question</h2></div>
 


        <form action="/{{$quiz->id}}/question" method="post" enctype="multipart/form-data">
        @csrf
            <div class="items whiteTxt" style="padding-bottom:20px" id="questionsCont">

            <input type="hidden" value="{{$quiz->id}}" name="quiz_id">
                
                <!--The following button is for testing and debugging purposes only
                <button type="button" class="btn btn-default test2-btn" data-testBtnId="1">Add Q2 Type</button>-->
        
                <div id="questionsCont"> 
                    <div class="form-group row">
                        <label class="col-2 col-form-label text-center">Time Limit (Min)</label>
                        <div class="col-3">
                            <input class="form-control" type="number" placeholder="Allowed time (seconds)" name="timelimit">
                        </div>
                    </div>
    
                    <div class="row pb-3">
                        <label for="image" class="col-2 col-form-label text-center">Add Image</label>
                        <input type="file" class="col-4 form-control-file" name="image" accept="image/*">
                    </div>
                    
                    <div id="typeCont">
                        
                        <div class="form-group row">
                            <label class="col-2 col-form-label text-center">Question</label>
                            <div class="col-9">
                                <input class="form-control" type="text" name="question_text">
                            </div>
                        </div>
            
                        <div class="form-group row" style="padding-top:10px; padding-bottom:10px">
                            <label class="col-2 col-form-label text-center">A</label>
                            <div class="col-9">
                                <input class="form-control" type="text" placeholder="Option A" name="option_a">
                            </div>
                        </div>
            
                        <div class="form-group row" style="padding-bottom:10px">
                            <label class="col-2 col-form-label text-center">B</label>
                            <div class="col-9">
                                <input class="form-control" type="text" placeholder="Option B" name="option_b">
                            </div>
                        </div>
            
                        <div class="form-group row" style="padding-bottom:10px">
                            <label class="col-2 col-form-label text-center">C</label>
                            <div class="col-9">
                                <input class="form-control" type="text" placeholder="Option C" name="option_c">
                            </div>
                        </div>
            
                        <div class="form-group row" style="padding-bottom:10px">
                            <label class="col-2 col-form-label text-center">D</label>
                            <div class="col-9">
                                <input class="form-control" type="text" placeholder="Option D" name="option_d">
                            </div>
                        </div>
            
                        <div class="form-group row" style="padding-bottom:10px">
                            <label class="col-2 col-form-label text-center">E</label>
                            <div class="col-9">
                                <input class="form-control" type="text" placeholder="Option E" name="option_e">
                            </div>
                        </div>

                        <div class="form-group row" style="padding-bottom:10px">
                            <label class="col-2 col-form-label text-center">Answer</label>
                            <div class="col-3">
                                <input class="form-control" max-length="1" type="text" placeholder="Correct Option" pattern="[ABCDEabcde]" name="question_ans">
                            </div>
                            <div class="col-7">
                                    <p>Enter one letter from a-e that represents the correct option</p>
                            </div>
                        </div>
                        
                        <div align="center">
                            <input class="form-control" type="checkbox" id="testbankadd" name="testbankadd" value="yes" >
                            <label for="testbankadd">Add question to test bank</label><br><br>
                        </div>
                    </div>
                </div>



            <div align="right" >
            <a href="../../instructorhome"> <button type="button" class="btn btn-secondary" id="saveExitBtn">Exit Quiz</button> </a>
            <button type="Submit" class="btn btn-success" id="saveAddQBtn">Save Question</button>
            <a href='../../q/{{$quiz->id}}'> <button type="button"class="btn btn-primary"> Review Quiz </button> </a>
            </div>
        </form>
    </div>
    </div>
    

    
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>


  </body>
@endsection