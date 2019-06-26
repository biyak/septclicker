@extends('layouts.app')

@section('content')
<head>
    <title>Peer Review List</title>
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
        }

        td, th {
            border: 1px solid #dddddd;
            text-align: left;
            padding: 10px;
            width: 1000px;
        }

        tr:nth-child(even) {
            background-color: #dddddd;
        }

        .btn-sm{
            /* height: 20px;
            text-align: start; */
        }
    </style>
    

    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css"
        integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">

</head>

<body>
    
        <div class="container">
            <div class = "jumbotron" >
                <div id="activequiz">
                    <h3>
                        Active Peer Reiews
                        <button id="activebutton" class="btn btn-outline-primary btn-sm" onclick = "clickhideActive()">- </button>

                     </h3>
                     <table id="activeprtable"  style = "display:block;">
                        <tr>
                            <td>
                                <a href="/peerreview" >
                                    4C03 Final Presentations 
                                </a>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <a href="../StudentPRScreen/pr.html"  >
                                    4ZC3 Peer Evals
                                </a>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <a href="../StudentPRScreen/pr.html"  >
                                    3MI3 Seminar
                                </a>
                            </td>
                        </tr>
                     </table>

                </div>
              <br>

                <div id="activequiz">
                <h3> 
                    Past Peer Reviews
                    <button id="pastbutton" class="btn btn-outline-primary btn-sm" onclick = "clickhidePast()"> - </button>

                </h3> 
                <table id="pastprtable" style = "display:none;">
                        <tr>
                            <td>
                                4C03 Pitch Presentations
                            </td>
                        </tr>
                        <tr>
                            <td>
                                3MI3 Seminar Reviews
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
            var x = document.getElementById("pastprtable");
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
            var x = document.getElementById("activeprtable");
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