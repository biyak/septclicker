<?php

// This app represents a single user in our db

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password', 'instructor'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function quiz() {
        return $this->hasMany(Quiz::class);
    }

    public function userable()
    {
        return $this->morphTo();
    }

    public function submittedquestion() {
        return $this->hasMany(SubmittedQuestion::class)->orderBy('created_at', 'ASC');
    }

    public function course() {
        return $this->hasMany(Course::class);
    }

    // public function isInstructor()
    // {
    //     $instructorRecord = \App\Instructor::where('user_id', $this->id)->first();
    //     if ($instructorRecord) {
    //         return true;
    //     } else {
    //         return false;
    //     }
    // }

    // public function isStudent()
    // {
    //     $studentRecord = \App\Student::where('user_id', $this->id)->first();
    //     if ($studentRecord) {
    //         return true;
    //     } else {
    //         return false;
    //     }
    // }
}
