
@extends('layouts.app')

@section('content')

<body>
        <div class="container">
            <div class = "jumbotron" >
                <div id="activequiz">
                    <h2 > {{ Auth::user()->name }}'s Quiz List </h2>
                    <h3>
                        Active Quizzes
                        <button id="activebutton" class="btn btn-outline-primary btn-sm" onclick = "clickhideActive()">- </button>

                     </h3>
                     <table id="activequiztable"  style = "display:block;">
                    @foreach(Auth::user() -> quiz as $quiz)
                        <tr>
                            <td>
                                <a href="/active/{{$quiz->id}}/show" >
                                    {{$quiz->quiz_name}} - ( {{$quiz->quiz_weight}} %)
                                </a>
                            </td>
                        </tr>

                    @endforeach


                     </table>

                </div>
              <br>

                <div id="activequiz">
                <h3> 
                    Inactive Quizzes 
                    <button id="pastbutton" class="btn btn-outline-primary btn-sm" onclick = "clickhidePast()"> - </button>

                </h3> 
                <table id="pastquiztable" style = "display:none;">
                        <tr>
                            <td>
                                4C03 Quiz 6 (Interactive Quiz)
                            </td>
                        </tr>
                        <tr>
                            <td>
                                3MI3 Midterm 1
                            </td>
                        </tr>
                        <tr>
                            <td>
                                4C03 Quiz 5 (Interactive Quiz)
                            </td>
                        </tr>
                        <tr>
                            <td>
                                4C03 Quiz 4 (Interactive Quiz)
                            </td>
                        </tr>
                        <tr>
                            <td>
                                4C03 Quiz 3 (Interactive Quiz)
                            </td>
                        </tr>
                     </table>
                </div>
<!-- 
                <div class="text-right"> 
             <a href="/q/create"> Create New Quiz</a>
                 </div> -->
        </div>


        </body>
    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->



        <script src="http://code.jquery.com/jquery-1.11.0.min.js"></script> 
        <script src="//netdna.bootstrapcdn.com/bootstrap/3.1.1/js/bootstrap.min.js"></script>
    <script>
        function clickhidePast() {
            var x = document.getElementById("pastquiztable");
            var y = document.getElementById("pastbutton")
            if (x.style.display === "none") {
                x.style.display = "block";
                y.innerHTML = "-"
            }
            else {
                x.style.display = "none";
                y.innerHTML = "+"
            }

        }

        function clickhideActive() {
            var x = document.getElementById("activequiztable");
            var y = document.getElementById("activebutton")

            if (x.style.display === "none") {
                x.style.display = "block";
                y.innerHTML = "-"
            }
            else {
                x.style.display = "none";
                y.innerHTML = "+"
            }
        }
    </script>
</body>


@endsection