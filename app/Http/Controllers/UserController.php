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

    public function viewAllUser()
    {

        if(Auth::user()->role == "instructor"){

            $teacherid = Auth::user()->id;


            $users = UserAssignTeacher::select('users.*','user_assign_teachers.*','user_assign_teachers.id as uas_id','users.id as id')
            ->join('users','user_assign_teachers.student_id','=','users.id')->get();
        return view('admin.user.index', compact('users'));
        }
      
        $users = User::all();
        return view('admin.user.index', compact('users'));
    }

    public function viewStudents()
    {

      
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
            'user_img' => 'image|mimes:jpeg,png,jpg|max:2048',

        ]);

        $parentid = 0;


        if($request->role == "user")
        {

             $data = $this->validate($request, [
             'parentfname'=>'required|string',
            'parentlname'=>'required|string',
            'parentemail'=>'required|unique:users,email',
            'parentmobile'=>'required|regex:/[0-9]{9}/',
            'parentpassword'=>'required'

        ]);



         $parent = new User();
         $parent->fname = $request->parentfname;
         $parent->lname = $request->parentlname;
         $parent->mobile = $request->parentmobile;
         $parent->email = $request->parentemail;
          $parent->role = "parent";
         $issave = $parent->save();

           $parentid = $parent->id;






            


        }


        

           // dd($parent->id);


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
        $input['parent_id'] = $parentid;
        $data = User::create($input);
        $data->added_by_user_id = Auth::user()->id;
        $data->save(); 

        Session::flash('success','User Added Successfully !');
        return redirect('user');
         

        //  else{

        //      Session::flash('error','Something Went Wrong!');
        // return redirect('user');

        //  }







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

        if($user->parent_id == 0 && $user->role == "user")
        {
            $parent = new User;
            $parent->fname = $request->parentfname;
              $parent->lname = $request->parentlname;
                $parent->email = $request->parentemail;
                 $parent->mobile = $request->parentmobile;
                 $parent->password = $request->parentpassword;
                 $parent->save();


        }
        else{

             if(isset($request->update_pass)){
          
            $input['password'] = Hash::make($request->parentpassword);
        }
        else{
            $input['password'] = "12345678";
        }




            // $parentinput = array(
            //     'fname' = $request->parentfname,
            //     'lname' = $request->parentlname,
            //     'email' = $request->parentemail,
            //     'mobile'= $request->parentmobile,
            //     'password' = $input['password'],
            // );
        }

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



    
}
