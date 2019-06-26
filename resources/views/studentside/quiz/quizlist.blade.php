@extends('layouts.app')

@section('content')
<head>
    <title>Quiz List</title>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <style>


        .jumbotron {
            background-color: #d1d3d3
        }

        .card-img-top {
            width: 100%;
            height: 14.85rem;
            object-fit: cover;
        }
        table {
            font-family: arial, sans-serif;
            border-collapse: collapse;
            width: 100%;
        }

        td, th {
            border: 1px solid #dddddd;
            text-align: left;
            padding: 8px;
        }

        tr:nth-child(even) {
            background-color: #dddddd;
        }
        .capitalize { text-transform: capitalize; }
    </style>
    

    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css"
        integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">

</head>

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
                        <tr>
                            <td>
                                <a href="quizinteractive" >
                                    4C03 Quiz 7 (Interactive Quiz)
                                </a>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <a href="quiztest"  >
                                    3MI3 Midterm 2
                                </a>
                            </td>
                        </tr>
                     </table>

                </div>
              <br>

                <div id="activequiz">
                <h3> 
                    Past Quizzes 
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
