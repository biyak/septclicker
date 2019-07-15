<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Quiz extends Model
{
    protected $guarded = [];

    public function instructor() {
        return $this->belongsTo(Instructor::class);
    }

    public function question() {
        return $this->hasMany(Question::class)->orderBy('created_at', 'ASC');
    }


}
