@extends('layouts.app')

@section('content')
<div class="container">
    <div class="jumbotron">
    <!-- This is the beginning of the code that was added to the heading to create the quiz form: -->
    <div class="container whiteTxt" style="padding-bottom:50px"><h1>Edit {{$quiz->quiz_name}}</h1></div>
    
    <form action="/q/{{$quiz->id}}" enctype="multipart/form-data" method="post" >
        <!--Variables-->
        @csrf
        @method('PATCH')

        <input type="hidden" name="questionNum" value="1">


        <div class="container whiteTxt" style="padding-bottom:20px">
            <div class="form-group row">
                <label class="col-2 col-form-label">Quiz Name</label>
                <div class="col-10">
                    <input class="form-control" type="text" 
                    placeholder="Quiz Name eg.(1X03 Quiz 1)" name="quiz_name"
                    value="{{ old('quiz_name') ?? $quiz->quiz_name}}">
                </div>
            </div>
    
            <div class="form-group row">
                <label class="col-2 col-form-label">Quiz Weight</label>
                <div class="col-10">
                    <input class="form-control" type="number" 
                    placeholder="Weight (%)" name="quiz_weight"
                    value="{{ old('quiz_weight') ?? $quiz->quiz_weight}}">
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
    

    
    
        <div class="container" style="padding-top:20px; padding-bottom:20px">
            <div class="row" style="padding-top:10px; padding-bottom:20px">
                <button type="submit" class="btn btn-primary btn-block" id="doneBtn">Save and add questions</button>
            </div>

        </div>
    </form>
</div>
</div>
</div>
<script src="http://code.jquery.com/jquery-1.11.0.min.js"></script> 

    <script src="../../js/Create_Quiz_Form.js" ></script>
    <script src="../../js/Create_Quiz_Btns.js" id="scriptBtn"></script>
    <script src="../../js/matchBtns.js" id="scriptMatchBtn"></script>
@endsection