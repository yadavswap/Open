@extends('admin.layouts.master')
@section('title', 'View User - Admin')
@section('body')

<section class="content">
  @include('admin.message')
  <div class="row">
    <div class="col-md-12">
      <div class="box box-primary">
        <div class="box-header with-border">
          <h3 class="box-title">{{ __('adminstaticword.Users') }}</h3>
        </div>
        <div class="box-header">

        <div class="row">
          <div class="col-md-4">
              <a class="btn btn-info btn-sm" href="{{ route('user.add') }}">+ {{ __('adminstaticword.Add') }} Student </a>
               <a class="btn btn-info btn-sm" href="{{ route('parent.add') }}">+ Add Parent</a>
          </div>
          <div class="col-md-8">
               <div class="input-group">
          <form method="post" action="{{route('user.search')}}" name="searchuser">
            @csrf
            <div class="row">
              <div class="col-md-8">  <input type="text" name="searchfield" class= "form-control" placeholder="Enter student email or mobile"></div>




<div class="col-md-2">  <input type="submit" name="search" class="btn btn-info" value="Search"></div>
            </div>
      
      

      


      </form>
    </div>
          </div>
        </div>
          
         
        </div>
        <!-- /.box-header -->
        <div class="box-body">
            <div class="table-responsive">
              <table id="example1" class="table table-bordered table-striped table-responsive">
                <thead>
                  <th>#</th>
                  <th>{{ __('adminstaticword.Image') }}</th>
                  <th>{{ __('adminstaticword.FirstName') }}</th>
                  <th>{{ __('adminstaticword.LastName') }}</th>
                  <th>{{ __('adminstaticword.Email') }}</th>
                  <th>{{ __('adminstaticword.Mobile') }}</th>
                  <th>Type</th>
                  <th>{{ __('adminstaticword.Status') }}</th>
                  <th>{{ __('adminstaticword.Edit') }}</th>
                  <th>{{ __('adminstaticword.Delete') }}</th>
                    <th>Attendance Report</th>
                  
                     <th>Watch Report</th>
                       <th>Exam Report</th>
                </thead> 

                <tbody>
                  <?php $i=0;?>

                    @foreach ($users as $user)
                      @if($user->id != Auth::User()->id)
                        <?php $i++;?>

                      <tr>
                        <td><?php echo $i;?></td>
                        <td>
                          @if($user->user_img != null || $user->user_img !='')
                            <img src="{{ url('/images/user_img/'.$user->user_img) }}" class="img-responsive">
                          @else
                            <img src="{{ asset('images/default/user.jpg')}}" class="img-responsive" alt="User Image">
                          @endif
                        </td>
                        <td>{{ $user->fname }}</td>
                        <td>{{ $user->lname }}</td>
                        <td>{{ $user->email }}</td>
                        <td>
                          {{$user->mobile}}
                        </td>
                        <td >

                          {{  ucfirst($user->role)  }}</td>
                        <td>
                          <form action="{{ route('user.quick',$user->id) }}" method="POST">
                            {{ csrf_field() }}
                            <button  type="Submit" class="btn btn-xs {{ $user->status ==1 ? 'btn-success' : 'btn-danger' }}">
                              @if($user->status ==1)
                              {{ __('adminstaticword.Active') }}
                              @else
                              {{ __('adminstaticword.Deactive') }}
                              @endif
                            </button>
                          </form>
                        </td>
                        
                        <td>
                          <a class="btn btn-success btn-sm" href="{{ route('user.update',$user->id) }}">
                            <i class="glyphicon glyphicon-pencil"></i></a>
                        </td>
                              
                        <td>

                          <?php  if(Auth::user()->role == "instructor") 
                          {

                            ?>

                               <form  method="post" action="{{ route('unassign.index',$user->id) }}
                            "data-parsley-validate class="form-horizontal form-label-left">
                            {{ csrf_field() }}
                           
                             
                              <input type="submit" value="unassign" onclick="return confirm('Are you sure unassign This User..?')" class="btn btn-sm btn-danger"/>
                            </form>

                           

                            <?php

                          }

                          else{

                            ?>

                              <form  method="post" action="{{ route('user.delete',$user->id) }}
                            "data-parsley-validate class="form-horizontal form-label-left">
                            {{ csrf_field() }}
                            {{ method_field('DELETE') }}
                             
                              <input type="submit" value="Delete" onclick="return confirm('Are you sure Delete This User..?')" class="btn btn-sm btn-danger"/>
                            </form>

                            <?php

                          }

                          ?>
                         
                        </td>

                        <td>
                          <a class="btn btn-success btn-sm" href="{{ route('attendance.view',$user->id) }}">
                            View Attendance</a>
                        </td>

                          
                       
                          
                        <td>
                          <a class="btn btn-warning btn-sm" href="{{ route('watchtime.view',$user->id) }}">
                            View Watch Time</a>
                        </td>

                         <td>
                          <a class="btn btn-info btn-sm" href="{{ route('user.update',$user->id) }}">
                            View Result</a>
                        </td>
                    </tr>
                    @endif
                    @endforeach

                </tbody>
              </table>
            </div>
          </div>
        <!-- /.box-body -->
      </div>
    </div>
    <!-- /.col -->
  </div>
  <!-- /.row -->
</section>

@endsection
