<?php

namespace App\Http\Controllers;

use App\Wishlist;
use Illuminate\Http\Request;
use DB;
use Auth;
use App\User;
use App\Course;
use App\Order;

class WishlistController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function index()
    {
        $wishlist = Wishlist::all();
        return view('admin.wishlist.index',compact("wishlist"));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $user =  User::all();
        $course =  Course::all();
        return view('admin.wishlist.insert',compact('user','course')); 
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        DB::table('wishlists')->insert(
        array(
             
            'course_id' => $request->course,
            'user_id' => $request->user_id,
            'status' => $request->status,
            )
        );

        return redirect('wishlist');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\wishlist  $wishlist
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $wishlist = Wishlist::find($id);
        $user =  User::all();
        $course = Course::all();
        return view('admin.wishlist.edit',compact('wishlist','course','user'));
   
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\wishlist  $wishlist
     * @return \Illuminate\Http\Response
     */
    public function edit(wishlist $wishlist)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\wishlist  $wishlist
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request,  $id)
    {
        DB::table('wishlists')->where('id',$id)
            ->update([
  
            'status'=> $request->get('status'),
            'course_id' => $request->get('course'),
            'user_id' => $request->get('user'), 
        ]);

        return redirect('wishlist');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\wishlist  $wishlist
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        DB::table('wishlists')->where('id',$id)->delete();
     
        return back();
    }

    public function wishlist(Request $request,$id)
    {
        
        $orders = Order::where('user_id', Auth::User()->id)->where('course_id', $id)->first();
        $wishlist = Wishlist::where('course_id', $request->course_id)->where('user_id', $request->user_id)->first();

        if(isset($orders)){

            return back()->with('delete','You Already purchased this course !');
        }
        else{


            if(!empty($wishlist)){
                return back()->with('delete','Course is already in wishlist !');
            }
            else{

                DB::table('wishlists')->where('id',$id)
                ->insert([

                    'course_id' => $request->course_id,
                    'user_id'   => Auth::User()->id,
                ]);
            }
            return back()->with('success','Course is added to your wishlist !');
        }

        return back()->with('success','Course is added to your wishlist !');
    }

    public function removewishlist(Request $request,$id)
    {
        DB::table('wishlists')->where('course_id', $id)->where('user_id', $request->user_id)->delete();
        return back()->with('delete','Course is deleted from your wishlist');
    }

    public function wishlistpage(Request $request)
    {
        $course = Course::all();
        $wishlist = Wishlist::get();
        return view('front.wishlist',compact('wishlist', 'course'));
    }

    public function deletewishlist($id)
    {
        
        DB::table('wishlists')->where('id', $id)->delete();
        return back()->with('delete','Course is deleted from your wishlist');;
    }


}
