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


    public function viewAttendanceReport($id){

        $users = User::findOrFail($id);

            $currentmonth = $date = date('Y-m');

  
        $data = UserDailyAttendance::where('attendance_date','LIKE','%'.$currentmonth.'%')->where('user_id',$id)->get();

        $currentday = date("d");

        $totalpresent = $data->count();
        $totaldays = Carbon::now()->daysInMonth;
        $totalabsent =  (int)$currentday - (int)$totalpresent;

        //dd($totalabsent);



          $date = date('Y-m-d');

        $attendancedata = UserDailyAttendance::select('user_daily_attendance.id','user_daily_attendance.user_id','users.id','users.fname','users.lname','user_daily_attendance.attendance_date','user_daily_attendance.attendance_time','users.email','users.added_by_user_id','users.user_img')
        ->join('users','users.id','=','user_daily_attendance.user_id')
        ->where('added_by_user_id',$id)
        ->where('attendance_date',$date)
        ->get();



        $count = $attendancedata->count();

       // dd($count);

        $attendancearray = $this->attendancearray($id);

        //dd($attendancearray);




        return view('admin.reports.attendance',compact('users','totalpresent','totaldays','totalabsent','attendancedata','date','count','currentday','attendancearray'));

       // dd($users);



    }


    private function attendancearray($id,$date = null)
    {
        $attendancearray = [];

        $attendance = UserDailyAttendance::where('user_id',$id)->orderBy('created_at','DESC')->get();

       

        $i = 0;
        foreach ($attendance as $ud) {

      
          $attendancearray[$i]['date']=   $ud->attendance_date;
           $attendancearray[$i]['badge']=   true;
            $attendancearray[$i]['title']=   "Present";

            $attendancearray[$i]['body'] = "<p class=\"lead\">Party<\/p><p>Like it's 1999.<\/p>";


            $i++;

        }

        $attendancearray = json_encode($attendancearray);
    

        return $attendancearray;


    }


}
