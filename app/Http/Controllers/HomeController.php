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
    public function __construct()
    {
        $this->middleware(['auth']);
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {

          $role = Auth::user()->role;
        $date = date('Y-m-d');
      //  $course_id = request()->segment(3);
        $time = date("h:i:s");


           $userattendanceExist = UserDailyAttendance::where('user_id',Auth::user()->id)
        ->where('attendance_date',$date)->first();

        if($userattendanceExist){

             return view('home');

        
        }
        else{

         $userattendance = new UserDailyAttendance();
            $userattendance->user_id = Auth::user()->id;
            $userattendance->attendance_date =  $date ;
            $userattendance->attendance_time =  $time ;
            $userattendance->save();

             return view('home');

        }




            
      

    }
}
