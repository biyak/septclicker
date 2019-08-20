<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Question extends Model
{
    protected $guarded = [];

    public function quiz() {
        return $this->belongsTo(Quiz::class);
    }

    public function clickquiz() {
        return $this->belongsTo(Quiz::class);
    }


    public function submittedquestion() {
        return $this->hasMany(SubmittedQuestion::class);
    }
}
