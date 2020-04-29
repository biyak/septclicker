@extends('layouts.app')

@section('content')
    <head>
        <title>Peer Review</title>

        <!-- Bootstrap CSS -->
        <style>
            body {

                background-color: #cccccc;
            }

            .jumbotron {
                background-color: #d1d3d3;
                position: relative;
            }

            .card-img-top {
                width: 100%;
                height: 14.85rem;
                object-fit: cover;
            }

            #logo {
                height: 50px;
                width: 50px;

            }

            .img-fluid {
                max-width: 100%;
                height: auto;
            }
        </style>
        <head>
            <title>Peer Review</title>

            <!-- Bootstrap CSS -->
            <style>
                body {

                    background-color: #cccccc;
                }

                .jumbotron {
                    background-color: #d1d3d3;
                    position: relative;
                }

                .card-img-top {
                    width: 100%;
                    height: 14.85rem;
                    object-fit: cover;
                }

                #logo {
                    height: 50px;
                    width: 50px;

                }
            </style>

            <meta charset="utf-8">
            <meta name="viewport" content="width=device-width, initial-scale=1">
            <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css"
                  integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T"
                  crossorigin="anonymous">

        </head>

    <body>

    <!-- Actual Peer Review cument -->

    <div class="container">
        <div class="jumbotron">
            <div class="row">
                <div class="col-md-8">
                    <h2> Peer Review Name</h2>
                    <p>Instructor: xxxxx xxxxx Time: xx:xx:xx Weight: xx%</p>
                </div>
            </div>
        </div>
    </div>
    </div>

    <div class="container">
        <div class="jumbotron">
            <div class="row">
                <div class="col-md-8">

                    <div class="PRContainer" id="PR">

                    </div>
                    <!-- <div id="results"></div> -->

                    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal">
                        Submit
                    </button>
                </div>
            </div>
        </div>
    </div>
    </div>
    <!-- Modal -->
    <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
         aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Are you sure you want to submit?</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    ~ Review of their input ~
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Review Answers</button>
                    <a href="../StudentSubmit/studentsubmit.html">
                        <button type="button" class="btn btn-primary">

                            Submit
                        </button>
                    </a>
                </div>
            </div>
        </div>


        <!-- Optional JavaScript -->
        <!-- jQuery first, then Popper.js, then Bootstrap JS -->

        <script src="http://code.jquery.com/jquery-1.11.0.min.js"></script>
        <script src="//netdna.bootstrapcdn.com/bootstrap/3.1.1/js/bootstrap.min.js"></script>

        <script src="js/pr/pr.js"></script>
    </body>
@endsection
