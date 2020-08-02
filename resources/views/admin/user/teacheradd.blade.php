@extends('admin.layouts.master')
@section('body')
@section('title', 'ADD User - Admin')

@if ($errors->any())
<div class="alert alert-danger">
  <ul>
    @foreach ($errors->all() as $error)
    <li>{{ $error }}</li>
    @endforeach
  </ul>
</div>
@endif
 
<section class="content">
  <div class="row">
    <div class="col-md-12">
      <div class="box box-primary">
        <div class="box-header with-border">
          <h3 class="box-title"> ADD TEACHER</h3>
        </div>
        <div class="panel-body">
          <form action="{{ route('teacher.store') }}" method="POST" enctype="multipart/form-data">
            {{ csrf_field() }}

            <div class="row">
              <div class="col-md-6 col-6">
                 <label for="fname">
                {{ __('adminstaticword.FirstName') }}:<sup class="redstar">*</sup>
                </label>
                <input value="{{ old('fname') }}" autofocus required name="fname" type="text" class="form-control" placeholder="Enter your first name"/>
              </div>
              <div class="col-md-6 col-6">
                <label for="lname">
                  {{ __('adminstaticword.LastName') }}:<sup class="redstar">*</sup>
                </label>
                <input value="{{ old('lname')}}" required name="lname" type="text" class="form-control" placeholder="Enter your last name"/>
              </div>
            </div>
            <br>

            <div class="row">
              <div class="col-md-6">
                 <label for="mobile">{{ __('adminstaticword.Email') }}: <sup class="redstar">*</sup></label>
                  <input value="{{ old('email')}}" required type="email" name="email" placeholder="Enter your email" class="form-control">
              </div>
              <div class="col-md-6">
                <label for="mobile">{{ __('adminstaticword.Mobile') }}: <sup class="redstar">*</sup></label>
                <input value="{{ old('mobile')}}" required type="text" name="mobile" placeholder="Enter your mobile number" class="form-control">
              </div>
            </div>
            <br>

            <div class="row">
              <div class="col-md-6">
                <label for="exampleInputDetails">{{ __('adminstaticword.Address') }}:<sup class="redstar">*</sup></label>
                <textarea name="address" rows="1"  class="form-control" placeholder="Enter your address" value="{{old('address')}}"></textarea>
              </div>
              <div class="col-md-6">
                <label for="dob">{{ __('adminstaticword.DateofBirth') }}:<sup class="redstar">*</sup></label>
                <div class="input-group date">
                  <div class="input-group-addon">
                    <i class="fa fa-calendar"></i>
                  </div>
                  <input type="text" value="{{ old('dob')}}" name="dob" required class="form-control pull-right" id="dob" placeholder="Enter your date of birth" autocomplete="off">
                </div>

              </div>
            </div>
            <br>

            <div class="row">
              <div class="col-md-6">
                <label for="gender">{{ __('adminstaticword.Gender') }}: <sup class="redstar">*</sup></label>
                
                <br>
                <input type="radio" name="gender" id="ch1" value="m" required> {{ __('adminstaticword.Male') }}
                <input type="radio" name="gender" id="ch2" value="f"> {{ __('adminstaticword.Female') }}
                <input type="radio" name="gender" id="ch3" value="o"> {{ __('adminstaticword.Other') }}
              </div>
              <div class="col-md-6">
                <label for="mobile">{{ __('adminstaticword.Password') }}: <sup class="redstar">*</sup> </label>
                <input required type="password" name="password" placeholder="Enter your password" class="form-control">
              </div>
            </div>
            <br>

            <div class="row">
              <div class="col-md-3">
                <label for="city_id">{{ __('adminstaticword.Country') }}: <sup class="redstar">*</sup> </label>
                <select id="country_id" class="form-control js-example-basic-single" name="country_id">
                  <option value="none" selected disabled hidden> 
                    {{ __('adminstaticword.SelectanOption') }} 
                  </option>
                  @foreach ($countries as $coun)
                    <option value="{{ $coun->country_id }}" >{{ $coun->nicename }}</option>
                  @endforeach
                </select>
              </div>
            
              <div class="col-md-3">
                <label for="state_id">{{ __('adminstaticword.State') }}: <sup class="redstar">*</sup> </label>
                <select id="upload_id" class="form-control js-example-basic-single" name="state_id">
                 
                </select>
               </div>

              <div class="col-md-3">
                <label for="city_id">{{ __('adminstaticword.City') }}: <sup class="redstar">*</sup> </label>
                <select id="grand" class="form-control js-example-basic-single" name="city_id">
                  
                </select>
              </div>
              <div class="col-md-3"> 
                <label for="pin_code">{{ __('adminstaticword.Pincode') }}:</sup></label>
                <input value="{{ old('pin_code')}}" placeholder="Enter your pincode" type="text" name="pin_code" class="form-control">
              </div>
            </div>

              <div class="row">
              <div class="col-md-4">
                <label for="qualification">Qualification : <sup class="redstar">*</sup> </label>

                   <input value="{{ old('qualification')}}" placeholder="Enter Qualification" type="text" name="qualification" class="form-control">
               
              </div>
         
              
              <div class="col-md-4"> 
                <label for="pin_code">Experience: <sup>*</sup></label>
                <input value="{{ old('experience')}}" placeholder="Enter Experience" type="text" name="experience" class="form-control">
              </div>
            </div>
            <br>

            <div class="row">
              <div class="col-md-3">
                <label for="exampleInputSlug">{{ __('adminstaticword.Image') }}: <sup class="redstar">*</sup></label>
                <br>
                <input type="file" name="user_img" id="user_img" class="inputfile inputfile-1" required />
                <label for="user_img"><svg xmlns="http://www.w3.org/2000/svg" width="20" height="17" viewBox="0 0 20 17"><path d="M10 0l-5.2 4.9h3.3v5.1h3.8v-5.1h3.3l-5.2-4.9zm9.3 11.5l-3.2-2.1h-2l3.4 2.6h-3.5c-.1 0-.2.1-.2.1l-.8 2.3h-6l-.8-2.2c-.1-.1-.1-.2-.2-.2h-3.6l3.4-2.6h-2l-3.2 2.1c-.4.3-.7 1-.6 1.5l.6 3.1c.1.5.7.9 1.2.9h16.3c.6 0 1.1-.4 1.3-.9l.6-3.1c.1-.5-.2-1.2-.7-1.5z"/></svg> <span>{{ __('adminstaticword.Chooseafile') }}&hellip;</span>
              </div>
              <div class="col-md-3"> 
                <label for="role">{{ __('adminstaticword.SelectRole') }}: <sup class="redstar">*</sup></label>
                <select class="form-control js-example-basic-single" name="role" required id="roleselect" disabled="disabled">
                  <option value="none" selected disabled hidden> 
                   {{ __('adminstaticword.SelectanOption') }}
                  </option>


                
                  <option value="instructor" selected="">Teacher</option>
                </select>
              </div> 
           
              <div class="col-md-3 display-none" id="doaboxxx">
                <label for="dob">{{ __('adminstaticword.DateofAnniversary') }}: <sup class="redstar">*</sup></label>
                  <input value="{{ old('doa')}}" name="doa" id="doa" type="text" class="form-control" placeholder="Enter your date of anniversary">


              </div>
            </div>
            <br>
            

            <div class="row">
              <div class="col-md-3">
                <label for="exampleInputDetails">{{ __('adminstaticword.Verified') }}:</label> 
                <li class="tg-list-item">
                
                <input class="tgl tgl-skewed" id="jeet1"   type="checkbox"/>
                <label class="tgl-btn" data-tg-off="Off" data-tg-on="On" for="jeet1"></label>
                
                </li>
                <input type="hidden" name="verified" value="0" id="jeet11"> 
           
                </div>
              <div class="col-md-3">
                <label for="exampleInputDetails">{{ __('adminstaticword.Status') }}:</label>
                <li class="tg-list-item">     
                <input class="tgl tgl-skewed" id="jeet120"  type="checkbox"/>
                <label class="tgl-btn" data-tg-off="Deactive" data-tg-on="Active" for="jeet120"></label>
                </li>
                <input type="hidden" name="status" value="0" id="jeet121">
              </div>
            </div>
            <br>

            <br>
            <br>

        
            <div class="box-footer">
              <button type="submit" class="btn btn-md btn-primary">
                <i class="fa fa-plus-circle"></i> Add New Teacher
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




   $("#roleselect").change(function(){

     var role = $(this).val();

    if(role == "instructor")
    {
      $('#parentinfo').hide();
    }

   });




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