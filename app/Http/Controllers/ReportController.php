<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use App\User;
use App\UserDailyAttendance;
use Carbon\Carbon;
use App\WatchTime;



class ReportController extends Controller
{



    public function index(){

    	$now = Carbon::now();
    	$month = $now->format('F'); 

    	return view('front.user_profile.report',compact('month'));

    }

    public function showAttendance(){

    	$currentmonth = $date = date('Y-m');

  
    	$data = UserDailyAttendance::where('attendance_date','LIKE','%'.$currentmonth.'%')->where('user_id',Auth::user()->id)->get();

    	$totalpresent = $data->count();
    	$totaldays = Carbon::now()->daysInMonth;
    	$totalabsent =  (int)$totaldays - (int)$totalpresent;

    


    		return view('front.user_profile.attendancereport',compact('data','totalpresent','totaldays','totalabsent'));
    	

    }

      public function watchTime(){

        $userid = Auth::user()->id;


        $currentmonth = $date = date('Y-m-d');

  
        $data = WatchTime::where('starts_at_date','LIKE','%'.$currentmonth.'%')
        ->where('user_id',Auth::user()->id)
        ->whereNotNull('ends_at_time')
        ->get();

     // dd($data);

        $i = 0;
        foreach ($data as $time) {

            //dd($time->starts_at_time);
            if($time->starts_at_time && $time->ends_at_time)
            {



           

        $from = Carbon::createFromFormat('H:s:i', $time->starts_at_time);
          $to = Carbon::createFromFormat('H:s:i', $time->ends_at_time);
        $diff_in_minutes = $to->diffInSeconds($from);


// dd($diff_in_minutes); // Output: 20

 $coursename =  \App\CourseClass::where('course_id', $time->course_id)->first();

  // dd($coursename->title); 

  $watchdata[$i]= array(
    'course_name'=>$coursename->title,
    'course_duration'=> (float)$diff_in_minutes/60
  ); 


$i++;

            }

           // dd($attendancedata);





        }

       


      

    


            return view('front.user_profile.watchtime',compact('watchdata'));
        

    }


}
