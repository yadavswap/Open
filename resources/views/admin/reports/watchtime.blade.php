@extends('admin.layouts.master')
@section('body')
@section('title', 'View Watch Time Of Student - Student')

@if ($errors->any())
<div class="alert alert-danger">
  <ul>
    @foreach ($errors->all() as $error)
    <li>{{ $error }}</li>
    @endforeach
  </ul>
</div>
@endif

@if ($success = Session::get('success')))
<div class="alert alert-success">
 <strong>{{ $success }}</strong>
</div>
@endif
 
<section class="content">
  <div class="row">
    <div class="col-md-12">
      <div class="box box-primary">
        <div class="box-header with-border">
          <h3 class="box-title"> View Watch Log Of Student</h3>
        </div>
        <div class="panel-body">



          <form action="{{route('attendance.export',$users->id)}}" method="POST" enctype="multipart/form-data">
            {{ csrf_field() }}

            <input type="hidden" name="id" value="{{$users->id}}">

            <div class="row">
              <div class="col-md-6">
                  <label for="role">Select Month: <sup class="redstar">*</sup></label>
                <select class="form-control js-example-basic-single" name="month" required id="monthselect">
                  <option value="none" selected disabled hidden> 
                   {{ __('adminstaticword.SelectanOption') }}
                  </option>


            

                  <option value="01">Jan</option>
                      <option value="01">Feb</option>
                          <option value="03">March</option>
                              <option value="04">April</option>
                                  <option value="05">May</option>
                                      <option value="06">June</option>
                                          <option value="07">July</option>
                                              <option value="08">August</option>
                                                  <option value="09">Sept</option>
                                                      <option value="10">Oct</option>
                                                          <option value="11">Nov</option>
                                                              <option value="12">December</option>


              
                 
                </select>
              </div>
              <!--  -->

               <div class="col-md-6">
                  <label for="role">Select Course: <sup class="redstar">*</sup></label>
                <select class="form-control js-example-basic-single" name="month" required id="monthselect">
                  <option value="none" selected disabled hidden> 
                   {{ __('adminstaticword.SelectanOption') }}
                  </option>


            

                 
                 


              
                 
                </select>
              </div>

            </div>

            <br/>

             <div class="row">

               <div class="col-md-3">
                   <b>Total Attended Courses : </b>  <button class="btn btn-xs btn-info" type="button">3 Courses</button>
               </div>

              <div class="col-md-3">
              <b>Total Attended Lectures : </b>  <button class="btn btn-xs btn-success" type="button">2 Lectures</button>
              </div>

                <div class="col-md-4">
              <b>Total Minutes Watched This Month : </b>  <button class="btn btn-xs btn-warning" type="button">0 Minutes</button>
              </div>
               
                     
             </div>

             <br/>
              <br/>

             <div class="row">

          

               <div class="col-md-12">

<!-- Table start -->


 <div class="table-responsive">
              <table id="example2" class="table table-bordered table-striped table-responsive">
                <thead>
                  <th>#</th>
                  <th>Lecture Name</th>
                  <th>Start Time</th>
                  <th>End Time</th>
                  <th>Total Minutes Spent</th>
                

                <tbody>
                 

                      <tr>
                        <td>1</td>
                        <td>Sample Lecture</td>
                        <td>11:00:22 am</td>
                        <td>12:00:10 pm</td>
                        <td>60 Mins</td>
                        <td>
                        </td>
                 
                        

                     

                    </tr>
                 

                </tbody>
              </table>
            </div>





                <!-- Table End -->
               
             </div>
              
       
            

             </div>

             <br/>
                <br/>
                   <br/>




            <div class="row">
                  <div class="col-md-4 col-4">
                <label for="lname">
                Image
                </label>
              <div class="edit-user-img">
                    <img src="{{ url('/images/user_img/'.$users->user_img) }}" class="img-fluid" alt="User Image">
                  </div>
              </div>

              <div class="col-md-4 col-4">
                 <label for="fname">
                {{ __('adminstaticword.FirstName') }}:<sup class="redstar">*</sup>
                </label>
                <input value="{{$users->fname}}" autofocus required name="fname" type="text" class="form-control" placeholder="Enter your first name" disabled="disabled" />
              </div>
              <div class="col-md-4 col-4">
                <label for="lname">
                  {{ __('adminstaticword.LastName') }}:<sup class="redstar">*</sup>
                </label>
                <input value="{{$users->lname}}" required name="lname" type="text" class="form-control" placeholder="Enter your last name" disabled="disabled" />
              </div>


            </div>
            <br>

            <div class="row">

              <div class="col-md-12">
                
                  <span style="font-family: Monaco, Menlo, Consolas, 'Courier New', monospace; font-size: 13px; line-height: 18px; white-space: pre-wrap; background-color: rgb(255, 255, 255);"><div id="demo"></div></span>
                  

              </div>

            </div>

            
           


          

         
            <br>

        
            <div class="box-footer">
              <button type="button" class="btn btn-md btn-primary">
                <i class="fa fa-plus-circle" onclick="alert('Updates Under Process')"></i> Export Report
              </button>
            </form>
              <a href="{{ route('user.index') }}" title="Cancel and go back" class="btn btn-md btn-default btn-flat">
                <i class="fa fa-reply"></i> {{ __('adminstaticword.Back') }}
              </a>
            </div>
            <br>

          
        </div>
        <!-- /.panel body -->
      </div>
      <!-- /.box -->
    </div>
    <!-- /.col -->
  </div>
  <!-- /.row -->
</section>

@endsection


@section('scripts')


  



<script>




  $(function() {
    $( "#dob,#doa" ).datepicker({
      changeYear: true,
      yearRange: "-100:+0",
      dateFormat: 'yy/mm/dd',
    });
  });

  tinymce.init({selector:'textarea#detail'});


</script>

@endsection
