@extends('admin/layouts.master')
@section('title', 'Attendance - ALl')
@section('body')

<section class="content">
  @include('admin.message')
  <div class="row">
    <div class="col-xs-12">
      <div class="box box-primary">
        <div class="box-header with-border">
          <h3 class="box-title"> {{ __('adminstaticword.Order') }}</h3>
        </div>
        <div class="box-header with-border">

          <a class="btn btn-info btn-md" href="{{route('order.create')}}">
         <!--  <i class="glyphicon glyphicon-th-l">+</i> Enroll&nbsp; New Student</a> -->
          
        </div>
        <!-- /.box-header -->
        <div class="box-body">
          <div class="table-responsive">
            <table id="example1" class="table table-bordered table-striped">
              <thead>
                
                <br>
                <br>
                <tr>
                  <th>#</th>
                  <th>Student Nama</th>
                  <th>Course Name</th>
                  <th>Date</th>
                  <th>Time</th>
                </tr>
              </thead>
              <tbody>
              <?php $i=0;?>
              @foreach($orders as $order)
                <?php $i++;?>
                <tr>
                  <td><?php echo $i;?></td>
                  <td>{{$order->user['fname']}}</td>                 
                  <td>{{$order->courses['title']}}</td>
                  <td>{{$order->transaction_id}}</td>
                   <td>
                    <form action="{{ route('order.quick',$order->id) }}" method="POST">
                      {{ csrf_field() }}
                      <button  type="Submit" class="btn btn-xs {{ $order->status ==1 ? 'btn-success' : 'btn-danger' }}">
                        @if($order->status ==1)
                          {{ __('adminstaticword.Active') }}
                        @else
                          {{ __('adminstaticword.Deactive') }}
                        @endif
                      </button>
                    </form>
                  </td>
                   <td><a class="btn btn-primary btn-sm" href="{{route('view.order',$order->id)}}">{{ "View Profile" }}</a>
                  </td>
                   <td><a class="btn btn-warning btn-sm" href="{{route('view.order',$order->id)}}">{{"View Report" }}</a>
                  </td>
                 
                   <td><a class="btn btn-success btn-sm" href="{{route('view.order',$order->id)}}">{{"View Attendance" }}</a>
                  </td>

                

                 

                 
                  
                  <td>
                    <form  method="post" action="{{url('order/'.$order->id)}}"
                        data-parsley-validate class="form-horizontal form-label-left">
                        {{ csrf_field() }}
                        {{ method_field('DELETE') }}
                      <button type="submit" class="btn btn-danger btn-sm">
                            <i class="fa fa-fw fa-trash-o"></i>
                      </button>
                    </form>
                  </td>
                </tr>
              @endforeach 
            </table>
          </div>
        </div>
        <!-- /.box-body -->
      </div>
      <!-- /.box -->
    </div>
    <!-- /.col -->
  </div>
  <!-- /.row -->
</section>
@endsection
