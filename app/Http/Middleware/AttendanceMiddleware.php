<?php

namespace App\Http\Middleware;

use Closure;
use App\Helpers\AttendanceHelper;


class AttendanceMiddleware
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

        $attendance = new AttendanceHelper();
        $attendance->userDailyAttendance();
        return $next($request);
    }
}
