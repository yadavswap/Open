<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Order;
use App\CourseClass;
use App\CourseChapter;
use App\Course;
use Auth;
use Crypt;
use Redirect;
use App\User;
use App\Attendance;

class WatchController extends Controller
{
    public function watch($id)
    {

          $role = Auth::user()->role;
        return $role;


        if(Auth::check())
        {
        	$order = Order::where('user_id', Auth::User()->id)->where('course_id', $id)->first();

            $courses = Course::where('id', $id)->first();
        

            if(Auth::User()->role == "admin")
            {
            	return view('watch',compact('courses'));
            }
            else
            {
                if(!empty($order))
                {
                    return view('watch',compact('courses'));
                }
                else
                {
                    return back()->with('delete', '401 Unauthorized Action !');
                }
            }
        }
        return Redirect::route('login')->withInput()->with('delete', 'Please Login to access restricted area.');

    }


    public function watchclass($id)
    {
        $class = CourseClass::where('id',$id)->first();

        if(Auth::check())
        {
            if(!empty($class))
            {
                return view('classwatch',compact('class'));
            }
            else
            {
                return back()->with('delete', '401 Unauthorized Action !');
            }
        }
        return Redirect::route('login')->withInput()->with('delete', 'Please Login to access restricted area.');
    }

    public function view($url, $course_id)
    {
        $course = $course_id;
        $url = Crypt::decrypt($url);
        return view('iframe',compact('url', 'course'));
    }

    public function lightbox($id)
    {
        $class = CourseClass::where('id',$id)->first();
        
        return view('lightbox',compact('class'));
    }


    /*private function userNteacherAttendance(){

        $role = Auth::user()->role;
        $date = date('Y-m-d');
        $userattendanceExist = Attendance::where('user_id',1)
        ->where('attendance_date',$date)->first();

        return $userattendanceExist;
         $userattendance = new Attendance();
        if($role == 'user'){
           
            $userattendance->
        }
       

    }*/
   
}
