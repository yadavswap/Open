<?php

namespace App\Http\Controllers;

use App\Testimonial;
use Illuminate\Http\Request;
use DB;
use Image;

class TestimonialController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    
    public function index()
    {
        $test = Testimonial::all();
        return view('admin.testimonial.index',compact('test'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.testimonial.testi_form');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = $this->validate($request,[
            'client_name'=>'required',
            'details'=>'required|min:150|max:500',
            'image'=>'required',
            'status'=>'required',
        ]);


        $input = $request->all();
        if ($file = $request->file('image')) 
        {       
          $optimizeImage = Image::make($file);
          $optimizePath = public_path().'/images/testimonial/';
          $image = time().$file->getClientOriginalName();
          $optimizeImage->save($optimizePath.$image, 72);

          $input['image'] = $image;
          
        }



        $data = Testimonial::create($input);

        if(isset($request->status))
        {
            $data->status = '1';
        }
        else
        {
            $data->status = '0';
        }
        
        $data->save();

        return redirect('testimonial');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\testimonial  $testimonial
     * @return \Illuminate\Http\Response
     */

    public function show(testimonial $testimonial)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\testimonial  $testimonial
     * @return \Illuminate\Http\Response
     */

    public function edit($id)
    {
        $test= Testimonial::find($id);
        return view('admin.testimonial.testi_edit', compact('test'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\testimonial  $testimonial
     * @return \Illuminate\Http\Response
     */

    public function update(Request $request,$id)
    {

        $testimonial = Testimonial::findorfail($id);

        $input = $request->all();

        if ($file = $request->file('image'))
        {
            
            if($testimonial->image != "")
            {
                $content = @file_get_contents(public_path().'/images/testimonial/'.$testimonial->image);
                if ($content) {
                  unlink(public_path().'/images/testimonial/'.$testimonial->image);
                }
            }

            $name = time().$file->getClientOriginalName();
            $file->move('images/testimonial', $name);
            $input['image'] = $name;
        }

        if(isset($request->status))
        {
            $input['status'] = '1';
        }
        else
        {
            $input['status'] = '0';
        }

        $testimonial->update($input);

        return redirect('testimonial');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\testimonial  $testimonial
     * @return \Illuminate\Http\Response
     */

    public function destroy($id)
    {
        DB::table('testimonials')->where('id',$id)->delete();
        return redirect('testimonial');
    }


}
