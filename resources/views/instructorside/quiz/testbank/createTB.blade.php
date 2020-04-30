@extends('layouts.app')

@section('content')
    <!--Heading and Menu-->
    <div class="container">
        <div class="jumbotron">
            <div><h1>Create New Quiz</h1></div>

            <form action="/testbank/review" method="post" enctype="multipart/form-data">

                @csrf
                <input type="hidden" name="questionNum" value="1">
                <input id = "qIDs" name = "qIDs" type="hidden" value="1">
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
                        </div>
                    </div>

                     <button type="submit" class="btn btn-primary" align="right">
                        Next
                    </button>

            </form>
        </div>
    </div>


    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"
            integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo"
            crossorigin="anonymous"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"
            integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1"
            crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"
            integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM"
            crossorigin="anonymous"></script>


    </body>
@endsection
