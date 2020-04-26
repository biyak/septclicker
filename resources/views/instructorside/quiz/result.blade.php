@extends('layouts.app')

@section('content')

<body>


            <div class = "container">
                    <div class = "jumbotron">
                        <div class= "row">
                                <div class="col-md-8">
                                    <h2> "{{$quiz->quiz_name}}" Result</h2>
                                        <p>Instructor: {{$quiz->user->name}} </p>
                                        <p> Weight: {{$quiz->quiz_weight}}%</p>
                                        <p> Total number of students attended: {{$numOfStudents}}</p>
                                        <a href="result-csv"><button type="button" class="btn btn-primary" >
                                            Download Result
                                            </button>
                                        </a>
                                </div>
                        </div>
                    </div>
                </div>

</div>
<div class = "container">
    <div class="jumbotron">
    <div class="col-md-8" style="max-width:100%;">
<!-- The Quiz itself-->
@php
$num=1
@endphp
<div class="container">
  <table class="table table-hover">
    <thead>
      <tr>
        <th>Student ID</th>
        <th>Grade</th>
        <th></th>
      </tr>
    </thead>
    <tbody>
@foreach($list as $student)
      <tr>
        <td>{{$student['id']}}</td>
        <td>{{$student['grade']*100}}%</td>
        <td>{{$student['correct']}}/{{$student['total']}}</td>
      </tr>
@endforeach
</tbody>
</table>
</div>

</div>
</div>
</div>
<!-- Button trigger modal -->
<div class="container">
<div class ="jumbotron">
<a href = "../{{$quiz->id}}"> <button type="button" class="btn btn-primary">

                Go Back
           </button> </a>
</div>
</div>

<!-- jQuery first, then Popper.js, then Bootstrap JS -->
<script src="http://code.jquery.com/jquery-1.11.0.min.js"></script>
<script src="//netdna.bootstrapcdn.com/bootstrap/3.1.1/js/bootstrap.min.js"></script>



<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.0/jquery.min.js"></script>



</body>
@endsection
