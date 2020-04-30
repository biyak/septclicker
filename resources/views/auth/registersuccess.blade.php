@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">{{ __('Register') }}</div>

                    <div class="card-body">

                        <h3>Welcome, {{Auth::user()->name}}!</h3>
                        <p>For testing purposes, we have generated an instructor code for this account. Note that
                            this would not happen on a live system, this is a convenience for you to be easily able
                            to demo instructor accounts. Your code is:</p>
                        <p><em>{{$code}}</em></p>

                        <div class="">
                            <a href="/studenthome">
                                <button type="submit" class="btn btn-primary float-right">
                                    Go home
                                </button>
                            </a>
                        </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
