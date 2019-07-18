@extends('layouts.app')

@section('content')
<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="Create_Quiz_Form.css">
    <!--<script src="https://code.jquery.com/jquery-3.4.1.min.js" integrity="sha256-CSXorXvZcTkaix6Yvo6HppcZGetbYMGWSFlBw8HfCJo=" crossorigin="anonymous"></script>-->
    <script src="https://code.jquery.com/jquery-3.4.1.js" integrity="sha256-WpOohJOqMqqyKL9FccASB9O0KwACQJpFTUBLTYOVvVU=" crossorigin="anonymous"></script>

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
  </head>


  <body>

    <!--Heading and Menu-->

    <div class="container whiteTxt pb-4 pt-5"><h1>Create Question</h1></div>
    <div class="jumbotron">


        <form action="/{{$quiz->id}}/question" method="post" enctype="multipart/form-data">
        @csrf
            <div class="items whiteTxt" style="padding-bottom:20px" id="questionsCont">

            <input type="hidden" value="{{$quiz->id}}" name="quiz_id">
                
                <!--The following button is for testing and debugging purposes only
                <button type="button" class="btn btn-default test2-btn" data-testBtnId="1">Add Q2 Type</button>-->
        
                <div class="container" id="question1Container">
                    
                    <div class="form-group row pb-2">
                        <label class="col-2 col-form-label">Time Limit</label>
                        <div class="col-3">
                            <input class="form-control" type="number" placeholder="Allowed time (seconds)" name="timeLimit1">
                        </div>
                    </div>
    
                    <div class="row pb-2">
                        <label for="image" class="col-2 col-form-label">Add Image</label>
                        <input type="file" class="col-4 form-control-file" name="image">
                    </div>
                    
                    <div class="container" id="typeCont1">
                        <div class="container" id="tfCont1">
                            <div class="form-group row">
                                <label class="col-1 col-form-label">Question</label>
                                <div class="col-10">
                                    <input class="form-control" type="text" placeholder="True/False Statement" name="question_text">
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-1"></div>
                                <div class="radio col-2" style="padding-bottom:10px">
                                <input type="text" max-length="1" name="question_ans" placeholder="T or F" pattern="[TFtf]" />
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row" style="padding-top:10px; padding-bottom:20px">
                <button type="submit" class="btn btn-primary btn-block" id="doneBtn">Save and add questions</button>
            </div>
            <div>
                <a href='../../q/{{$quiz->id}}'> Create Quiz </a>
            </div>
        
        </form>
    </div>
    </div>
    

    
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
    <script src="js/Create_Quiz_Form.js" id="script"></script>
    <script src="js/Create_Quiz_Btns.js" id="scriptBtn"></script>
    <script src="js/matchBtns.js" id="scriptMatchBtn"></script>

  </body>
@endsection