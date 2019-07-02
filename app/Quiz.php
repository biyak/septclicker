<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Quiz extends Model
{
    protected $guarded = [];

    public function user() {
        return $this->belongsTo(Instructor::class);
    }

    public function tfquestion() {
        return $this->hasMany(TFQuestion::class)->orderBy('created_at', 'ASC');
    }
}
