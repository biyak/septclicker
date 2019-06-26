@extends('layouts.app')

@section('content')
<div class="container">
    <div class="jumbotron">
    <!-- This is the beginning of the code that was added to the heading to create the quiz form: -->
    <div class="container whiteTxt" style="padding-bottom:50px"><h1>Create New Quiz</h1></div>
    
    <form action="/q" method="post" >
        <!--Variables-->
        @csrf
        <input type="hidden" name="questionNum" value="1">


        <div class="container whiteTxt" style="padding-bottom:20px">
            <div class="form-group row">
                <label class="col-2 col-form-label">Quiz Name</label>
                <div class="col-10">
                    <input class="form-control" type="text" placeholder="Quiz Name eg.(1X03 Quiz 1)" name="quiz_name">
                </div>
            </div>
    
            <div class="form-group row">
                <label class="col-2 col-form-label">Quiz Weight</label>
                <div class="col-10">
                    <input class="form-control" type="number" placeholder="Weight (%)" name="quiz_weight">
                </div>
            </div>
    
            <!-- For now, we will not use the total quiz time as most professors would like to specify the time allocated to each question. -->
            <!--<div class="form-group row">
                <label class="col-2 col-form-label">Time Limit</label>
                <div class="col-10">
                    <input class="form-control" type="number" placeholder="Time (min)" id="time-limit">
                </div>
            </div>-->
        </div>
    
    
        <div class="container whiteTxt" style="padding-bottom:20px"><h3>Questions</h3></div>
    
    
        <div class="items whiteTxt" style="padding-bottom:20px" id="questionsCont">
            
            <!--The following button is for testing and debugging purposes only
            <button type="button" class="btn btn-default test2-btn" data-testBtnId="1">Add Q2 Type</button>-->
    
            <div class="container" id="question1Container" style="border:1px solid #cecece;">
                <div class="container" style="padding-top:10px"><h5>Question 1:</h5><br></div>
    
                <div class="form-group row">
                    <label class="col-2 col-form-label text-center">Time Limit</label>
                    <div class="col-3">
                        <input class="form-control" type="number" placeholder="Allowed time (seconds)" name="timeLimit1">
                    </div>
                </div>

                <div class="row">
                    <label for="image" class="col-2 col-form-label text-center">Add Image</label>
                    <input type="file" class="col-4 form-control-file" name="imageq1">
                </div>
    
                <div class="container" style="padding-bottom:20px">
                    <div class="dropdown">
                        <button class="btn btn-default dropdown-toggle" type="button" data-toggle="dropdown">
                            Question Type
                            <span class="caret"></span>
                        </button>
                        <ul class="dropdown-menu">
                            <li><button class=" btn btn-default mcqBtn btn-block" type="button" data-mcqId="1">Multiple Choice</button></li>
                            <li><button class=" btn btn-default tfBtn btn-block" type="button" data-tfId="1">True/False</button></li>
                            <li><button class=" btn btn-default txtBtn btn-block" type="button" data-txtId="1">Text Answer</button></li>
                            <li><button class=" btn btn-default numBtn btn-block" type="button" data-numId="1">Numerical Answer</button></li>
                            <li><button class=" btn btn-default matchBtn btn-block" type="button" data-matchId="1">Column Match</button></li>
                        </ul>
                    </div>
                </div>
                
                <div class="container" id="typeCont1"></div>
            </div>
        </div>
    
    
        <div class="container" style="padding-top:20px; padding-bottom:20px">
            <div class="btn-group" role="group">
                <button type="button" class="btn btn-danger" id="rmvQBtn">Remove Question</button>
                <button type="button" class="btn btn-success" id="addQBtn">Add Question</button>
            </div>
        </div>
    
        
        <div class="container" style="padding-top:20px; padding-bottom:20px">
    
            <div class="row" style="padding-top:20px; padding-bottom:10px">
                <button type="button" class="btn btn-success btn-block" id="quickLaunchBtn">Quick Launch</button>
            </div>

            <div class="row" style="padding-top:10px; padding-bottom:20px">
                <button type="submit" class="btn btn-primary btn-block" id="doneBtn">Save</button>
            </div>

        </div>
    </form>
</div>
</div>
</div>
<script src="http://code.jquery.com/jquery-1.11.0.min.js"></script> 

    <script src="js/Create_Quiz_Btns.js" ></script>
    <script src="js/Create_Quiz_Btns.js" id="scriptBtn"></script>
    <script src="js/matchBtns.js" id="scriptMatchBtn"></script>
@endsection