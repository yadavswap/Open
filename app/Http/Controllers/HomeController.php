<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Helpers\AttendanceHelper;
use Auth;
use App\UserDailyAttendance;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
   
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {

        



            return view('home');
      

    }
}
