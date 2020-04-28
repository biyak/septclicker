@extends('layouts.app')

@section('content')
<!-- <script src="header.js"> -->
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Welcome to your Student Dashboard, {{ Auth::user()->name }} !</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    <!-- Usually you echo out  but we can also use two curly braces-->
                    <div class="card-deck">
                    <a href="/quizlist/{{ Auth::user()->id }}" class="card img-fluid " style="height: 15rem">
                        <img class="card-img-top" >
                        <div class="card-img-overlay">
                            <h1 class="card-title">Quiz List</h1>
                        </div>
                    </a>
                    @if (Auth::user()->instructor === 0)
                    <a href="/elevate" class="card img-fluid " style="height: 15rem">
                        <img class="card-img-top" >
                        <div class="card-img-overlay">
                            <h1 class="card-title">Use Instructor Code</h1>
                        </div>
                    </a>
                    @endif
                </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
