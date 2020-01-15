<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SubmittedQuestion extends Model
{

    protected function getDateFormat()
    {
        return 'U';
    }

    protected $fillable = [
        'question_id', 'user_id', 'selected_answer'
    ];

    public function user() {
        return $this->belongsTo(User::class);
    }

    public function question() {
        return $this->belongsTo(Question::class);
    }
}
