<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ClickQuiz extends Model
{

    public function quiz() {
        return $this->belongsTo(Quiz::class);
    }

    public function question() {
        return $this->hasMany(Question::class)->orderBy('created_at', 'ASC');
    }

    public function user() {
        return $this->belongsTo(Student::class);
    }
}
