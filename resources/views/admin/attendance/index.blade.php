@extends('admin.layouts.master')
@section('title', 'View User - Admin')
@section('body')

<section class="content">
  @include('admin.message')
  <div class="row">
    <div class="col-md-12">
      <div class="box box-primary">
        <div class="box-header with-border">
          <div class="row">
            <div class="col-md-6">
                <h3 class="box-title">Todays Attendance:  <p class="pull-right">  (Date : <b class="btn btn-warning btn-xs">{{$date}} </b> )</p>
</h3>
            </div>
            <div class="col-md-6">

            
             <p class="pull-right"> Total Present : <b class=" btn btn-success btn-md"> {{$count}} </b></p>
            </div>
          </div>


          <div class="row">
            <div class="col-md-6"></div>
            <div class="col-md-6">
               <form action="/hms/accommodations" method="GET" class=""> 
  <div class="row">
    <div class="col-xs-12 col-md-12">
      <div class="input-group">
        <input type="text" class="form-control" placeholder="Select Date" id="selectdate" name="selectdate" />
        <div class="input-group-btn">
          <button class="btn btn-primary" type="submit">
            <span class="glyphicon glyphicon-search"></span>
          </button>
        </div>
      </div>
    </div>
  </div>
</form>
            </div>
          </div>


        
        </div>



      
        <div class="box-body">
            <div class="table-responsive">
              <table id="example1" class="table table-bordered table-striped table-responsive">
                <thead>
                  <th>Sr No.</th>
                  <th>{{ __('adminstaticword.Image') }}</th>
                  <th>{{ __('adminstaticword.FirstName') }}</th>
                  <th>{{ __('adminstaticword.LastName') }}</th>
                  <th>{{ __('adminstaticword.Email') }}</th>
                     <th>Date</th>
                       <th>Time</th>
              
                </thead> 

                <tbody>

                    <?php $i=0;?>

                    @foreach ($users as $user)


                           <tr>
                        <td>{{$i}}</td>
                        <td> <img src="{{ url('/images/user_img/'.$user->user_img) }}" class="img-responsive"></td>
                       <td>{{ $user->fname }}</td>
                        <td>{{ $user->lname }}</td>
                        <td>{{ $user->email }}</td>
                        <td>{{ $user->fname }}</td>
                        <td>{{$user->attendance_date}}</td>
                          <td>{{$user->attendance_time}}</td>
                       
                        
                     
                        <?php $i++;?>
                    </tr>
                 



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

<script type="text/javascript">
  
   $(function() {
    $( "#selectdate" ).datepicker({
      changeYear: true,
      yearRange: "-100:+0",
      dateFormat: 'yy/mm/dd',
    });
  });


</script>

@endsection
