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

    	$users = UserDailyAttendance::select('user_daily_attendance.*','users.*')
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
