<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Student extends User
{
    use Notifiable;

    public function activequizzes() {
        return $this->hasMany(ActiveQuiz::class);
    }

    public function instructors() {
        return $this->belongsToMany(Instructor::class);
    }
}
