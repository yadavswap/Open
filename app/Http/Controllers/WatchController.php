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
use App\WatchTime;
use Session;

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

    public function stopClass(Request $request){

        $watchlectureid = Session::get('watchlectureid');
        $stopclass = WatchTime::where('id',$watchlectureid)->first();

        if($stopclass){
            $stopclass->update(['ends_at_date' => date('Y-m-d'),
                'ends_at_time'=>date("h:i:s")
        ]);
             Session::forget('watchlectureid');
        }




       return response()->json("true",200);

        

    }


    public function watchclass($id)
    {
        $class = CourseClass::where('id',$id)->first();

        if(Auth::check())
        {
            $userid = Auth::user()->id;

            if(!empty($class))
            {

                $watchtime = new WatchTime();
                $watchtime->user_id = $userid;
          $watchtime->lecture_id = $id;
          $watchtime->starts_at_date = date('Y-m-d');
          $watchtime->starts_at_time = date("h:i:s");
          $watchtime->save();
          $watchid = $watchtime->id;

          if(Session::get('watchlectureid'))
          {
            Session::forget('watchlectureid');
            Session::put('watchlectureid', $watchid);
          }

        Session::put('watchlectureid', $watchid);


                return view('classwatch',compact('class','watchid'));
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
