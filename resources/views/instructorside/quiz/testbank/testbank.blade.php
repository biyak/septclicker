@extends('layouts.app')

@section('content')
<div class="container">
        <div class="jumbotron">
            <div class="row">
                <div class="col-md-12">
                    <h2> {{ Auth::user()->name }}'s Test Bank</h2>
                        <p> Here you will find all question you have added to your test bank. </p> 
                            <p>Select the desired questions from below and click <i>Create</i> to create a quiz with the selected questions.
                            </p>
                </div>
            </div>
        </div>
    </div>
</div>

<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"
    integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo"
    crossorigin="anonymous"></script>

<!-- The Questions int heir own jumbotrons-->
<!-- <div class="TestBank">
    <div id="TestBank"> </div>
</div> -->

<script>
//Keep track of selected questions
const selectedQuestions = new Set();
</script>

@php
$num=1
@endphp

@if ($questions != null)
    @foreach ($questions as $q)
        <div class = "container"> 
            <div class="jumbotron questionjumbo" style="background: lightgrey" id="{{$q->id}}"> 
                <div class="row">
                    <div class="col-md-8">
                        <div class="question"> <b>  {{$num}}. {{$q->question_text}} </b> </div><br>
                        <div class="answers">
                            @if ($q->option_a != null)
                                <label>A : {{$q->option_a}}</label><br>
                            @endif
                            @if ($q->option_b != null)
                                <label>B : {{$q->option_b}}</label><br>
                            @endif
                            @if ($q->option_c != null)
                                <label>C : {{$q->option_c}}</label><br>
                            @endif
                            @if ($q->option_d != null)
                                <label>D : {{$q->option_d}}</label><br>
                            @endif
                            @if ($q->option_e != null)
                                <label>E : {{$q->option_e}}</label><br>
                            @endif
                        </div>
                    </div>
                </div>
            </div>           
        </div>
    @php
    $num++
    @endphp
    @endforeach
@else
    <div class = "container"> 
        <div class="jumbotron" style="background: lightgrey" id="noQuestions"> 
            <div class="row">
                <div class="col-md-8">
                    <p> You currently do not have any questions in your test bank</p>
                    <p> To add a question to your test bank, select the "add to test bank" checkbox when creating or editing a question. </p>         
                </div>
            </div>
        </div>           
    </div>
@endif

<script>
$(".questionjumbo").click(function(){  
    bg = (this).style.backgroundColor;
    num = (this).id;
        
        if (bg == 'lightgreen'){
            (this).style.backgroundColor = "lightgrey";
            selectedQuestions.delete(num);
        }
        else {
            (this).style.backgroundColor = "lightgreen";
            selectedQuestions.add(num);
        }
    });
</script>


<!-- <div class="container" >
 
<div class="jumbotron">
    <div class="row">
            <div class="col-md-12">
                
                <div id="AddQuestion">

                </div>

            </div>
    </div>
    </div>
</div> -->

<div class="container">
        <div class="jumbotron">
            <div class="row">
                <button type="button" class="btn btn-primary btn-space" data-toggle="modal" data-target="#exampleModal">
                        Create Quiz
                </button>
                <!-- <iframe src="AddQuestion.html" height="300" width=100%></iframe> -->
            </div>
        </div>
    </div>
</div>
<div id="results"></div>

<!-- Button trigger modal -->
      <!-- Modal -->
      <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="exampleModalLabel">Are you sure you want to create this quiz?</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>

            <div class="modal-footer">
              <button type="button" class="btn btn-secondary" data-dismiss="modal">Review Selection</button>
              <a href = "CreateNewQuiz.html"> <button type="button"  id = "submit" class="btn btn-primary" > 
                   Create Quiz
               </button> </a>
            </div>
          </div>
        </div>
      </div>
    
    <!--<script src="js/testbank/TestBank.js"> </script> -->
 
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"
        integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1"
        crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"
        integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM"
        crossorigin="anonymous"></script>
@endsection