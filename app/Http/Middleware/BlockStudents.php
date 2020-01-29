<?php

namespace App\Http\Middleware;

use Closure;

/**
 * Middleware to prevent a student from accessing a page - i.e. only instructors are allowed through
 * Use this middleware directly on routes - this assumes that we have a valid authentication instance so
 * do not run this middleware before the auth middleware
 * @package App\Http\Middleware
 */
class BlockStudents
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {

        if (auth()->user()->instructor === 0){
            return abort(403, "This page may only be accessed by instructors");
        }

        return $next($request);
    }
}
