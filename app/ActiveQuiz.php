<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ActiveQuiz extends Model
{
    protected $guarded = [];

    public function quiz() {
        return $this->belongsTo(Quiz::class);
    }

    public function student() {
        return $this->belongsTo(Student::class);
    }
}
