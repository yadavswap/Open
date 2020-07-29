<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use App\User;
use App\UserDailyAttendance;
use Carbon\Carbon;



class ReportController extends Controller
{



    public function index(){

    	return view('front.user_profile.report');

    }

    public function showAttendance(){

    	$currentmonth = $date = date('Y-m');

  
    	$data = UserDailyAttendance::where('attendance_date','LIKE','%'.$currentmonth.'%')->where('user_id',Auth::user()->id)->get();

    	$totalpresent = $data->count();
    	$totaldays = Carbon::now()->daysInMonth;
    	$totalabsent =  (int)$totaldays - (int)$totalpresent;

    


    		return view('front.user_profile.attendancereport',compact('data','totalpresent','totaldays','totalabsent'));
    	

    }


}
