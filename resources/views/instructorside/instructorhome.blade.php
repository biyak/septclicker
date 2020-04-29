@extends('layouts.app')

@section('content')
    <head>
        <title>Home</title>

    </head>

    <body>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">Welcome to your Instructor Dashboard, {{ Auth::user()->name }}!</div>

                    <div class="card-body">
                        @if (session('status'))
                            <div class="alert alert-success" role="alert">
                                {{ session('status') }}
                            </div>
                    @endif

                    <!-- Ususally you echo out  but we can also use two curly braces-->
                        <div class="card-deck">
                            <a href="instructorquizlist/{{ Auth::user()->id }}" class="card img-fluid "
                               style="height: 15rem">
                                <img class="card-img-top">
                                <div class="card-img-overlay">
                                    <h1 class="card-title">Quiz List</h1>
                                </div>
                            </a>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    </body>
@endsection
