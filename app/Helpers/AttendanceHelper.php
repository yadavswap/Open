<?php

/*
	@author: Shantanu K
	@git: heyshantu13
*/


namespace App\Helpers;


use Illuminate\Http\Request;
use Auth;
use App\Attendance;
use App\Course;

class AttendanceHelper
{

	public static function studentAttendance(){

		 $role = Auth::user()->role;
        $date = date('Y-m-d');
        $course_id = request()->segment(3);
        $time = date("h:i:s");
        $userattendanceExist = Attendance::where('user_id',Auth::user()->id)
        ->where('attendance_date',$date)
        ->where('course_id',$course_id)
        ->first();
         $instructor_id =  Course::where('id', $course_id)->first(['id']);

        if($role == 'user' && !$userattendanceExist){
            $userattendance = new Attendance();
            $userattendance->user_id = Auth::user()->id;
            $userattendance->course_id = $course_id;
            $userattendance->instructor_id = $instructor_id->id;
            $userattendance->attendance_date = $date;
            $userattendance->attendance_time = $time;
            $is_saved = $userattendance->save();
            return 1;
           
        }
        else{
          return 0;
        }

	}


	public static function teacherAttendance(){

		 $role = Auth::user()->role;
        $date = date('Y-m-d');
        $course_id = request()->segment(3);
        $time = date("h:i:s");
        $userattendanceExist = Attendance::where('user_id',Auth::user()->id)
        ->where('attendance_date',$date)->first();
         $instructor_id =  Course::where('id', $course_id)->first(['id']);

        if($role == 'instructor' && !$userattendanceExist){
            $userattendance = new Attendance();
            $userattendance->user_id = Auth::user()->id;
            // $userattendance->course_id = $course_id;
            // $userattendance->instructor_id = $instructor_id->id;
            $userattendance->attendance_date = $date;
            $userattendance->attendance_time = $time;
            $is_saved = $userattendance->save();
            return 1;
           
        }
        else{
          return 0;
        }

	}

	
	   


}