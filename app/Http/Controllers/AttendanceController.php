<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;


class AttendanceController extends Controller
{

	public function __construct()
    {
        return $this->middleware('auth');
    }


    public function viewStudentsAttendance($id){

    	return view('admin.attendance.index');

    }
}
