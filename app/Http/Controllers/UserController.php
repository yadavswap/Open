<?php

namespace App\Http\Controllers;

use App\User;
use App\Allstate;
use App\Allcity;
use App\Allcountry;
use Illuminate\Http\Request;
use Hash;
use Session;
use Image;
use Auth;
use App\Wishlist;
use App\Cart;
use App\Order;
use App\ReviewRating;
use App\Question;
use App\Answer;
use App\State;
use App\City;
use App\Country;
use App\Course;
use App\UserAssignTeacher;
use DB;

class UserController extends Controller
{

    public function __construct()
    {
        return $this->middleware('auth',['expect'=>['is_admin']]);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

       public function viewAllParent()
    {
          if(Auth::user()->role == "instructor"){

            $teacherid = Auth::user()->id;


            $users = UserAssignTeacher::select('users.*','user_assign_teachers.*','user_assign_teachers.id as uas_id','users.id as id')
            ->join('users','user_assign_teachers.student_id','=','users.id')->orderBy('users.created_at','DESC')->get();
        return view('admin.user.index', compact('users'));
        }


          $users = User::where('role','parent')->orderBy('created_at','DESC')->get();
         // dd($users);
        return view('admin.user.parentindex', compact('users'));


    }

    public function viewAllUser()
    {

        if(Auth::user()->role == "instructor"){

            $teacherid = Auth::user()->id;

            // $users = User::select('users.*','user_assign_teachers.*','user_assign_teachers.id as uas_id','users.id as id')
            // ->join('user_assign_teachers','users.id','=','user_assign_teachers.student_id')


            $users = UserAssignTeacher::select('users.*','user_assign_teachers.*','user_assign_teachers.id as uas_id','users.id as id')
            ->join('users','user_assign_teachers.student_id','=','users.id')
            ->where('user_assign_teachers.instructor_id',$teacherid)
            ->orderBy('users.created_at','DESC')->get();
        return view('admin.user.index', compact('users'));
        }
      
        $users = User::where('role','user')->orderBy('created_at','DESC')->get();
        return view('admin.user.index', compact('users'));
    }

    public function viewStudents()
    {

      
    }

    public function viewAllTeachers(){


        $users = User::where('role','instructor')->orderBy('created_at','DESC')->get();
        return view('admin.user.teacherindex', compact('users'));

    }

    public function assignStudent(){

        $authid = Auth::user()->id;

        $users = User::where('role','user')->where('id','!=',$authid)->orderBy('fname','ASC')->get();
         $teachers = User::where('role','instructor')->where('id','!=',$authid)->orderBy('fname','ASC')->get();
        return view('admin.user.assign', compact('users','teachers'));

    }

    public function assignToStudent(Request $request){

        $studentid = $request->student;
        $instructid = $request->teacher;

        $exists = UserAssignTeacher::where('student_id', $studentid)
        ->where('instructor_id',$instructid)
        ->first();

        if($exists)
        {
              return back()->with('error','Assigned Successfully');
        }

       
        $assign = new UserAssignTeacher;
        $assign->student_id = $studentid;
        $assign->instructor_id = $instructid;
        $assign->save();

          return back()->with('success','Assigned Successfully');

   

      

           








    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function create()
    {
        $cities = Allcity::all();
        $states = Allstate::all();
        $countries = Country::all();
        return view('admin.user.adduser')->with(['cities' => $cities, 'states' => $states, 'countries' => $countries]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */

    public function store(Request $request)
    {
        $data = $this->validate($request, [
            'fname' => 'required',
            'lname' => 'required',
            'mobile' => 'required|regex:/[0-9]{9}/',
            'address' => 'required|max:2000',
            'email' => 'required|unique:users,email',
            'password' => 'required|min:6|max:20',
            'status' => 'required|boolean',
            'role' => 'required',
            'user_img' => 'image|mimes:jpeg,png,jpg|max:8048',

        ]);




        $input = $request->all();

       
     
        if ($file = $request->file('user_img')) 
        {            
            $optimizeImage = Image::make($file);
            $optimizePath = public_path().'/images/user_img/';
            $image = time().$file->getClientOriginalName();
            $optimizeImage->save($optimizePath.$image, 72);
            $input['user_img'] = $image;
            
        }

        $input['password'] = Hash::make($request->password);
        $input['detail'] = $request->detail;      
        $data = User::create($input);
        $data->added_by_user_id = Auth::user()->id;
        $data->save(); 



        $exists = UserAssignTeacher::where('student_id',$data->id )
        ->where('instructor_id',Auth::user()->id)
        ->first();

        if(!$exists)
        {
                $assign = new UserAssignTeacher;
        $assign->student_id = $data->id;
        $assign->instructor_id = Auth::user()->id;
        $assign->save();
        }

       
      


        Session::flash('success','User Added Successfully ! Add Parent info');
        return redirect()->route('parent.add');
         






    }

    /**
     * Display the specified resource.
     *
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */

    public function show(User $user)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $cities = City::all();
        $states = State::all();
        $countries = Country::all();
        $user = User::findorfail($id);
        return view('admin.user.edit',compact('cities','states','countries','user'));

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request,$id)
    {

        $user = User::findorfail($id);

       
     

        $input = $request->all();
        

        if ($file = $request->file('user_img')) {

            if($user->user_img != null) {
                $content = @file_get_contents(public_path().'/images/user_img/'.$user->user_img);
                if ($content) {
                  unlink(public_path().'/images/user_img/'.$user->user_img);
                }
            }

            $optimizeImage = Image::make($file);
            $optimizePath = public_path().'/images/user_img/';
            $image = time().$file->getClientOriginalName();
            $optimizeImage->save($optimizePath.$image, 72);
            $input['user_img'] = $image;
             $input['parent_id'] = $parent->id;
          
        }


        if(isset($request->update_pass)){
          
            $input['password'] = Hash::make($request->password);
        }
        else{
            $input['password'] = $user->password;
        }

        if(isset($request->status))
        {
            $input['status'] = '1';
        }
        else
        {
            $input['status'] = '0';
        }

        $user->update($input);

        Session::flash('success','User Updated Successfully !');
        return redirect()->route('user.index');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {

        $user = User::find($id);

        //dd($user);
        if ($user->user_img != null)
        {
                
            $image_file = @file_get_contents(public_path().'/images/user_img/'.$user->user_img);

            if($image_file)
            {
                unlink(public_path().'/images/user_img/'.$user->user_img);
            }
        }

        $value = $user->delete();
        Course::where('user_id', $id)->delete();
        Wishlist::where('user_id', $id)->delete();
        Cart::where('user_id', $id)->delete();
        Order::where('user_id', $id)->delete();
        ReviewRating::where('user_id', $id)->delete();
        Question::where('user_id', $id)->delete();
        Answer::where('ans_user_id', $id)->delete();

        if($value)
        {
            session()->flash("success","User Has Been Deleted");
            return redirect("user");
        }
    }

    public function unassign($id){



       $data =  UserAssignTeacher::where('student_id',$id)->where('instructor_id',Auth::user()->id)->first();



       if($data){
        $data->delete();
        session()->flash("success","User Has Been Unassign");
            return redirect("user");
       }

    }

    public function searchuser(Request $request){

           $search = $request->searchfield;

         if(Auth::user()->role == "instructor"){

            $teacherid = Auth::user()->id;


          /*  $users = UserAssignTeacher::select('users.*','user_assign_teachers.*','user_assign_teachers.id as uas_id','users.id as id')
            ->join('users','user_assign_teachers.student_id','=','users.id')->get();
        return view('admin.user.index', compact('users'));*/

     
$users = DB::table('users')
          ->select('users.*','user_assign_teachers.*','user_assign_teachers.id as uas_id','users.id as id')
          ->join('user_assign_teachers','users.id','=','user_assign_teachers.student_id')
          ->where(function($query) use($search){
            $query->where('users.fname', 'like' , '%'. $search .'%')
              ->orWhere('users.lname', 'like' , '%'. $search .'%')
              ->orWhere('users.email', 'like' , '%'. $search .'%')
              ->orWhere('users.mobile', 'like' , '%'. $search .'%');
            })
            ->where('users.role','user')
            ->get();

        //  dd($users);

           return view('admin.user.index', compact('users'));


        }

        $users = User::where('users.fname', 'like' , '%'. $search .'%')
        ->orWhere('users.fname', 'like' , '%'. $search .'%')
          ->orWhere('users.lname', 'like' , '%'. $search .'%')
          ->orWhere('users.mobile', 'like' , '%'. $search .'%')
          ->get();
      
      
        return view('admin.user.index', compact('users'));
    }


    public function createparent(){



      $students = User::where('role','user')->orderBy('created_at','DESC')->get();

    //  dd($students);

       $cities = Allcity::all();
        $states = Allstate::all();
        $countries = Country::all();
        return view('admin.user.parentadd')->with(['cities' => $cities, 'states' => $states, 'countries' => $countries,'students'=>$students]);

          // return view('admin.user.parentadd', compact('users'));

      




    }

    public function storeparent(Request $request){

        $data = $this->validate($request, [
            'fname' => 'required',
            'lname' => 'required',
            'mobile' => 'required|regex:/[0-9]{9}/',
            'address' => 'max:2000',
            'email' => 'required|unique:users,email',
            'password' => 'required|min:6|max:20',
            'status' => 'required|boolean',
            'role' => 'required',
            'student_id' =>'required'

        ]);



        $input = $request->all();

       
     
        if ($file = $request->file('user_img')) 
        {            
            $optimizeImage = Image::make($file);
            $optimizePath = public_path().'/images/user_img/';
            $image = time().$file->getClientOriginalName();
            $optimizeImage->save($optimizePath.$image, 72);
            $input['user_img'] = $image;
            
        }

        $input['password'] = Hash::make($request->password);
        $input['role'] = "parent";
        $data = User::create($input);
        $data->added_by_user_id = Auth::user()->id;
        $data->save(); 


        $updateastudent = User::where('id',$request->student_id)->first();
        $updateastudent->update([
          'parent_id' => $data->id,
        ]);



        $exists = UserAssignTeacher::where('student_id',$data->id )
        ->where('instructor_id',Auth::user()->id)
        ->first();

        if(!$exists)
        {
                $assign = new UserAssignTeacher;
        $assign->student_id = $data->id;
        $assign->instructor_id = Auth::user()->id;
        $assign->save();
        }

           Session::flash('success','Parent Added Successfully ');
        return redirect()->route('parent.index');




    }


    public function createteacher(Request $request){


     /*  $data = $this->validate($request, [
            'fname' => 'required',
            'lname' => 'required',
            'mobile' => 'required|regex:/[0-9]{9}/',
            'address' => 'max:2000',
            'email' => 'required|unique:users,email',
            'password' => 'required|min:6|max:20',
            'status' => 'required|boolean',
            'role' => 'required',
            'user_img' => 'image|mimes:jpeg,png,jpg|max:8048',
            'qualification' =>'required',
            'experiance' => 'required'

        ]);
*/

          $cities = Allcity::all();
        $states = Allstate::all();
        $countries = Country::all();
        return view('admin.user.teacheradd')->with(['cities' => $cities, 'states' => $states, 'countries' => $countries]);




    }


    public function storeTeacher(Request $request){


       $data = $this->validate($request, [
            'fname' => 'required',
            'lname' => 'required',
            'mobile' => 'required|regex:/[0-9]{9}/',
            'address' => 'required|max:2000',
            'email' => 'required|unique:users,email',
            'password' => 'required|min:6|max:20',
            'status' => 'required|boolean',
            'user_img' => 'image|mimes:jpeg,png,jpg|max:8048',
            'experience' => 'required',
            'qualification' => 'required'

        ]);




        $input = $request->all();

       
     
        if ($file = $request->file('user_img')) 
        {            
            $optimizeImage = Image::make($file);
            $optimizePath = public_path().'/images/user_img/';
            $image = time().$file->getClientOriginalName();
            $optimizeImage->save($optimizePath.$image, 72);
            $input['user_img'] = $image;
            
        }

        $input['password'] = Hash::make($request->password);
          $input['role'] = "instructor";
        $data = User::create($input);
        $data->added_by_user_id = Auth::user()->id;
        $data->save(); 



      

       
      


        // Session::flash('success','User Added Successfully ! Add Parent info');
        return redirect()->route('teacher.index')->with("success","Teacher Added");
         


    }



    
}
