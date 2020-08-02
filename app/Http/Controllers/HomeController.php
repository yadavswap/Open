<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Helpers\AttendanceHelper;
use Auth;
use App\UserDailyAttendance;
use App\ContactInfo;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
   
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {

        



            return view('home_web');
      

    }

    public function newhome()
    {

        if(Auth::user())
        {
            return view('home');
        }

        return redirect()->route('login');
        



            
      

    }


    public function contact(Request $request){

        $data = new ContactInfo;
        $data->name = $request->name;
        $data->email = $request->email;
        $data->mobile = $request->mobile;
        $data->message = $request->message;
        $data->save();

        return back()->with("success","Details Sent Successfully");





    }

    public function logout(){
        Auth::logout();
        return redirect()->route('appview');
    }
}
