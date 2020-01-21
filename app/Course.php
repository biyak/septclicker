<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Course extends Model
{
    protected $guarded = [];

    public function instructor() {
        return $this->belongsTo(Instructor::class);
    }

    public function quiz() {
        return $this->hasMany(Quiz::class)->orderBy('created_at', 'ASC');
    }

    public function user() {
        return $this->belongsTo(User::class);
    }

}
