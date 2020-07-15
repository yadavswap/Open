<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use Auth;
use App\UserDailyAttendance;



class AttendanceController extends Controller
{

	public function __construct()
    {
        return $this->middleware('auth');
    }


    public function viewStudentsAttendance($id){

          $date = date('Y-m-d');

    	$users = UserDailyAttendance::select('user_daily_attendance.id','user_daily_attendance.user_id','users.id','users.fname','users.lname','user_daily_attendance.attendance_date','user_daily_attendance.attendance_time','users.email','users.added_by_user_id','users.user_img')
        ->join('users','users.id','=','user_daily_attendance.user_id')
        ->where('added_by_user_id',$id)
        ->where('attendance_date',$date)
        ->get();

        return $users;


    }

    public function StudentAttendance(){
        return view('admin.attendance.students');
    }
}
