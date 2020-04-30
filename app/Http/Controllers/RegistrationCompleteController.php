<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class RegistrationCompleteController extends Controller
{
    // Generates a 4 letter random string
    private function generateRandomString(){
        //No 1, 0, L, or O, I to prevent confusion
        $allowedchars = "ABCDEFGHJKMNPQRSTUVWXYZ23456789";
        $out = "";
        for ($i = 0; $i < 4; $i++){
            $out = $out . $allowedchars[mt_rand(0, strlen($allowedchars) - 1)];
        }
        return $out;
    }

    public function completedpage(){

        $user = auth()->user();
        if ($user->instructor !== -1){
            return abort(403,"You already got your code!");
        }
        $user->instructor = 0;
        $user->save();

        $code = $this->generateRandomString() . "-" . $this->generateRandomString() . "-" . $this->generateRandomString() . "-" . $this->generateRandomString();
        \App\Elevations::create(['code' => $code, 'used' => False])->save();

        return view("auth.registersuccess", ['code' => $code]);
    }
}
