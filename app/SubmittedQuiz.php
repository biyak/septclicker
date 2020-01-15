<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SubmittedQuiz extends Model
{
    protected $guarded = [];

    protected function getDateFormat()
    {
        return 'U';
    }

    public function user() {
        return $this->belongsTo(User::class);
    }
}
