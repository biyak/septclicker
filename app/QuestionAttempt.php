<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class QuestionAttempt extends Model {
    protected $guarded = [];
    public $timestamps = false;

    public function question() {
        return $this->belongsTo(Question::class);
    }

    public function user() {
        return $this->belongsTo(User::class);
    }
}

?>
