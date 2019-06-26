<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ProfilesController extends Controller
{
    public function index($user) //What we pass into the url
    {
        //dd($user); prints user onto the screen

        $user = \App\User::findOrFail($user);
        return view('home', ['user' => $user]);
    }
}
