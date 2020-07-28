<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;


class ReportController extends Controller
{



    public function index(){

    	return view('front.user_profile.report');

    }

    public function showAttendance(){

    	

    }


}
