@extends('layouts.app')
<!-- QUESTION EDIT -->
@section('content')
<div class="container">
            <div class = "container">
                    <div class = "jumbotron"> 
                        <div class= "row"> 
                                <div class="col-md-8">
                                    <h2> {{$quiz->quiz_name}} </h2>
                                        <p>Instructor: {{$quiz->user->name}} </p>
                                        <p> Weight: {{$quiz->quiz_weight}}%</p>
                                </div>
                        </div>
                    </div>
                </div>

    <div class="jumbotron">
    <!-- This is the beginning of the code that was added to the heading to create the quiz form: -->
    <div class="container whiteTxt" style="padding-bottom:50px">
    <h1>Edit {{$question->question_text}} </h1></div>
    
    <form action="/{{$question->quiz_id}}/question/{{$question->id}}" enctype="multipart/form-data" method="post" >
        <!--Variables-->
        @csrf
        @method('PATCH')

        <div class="items whiteTxt" style="padding-bottom:20px" id="questionsCont">

    <input type="hidden" value="{{$question->quiz_id}}" name="quiz_id">
    
    <!--The following button is for testing and debugging purposes only
    <button type="button" class="btn btn-default test2-btn" data-testBtnId="1">Add Q2 Type</button>-->

    <div id="questionsCont"> 
        <div class="form-group row">
            <label class="col-2 col-form-label text-center">Time Limit (min)</label>
            <div class="col-3">
                <input class="form-control" type="number" value="{{ old('timelimit') ?? $question->timelimit}}" placeholder="Allowed time (seconds)" name="timelimit">
            </div>
        </div>

        <div class="row pb-3">
            <label for="image" class="col-2 col-form-label text-center">Add Image</label>
            <input type="file" class="col-4 form-control-file" value="{{ old('image') ?? $question->image}}"name="image" accept="image/*">
        </div>
        
        <div id="typeCont">
            
            <div class="form-group row">
                <label class="col-2 col-form-label text-center">Question</label>
                <div class="col-9">
                    <input class="form-control" type="text" name="question_text"value="{{ old('question_text') ?? $question->question_text}}">
                </div>
            </div>

            <div class="form-group row" style="padding-top:10px; padding-bottom:10px">
                <label class="col-2 col-form-label text-center">A</label>
                <div class="col-9">
                    <input class="form-control" type="text" name="option_a" placeholder="Option A" value="{{ old('option_a') ?? $question->option_a}}">
                </div>
            </div>

            <div class="form-group row" style="padding-bottom:10px">
                <label class="col-2 col-form-label text-center">B</label>
                <div class="col-9">
                    <input class="form-control" type="text" placeholder="Option B" name="option_b" 
                    value="{{ old('option_b') ?? $question->option_b}}">
                </div>
            </div>

            <div class="form-group row" style="padding-bottom:10px">
                <label class="col-2 col-form-label text-center">C</label>
                <div class="col-9">
                    <input class="form-control" type="text" placeholder="Option C" name="option_c"
                    value="{{ old('option_c') ?? $question->option_c}}">
                </div>
            </div>

            <div class="form-group row" style="padding-bottom:10px">
                <label class="col-2 col-form-label text-center">D</label>
                <div class="col-9">
                    <input class="form-control" type="text" placeholder="Option D" name="option_d"
                    value="{{ old('option_d') ?? $question->option_d}}">
                </div>
            </div>

            <div class="form-group row" style="padding-bottom:10px">
                <label class="col-2 col-form-label text-center">E</label>
                <div class="col-9">
                    <input class="form-control" type="text" placeholder="Option E" name="option_e"
                    value="{{ old('option_e') ?? $question->option_e}}">
                </div>
            </div>

            <div class="form-group row" style="padding-bottom:10px">
                <label class="col-2 col-form-label text-center">Answer</label>
                <div class="col-3">
                    <input class="form-control" max-length="1" type="text" placeholder="Correct Option" 
                    pattern="[ABCDEabcde]" name="question_ans" value="{{ old('question_ans') ?? $question->question_ans}}">
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
        </div>
        <a >
        <div align="right">
        <button type="submit" class="btn btn-primary" > 
                Update
           </button>
        </div>
        </a>
    </form>
</div>
</div>
</div>
<script src="http://code.jquery.com/jquery-1.11.0.min.js"></script> 

@endsection