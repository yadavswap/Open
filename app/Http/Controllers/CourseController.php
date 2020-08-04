<?php

namespace App\Http\Controllers;

use App\Course;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use DB;
use Image;
use App\CourseInclude;
use App\WhatLearn;
use App\CourseChapter;
use App\RelatedCourse;
use App\CourseClass;
use App\Categories;
use App\User;
use App\Wishlist;
use App\ReviewRating;
use App\Question;
use App\Announcement;
use App\Order;
use App\Answer;
use App\Cart;
use App\ReportReview;
use App\SubCategory;
use Session;
use App\QuizTopic;
use App\Quiz;
use Auth;
use Redirect;
use App\Attendance;
use App\Helpers\AttendanceHelper;
use App\WatchTime;
use App\Assignment;

class CourseController extends Controller
{
    
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function index()
    {
        $course = Course::all();
        $coursechapter = CourseChapter::all();
           
        return view('admin.course.index',compact("course",'coursechapter'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function create()
    {
        $category = Categories::all();
        $user =  User::all();
        $course = Course::all();
        $coursechapter = CourseChapter::all();
        return view('admin.course.insert',compact("course",'coursechapter','category','user')); 
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */

    public function store(Request $request)
    {

        $this->validate($request,[
            'category_id' => 'required',
            'subcategory_id' => 'required',
            'title' => 'required',
            'short_detail' => 'required',
            'detail' => 'required',
            'video' => 'mimes:mp4,avi,wmv',

      
        ]);

        $input = $request->all();

        $data = Course::create($input); 

        if(isset($request->type))
        {
          $data->type = "1";
        }
        else
        {
          $data->type = "0";
        }


        if($file = $request->file('preview_image')) 
        {        
          $optimizeImage = Image::make($file);
          $optimizePath = public_path().'/images/course/';
          $image = time().$file->getClientOriginalName();
          $optimizeImage->save($optimizePath.$image, 72);

          $data->preview_image = $image;
          
        }


        if(isset($request->preview_type))
        {
          $data->preview_type = "video";
        }
        else
        {
          $data->preview_type = "url";
        }

                    
        if(!isset($request->preview_type))
        {
            $data->url = $request->url;
        }
        else if($request->preview_type )
        {
            if($file = $request->file('video'))
            {
                
              $filename = time().$file->getClientOriginalName();
              $file->move('video/preview',$filename);
              $data->video = $filename;
            }
        }


        $slug = str_slug($request->title,'-');
        $data->slug = $slug;

        $data->save();

        return redirect('course')->with('courseid',$data->id);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\course  $course
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        
        $cor = Course::find($id);
        return view('admin.course.editcor',compact('cor'));
        
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\course  $course
     * @return \Illuminate\Http\Response
     */

    public function edit(course $course)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\course  $course
     * @return \Illuminate\Http\Response
     */

    public function update(Request $request, $id)
    {

        $request->validate([
          'title' => 'required',
          'video' => 'mimes:mp4,avi,wmv'

        ]);

          
        $course = Course::findOrFail($id);
        $input = $request->all();
           


        if(isset($request->type))
        {
          $input['type'] = "1";
        }
        else
        {
          $input['type'] = "0";
        }

        
        if ($file = $request->file('image')) {
          
          if($course->preview_image != null) {
            $content = @file_get_contents(public_path().'/images/course/'.$course->preview_image);
            if ($content) {
              unlink(public_path().'/images/course/'.$course->preview_image);
            }
          }

          $optimizeImage = Image::make($file);
          $optimizePath = public_path().'/images/course/';
          $image = time().$file->getClientOriginalName();
          $optimizeImage->save($optimizePath.$image, 72);

          $input['preview_image'] = $image;
          
        }


        if(isset($request->preview_type))
        {
          $input['preview_type'] = "video";
        }
        else
        {
          $input['preview_type'] = "url";
        }

        
        if(!isset($request->preview_type))
        {
            $course->url = $request->video_url;
            $course->video = null;
            
        }
        else if($request->preview_type )
        {
            if($file = $request->file('video'))
            {
              if($course->video != "")
              {
                $content = @file_get_contents(public_path().'/video/preview/'.$course->video);
                if ($content) {
                  unlink(public_path().'/video/preview/'.$course->video);
                }
              }
              
              $filename = time().$file->getClientOriginalName();
              $file->move('video/preview',$filename);
              $input['video'] = $filename;
              $course->url = null;

            }
        }

        $slug = str_slug($input['title'],'-');
        $input['slug'] = $slug;

       

        Cart::where('course_id', $id)
         ->update([
             'price' => $request->price,
             'offer_price' => $request->discount_price,
          ]);


        $course->update($input);

        return redirect('course');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\course  $course
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {

      $order = Order::where('course_id', $id)->get();

      if(!$order->isEmpty())
      {
        return back()->with('delete','Users are Enrolled in Course' );
      }
      else{
        
        $course = Course::find($id);
        
        if ($course->preview_image != null)
        {
                
            $image_file = @file_get_contents(public_path().'/images/course/'.$course->preview_image);

            if($image_file)
            {
                unlink(public_path().'/images/course/'.$course->preview_image);
            }
        }
        if ($course->video != null)
        {
                
            $video_file = @file_get_contents(public_path().'/video/preview/'.$course->video);

            if($video_file != null)
            {
                unlink(public_path().'/video/preview/'.$course->video);
            }
        }

        $value = $course->delete();


        Wishlist::where('course_id', $id)->delete();
        Cart::where('course_id', $id)->delete();
        ReviewRating::where('course_id', $id)->delete();
        Question::where('course_id', $id)->delete();
        Answer::where('course_id', $id)->delete();
        Announcement::where('course_id', $id)->delete();
        CourseInclude::where('course_id', $id)->delete();
        WhatLearn::where('course_id', $id)->delete();
        CourseChapter::where('course_id', $id)->delete();
        RelatedCourse::where('course_id', $id)->delete();
        CourseClass::where('course_id', $id)->delete();
        
        return back()->with('delete','Course is Deleted');
      }

    }

    public function upload_info(Request $request) 
    {

        $id = $request['catId'];
        $category = Categories::findOrFail($id);
        $upload = $category->subcategory->where('category_id',$id)->pluck('title','id')->all();

        return response()->json($upload);
    }


    public function gcato(Request $request) 
    {

      $id = $request['catId'];

      $subcategory = SubCategory::findOrFail($id);
      $upload = $subcategory->childcategory->where('subcategory_id',$id)->pluck('title','id')->all();

      return response()->json($upload);
    }

    public function showCourse($id)
    {   
        $course = Course::all();
        
        $cor = Course::findOrFail($id);
       
        $courseinclude = CourseInclude::where('course_id','=',$id)->get();
        $coursechapter = CourseChapter::where('course_id','=',$id)->get();
        $whatlearns = WhatLearn::where('course_id','=',$id)->get();
        $coursechapters = CourseChapter::where('course_id','=',$id)->get();
        $relatedcourse = RelatedCourse::where('main_course_id','=',$id)->get();
        $courseclass = CourseClass::where('course_id','=',$id)->get();
        $announsments = Announcement::where('course_id','=',$id)->get();
        $reports = ReportReview::where('course_id','=',$id)->get();
        $questions = Question::where('course_id','=',$id)->get();
        $answers = Answer::where('course_id','=',$id)->get();
        $quizes = Quiz::where('course_id','=',$id)->get();
        $topics = QuizTopic::where('course_id','=',$id)->get();
        $assignments = Assignment::Where('course_id','=',$id)->get();
        return view('admin.course.show',compact('cor','course','courseinclude','whatlearns','coursechapters','coursechapter','relatedcourse','courseclass', 'announsments', 'answers', 'reports', 'questions', 'quizes', 'topics','assignments' ));
    }



    public function CourseDetailPage($id, $slug)
    {
        
      $course = Course::findOrFail($id);
       
      $courseinclude = CourseInclude::where('course_id','=',$id)->get();
      $whatlearns = WhatLearn::where('course_id','=',$id)->get();
      $coursechapters = CourseChapter::where('course_id','=',$id)->get();
      $relatedcourse = RelatedCourse::where('main_course_id','=',$id)->get();
      $coursereviews = ReviewRating::where('course_id','=',$id)->get();
      $courseclass = CourseClass::get();
      $reviews = ReviewRating::where('course_id','=',$id)->get();
      return view('front.course_detail',compact('course','courseinclude','whatlearns','coursechapters','courseclass', 'coursereviews', 'reviews', 'relatedcourse'));

    }

    public function CourseContentPage($id)
    {

      

      $course = Course::findOrFail($id);
       
      $courseinclude = CourseInclude::where('course_id','=',$id)->get();
      $whatlearns = WhatLearn::where('course_id','=',$id)->get();
      $coursechapters = CourseChapter::where('course_id','=',$id)->get();
      $coursequestions = Question::where('course_id','=',$id)->get();
      $courseclass= CourseClass::get();
      $announsments = Announcement::where('course_id','=',$id)->get();

      if(Auth::check())
      {
          $atn_obj = new AttendanceHelper();
          $atn_obj->studentAttendance();
          $watchtime = new WatchTime;
          $watchtime->user_id = Auth::user()->id;
          $watchtime->course_id = $id;
          $watchtime->starts_at_date = date('Y-m-d');
          $watchtime->starts_at_time = date("h:i:s");
          $watchtime->save();


           if(Session::get('watchcourseid'))
          {
            Session::forget('watchcourseid');
            Session::put('watchcourseid', $watchtime->id);
          }

        Session::put('watchcourseid', $watchtime->id);

         

        return view('front.course_content',compact('course','courseinclude','whatlearns','coursechapters','courseclass', 'coursequestions', 'announsments'));
      }
     
      return Redirect::route('login')->withInput()->with('delete', 'Please Login to access restricted area.'); 
     

    }


    public function stopCourse(){


       $watchcourseid = Session::get('watchcourseid');
        $stopclass = WatchTime::where('id',$watchcourseid)->first();

        if($stopclass){
            $stopclass->update(['ends_at_date' => date('Y-m-d'),
                'ends_at_time'=>date("h:i:s")
        ]);
             Session::forget('watchcourseid');
        }

        return redirect()->route('dashboard');


    }

    public function mycoursepage()
    {
      $course = Course::all();
      $enroll = Order::all();
      return view('front.my_course',compact('course', 'enroll'));
    }

    private function userNteacherAttendance(){

    
       

    }


    public function createAssignment(Request $request){

              $request->validate([

            'file' => 'required|max:10400',

        ]);


                      $fileName = time().'.'.$request->file->extension();  

   

        $request->file->move(public_path('uploads'), $fileName);

       // dd($fileName);



  


      $id = $request->course_id;

      $coursedata = Course::findOrFail($id);

      $assignment = new Assignment;
      $assignment->course_id = $id;
      $assignment->teacher_id = Auth::user()->id;
      $assignment->assignment_title = $request->assignment_title;
      $assignment->assignment_data = $request->assignment_details;
      $assignment->submission_time = $request->submission_date;
      $assignment->file_path = $fileName;
      $assignment->save();

      return redirect()->back()->with('success',"Assignment Added Succesfully.");

    }

    public function deleteassignment($id){


        $assignment = Assignment::findOrFail($id);


  
        $assignment->delete();
        return back()->with('delete','Deleted successfully' );
     

     }





       
}
