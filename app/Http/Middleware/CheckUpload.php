<?php

namespace App\Http\Middleware;

use App\User;
use Closure;

class CheckUpload
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
        if(auth()->user()->roles->first()->name == 'student'){
            $user = User::findOrFail(auth()->id());
            if ($user->studentImages()->count() === 0) {
                return redirect()->route('student.profile')->withStatus(__('Please upload your profile picture to proceed.'));
            }
        }

        return $next($request);
    }
}
