<?php

Route::get('/home', function () {
    $users[] = Auth::user();
    $users[] = Auth::guard()->user();
    $users[] = Auth::guard('instructor')->user();

    //dd($users);

    return view('instructor.home');
})->name('home');

