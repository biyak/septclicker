<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TFQuestion extends Model
{
    protected $guarded = [];

    public function quiz() {
        return $this->belongsTo(Quiz::class);
    }
}
