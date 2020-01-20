@extends('layouts.app')

@section('content')
<!--Heading and Menu-->
<div class="container">
    <div class="jumbotron">
        <div ><h1>Create New Quiz</h1></div>

            <form action="/q" method="post" enctype="multipart/form-data">

            @csrf
            <input type="hidden" name="questionNum" value="1">
            <div class="container whiteTxt pt-3 pb-3">
                <div class="form-group row pt-3 pb-3">
                    <label class="col-2 col-form-label">Quiz Name</label>
                    <div class="col-10">
                        <input class="form-control" type="text"
                        placeholder="Quiz Name eg.(Fluid Dynamics Quiz 1)" name="quiz_name">
                    </div>
                </div>

                <div class="form-group row pt-3 pb-3">
                    <label class="col-2 col-form-label">Quiz Weight</label>
                    <div class="col-10">
                        <input class="form-control" type="number"
                        placeholder="Weight (%)" name="quiz_weight">
                        <!-- Jenny make this an actual control pls - this controls single/multiple questions mode -->
                        <input type="hidden" name="singular_questions" value="1"/>
                    </div>
                </div>

                <!-- <div class="form-group row pt-3 pb-3">
                    <label class="col-2 col-form-label">Course Code</label>
                    <div class="col-10">
                        <input class="form-control" type="text"
                        placeholder="Course Code eg.(CompSci 1XA3)" name="course_code">
                    </div>
                </div>

                <div class="form-group row pt-3">
                    <label class="col-2 col-form-label">Quiz Type</label>
                    <div class="col-10">
                        <input class="form-control" max-length="1" type="text"
                        placeholder="M for Midterm or I for Interactive" name="quiz_type" pattern="[MImi]" title="Enter M or m for a Midterm Quiz. Enter I or i for an Interactive Quiz">
                    </div>
                    Midterm quizzes allow students to answer all questions at the same time with a time-limit for the whole quiz. Interactive quizzes will only allow students to answer the selected question in specified question-time-limit
                </div>

                <div class="row">
                    <div class="col-2"></div>
                    <div class="col-10">
                            Midterm quizzes allow students to answer all questions at the same time with a time-limit for the whole quiz. Interactive quizzes will only allow students to answer the selected question in specified question-time-limit.
                    </div>
                </div>
            </div> -->
           <button type="submit" class="btn btn-primary" align="right">
                Next
           </button>

        </form>
    </div>
</div>


<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>


</body>
@endsection
