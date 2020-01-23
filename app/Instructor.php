<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Instructor extends User
{
    public function quiz() {
        return $this->hasMany(Quiz::class);
    }

    public function clickQuiz() {
        return $this->hasMany(ClickQuiz::class);
    }

    public function user()
    {
        return $this->morphOne('App\User', 'userable');
    }

    public function course() {
        return $this->hasMany(Course::class);
    }
}
