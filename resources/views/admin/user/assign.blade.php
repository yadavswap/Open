@extends('admin.layouts.master')
@section('title', 'View User - Admin')
@section('body')


@foreach (['danger', 'warning', 'success', 'info'] as $key)
 @if(Session::has($key))
     <p class="alert alert-{{ $key }}">{{ Session::get($key) }}</p>
 @endif
@endforeach


<section class="content">
  @include('admin.message')
  <div class="row">
    <div class="col-md-12">
      <div class="box box-primary">
        <div class="box-header with-border">
          <h3 class="box-title">{{ __('adminstaticword.Users') }}</h3>
        </div>
        <div class="box-header">

          <a class="btn btn-info btn-sm" href="{{ route('user.add') }}">+ {{ __('adminstaticword.Add') }} {{ __('adminstaticword.User') }}</a>
          
            <div class="input-group pull-right">
      
    </div>
        </div>
        <!-- /.box-header -->
        <div class="box-body">

          <div class="row">
            <div class="col-md-6">
                <form action="" method="post">
                @csrf
               
            <div class="form-group row">
              <label for="" class="col-sm-2 form-control-label">Select Student</label>
              <div class="col-sm-10">
                <select class="form-control selectpicker" id="select-student" data-live-search="true" name="student">

                  @foreach($users as $user)

                  <option value="{{$user->id}}">{{$user->fname}} {{$user->lname}} -({{$user->email}})</option>



                  @endforeach
               
                </select>

              </div>
            </div>
        

            </div> 
              <div class="col-md-6">
                



            <div class="form-group row">
              <label for="" class="col-sm-2 form-control-label">Select Teacher</label>
              <div class="col-sm-10">
                <select class="form-control selectpicker" id="select-student" data-live-search="true" name="teacher">

                  @foreach($teachers as $teacher)

                  <option value="{{$teacher->id}}">{{$teacher->fname}} {{$teacher->lname}} -({{$teacher->email}})</option>



                  @endforeach
               
                </select>

              </div>
            </div>



              </div> 
          </div>

          <center>
          <div class="row">
            

                   <button type="submit" name="submit" class="btn btn-md btn-info">Assign</button>
                
              </form>
           
            </div>
          </center>

        
          </div>
        <!-- /.box-body -->
      </div>
    </div>
    <!-- /.col -->
  </div>
  <!-- /.row -->
</section>


@endsection
