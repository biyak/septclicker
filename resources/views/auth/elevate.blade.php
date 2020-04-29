@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">{{ __('Elevate to Instructor') }}</div>
                    <div class="card-body">
                        <p>Instructors should have received a code to activate their accounts - if you have one, please
                            enter it below.</p>
                        <form method="POST" action="/elevate">
                            @csrf

                            @if ($error)
                                <div class="alert alert-danger">{{$error}}</div>
                            @endif

                            <div class="form-group row">
                                <label for="code"
                                       class="col-md-4 col-form-label text-md-right">{{ __('Elevation Code: ') }}</label>

                                <div class="col-md-6">
                                    <input id="code" type="text" class="form-control" name="code" value="" required
                                           autofocus>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="course_code"
                                       class="col-md-4 col-form-label text-md-right">{{ __('Course Code: ') }}</label>

                                <div class="col-md-6">
                                    <input id="course_code" type="text" class="form-control" name="course_code" value=""
                                           required autofocus>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="course_name"
                                       class="col-md-4 col-form-label text-md-right">{{ __('Course Name: ') }}</label>

                                <div class="col-md-6">
                                    <input id="course_name" type="text" class="form-control" name="course_name" value=""
                                           required autofocus>
                                </div>
                            </div>


                            <div class="form-group row mb-0">
                                <div class="col-md-8 offset-md-4">
                                    <button type="submit" class="btn btn-primary">
                                        {{ __('Elevate') }}
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
