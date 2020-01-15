<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class QuizAttempt extends Model {
    protected $guarded = [];
    public $timestamps = false;

    public function quiz() {
        return $this->belongsTo(Quiz::class);
    }

    public function user() {
        return $this->belongsTo(User::class);
    }
}

?>
