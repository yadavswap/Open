@extends('admin.layouts.master')
@section('body')
@section('title', 'View Attendance - Student')

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
          <h3 class="box-title"> View Attendance Of Student</h3>
        </div>
        <div class="panel-body">



          <form action="" method="POST" enctype="multipart/form-data">
            {{ csrf_field() }}

            <input type="hidden" name="id" value="{{$users->id}}">

            <div class="row">
              <div class="col-md-12">
                  <label for="role">Select Month: <sup class="redstar">*</sup></label>
                <select class="form-control js-example-basic-single" name="student_id" required id="monthselect">
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
            </div>

            <br/>

             <div class="row">

               <div class="col-md-2">
                   <b>Total Days : </b>  <button class="btn btn-xs btn-info" type="button">{{$totaldays}}</button>
               </div>

              <div class="col-md-2">
              <b>Total Present : </b>  <button class="btn btn-xs btn-success" type="button">{{$totalpresent}}</button>
              </div>
                  <div class="col-md-2">
                     <b>Total Absent : </b>  <button class="btn btn-xs btn-danger" type="button">{{$totalabsent}}</button>
                  </div>
                     
             </div>

             <br/>

             <div class="row">

            <div class="container">

               <div class="col-md-8">
               
             </div>
              
            </div>
            

             </div>




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

<script type="application/javascript">
var eventData = 
 <?=$attendancearray;?>
;
$(document).ready(function () {
  $("#demo").zabuto_calendar({
    data: eventData,
     nav_icon: {
      prev: '<i class="fa fa-chevron-circle-left"></i>',
      next: '<i class="fa fa-chevron-circle-right"></i>'
    },
        cell_border: true,
  });
});

var now = new Date();
var year = now.getFullYear();
var month = now.getMonth() + 1;
var settings = {
    language: false,
    year: year,
    month: month,
    show_previous: true,
    show_next: true,
    cell_border: true,
    today: false,
    show_days: true,
    weekstartson: 1,
    nav_icon: false, // object: prev: string, next: string
    data: false,
    ajax: false, // object: url: string, modal: boolean,
    legend: false, // object array, [{type: string, label: string, classname: string}]
    action: false, // function
    action_nav: false // function
};

</script>

  


 <script>  
 $(document).ready(function(){  
      $('#employee_data').DataTable();  
 });  
 </script> 


<script>





(function($) {
  "use strict";

  $('#married_status').change(function() {
      
    if($(this).val() == 'Married')
    {
      $('#doaboxxx').show();
    }
    else
    {
      $('#doaboxxx').hide();
    }
  });

  $(function() {
    $( "#dob,#doa" ).datepicker({
      changeYear: true,
      yearRange: "-100:+0",
      dateFormat: 'yy/mm/dd',
    });
  });

  tinymce.init({selector:'textarea#detail'});

  $(function() {
    var urlLike = '{{ url('country/dropdown') }}';
    $('#country_id').change(function() {
      var up = $('#upload_id').empty();
      var cat_id = $(this).val(); 
      if(cat_id){
        $.ajax({
          headers: {
          'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
          },
          type:"GET",
          url: urlLike,
          data: {catId: cat_id},
          success:function(data){   
            console.log(data);
            up.append('<option value="0">Please Choose</option>');
            $.each(data, function(id, title) {
              up.append($('<option>', {value:id, text:title}));
            });
          },
          error: function(XMLHttpRequest, textStatus, errorThrown) {
            console.log(XMLHttpRequest);
          }
        });
      }
    });
  });

  $(function() {
    var urlLike = '{{ url('country/gcity') }}';
    $('#upload_id').change(function() {
      var up = $('#grand').empty();
      var cat_id = $(this).val();    
      if(cat_id){
        $.ajax({
          headers: {
          'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
          },
          type:"GET",
          url: urlLike,
          data: {catId: cat_id},
          success:function(data){   
            console.log(data);
            up.append('<option value="0">Please Choose</option>');
            $.each(data, function(id, title) {
              up.append($('<option>', {value:id, text:title}));
            });
          },
          error: function(XMLHttpRequest, textStatus, errorThrown) {
            console.log(XMLHttpRequest);
          }
        });
      }
    });
  });
})(jQuery);
</script>

@endsection
