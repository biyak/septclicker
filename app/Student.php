<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Student extends Model
{

    public function activequizzes() {
        return $this->hasMany(ActiveQuiz::class);
    }

    public function instructors() {
        return $this->belongsToMany(Instructor::class);
    }

    public function clickquizzes() {
        return $this->hasMany(ClickQuiz::class);
    }

    public function user()
    {
        return $this->morphOne('App\User', 'userable');
    }
}
