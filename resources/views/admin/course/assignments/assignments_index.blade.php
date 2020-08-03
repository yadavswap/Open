<section class="content">
 
  <div class="row">
    <div class="col-md-12">
      <a data-toggle="modal" data-target="#myModalas" href="#" class="btn btn-info btn-sm">+ {{ __('adminstaticword.Add') }}</a>
      <br>
      <br>
      <table id="example1" class="table table-bordered table-striped">
        <thead>
          <tr>
            <th>Sr No</th>
            <th>Assignment Title</th>
            <th>Assignment Detail</th>

            <th>Submission Time</th>
             <th>Status</th>
               <th>Download</th>
            <th>{{ __('adminstaticword.Delete') }}</th>
          </tr>
        </thead>
        <tbody>
        
            <tr>
              @foreach($assignments as $assignment)

                <td>1</td>
              <td>{{$assignment->assignment_title}}</td>
               <td>{{$assignment->assignment_data}}</td>
                <td>{{$assignment->submission_time}}</td>
                 <td>
                <form action="{{route('assignment.add')}}" method="POST">
                  {{ csrf_field() }}

                  <button type="Submit" class="btn btn-xs btn-success">
                @if($assignment->status)
                {{"Active"}}
                @endif
                  </button>
                
                </form>
              </td>

                               <td>
                <form action="{{route('assignment.add')}}" method="POST">
                  {{ csrf_field() }}

                  <button type="Submit" class="btn btn-xs btn-success">
               <i class="fa fa-download"></i>
                  </button>
                
                </form>
              </td>

              <td>

                  <form action="{{route('assignment.delete')}}" method="POST">
                  {{ csrf_field() }}
                  <input type="hidden" name="id" value="{{$assignment->id}}" />
 <button type="submit" class="btn btn-danger"><i class="fa fa-fw fa-trash-o"></i></button>
                
                </form>
              
                   
              
              </td>

              @endforeach
             


            </tr>
     
        </tbody>

      </table>
    </div>
  </div>


<!-- Modal -->
<div id="myModalas" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Add New Assignment</h4>
      </div>
      <div class="modal-body">
          <div class="box box-primary">
          <div class="panel panel-sum">
            <div class="modal-body">
              <form id="demo-form2" method="post" action="{{route('assignment.add')}}" data-parsley-validate class="form-horizontal form-label-left" enctype="multipart/form-data">
                {{ csrf_field() }}

                <input type="hidden" name="course_id" value="{{$cor->id}}"/>

                <select name="course_id" class="form-control display-none">
                  <option value="{{ $cor->id }}">{{ $cor->title }}</option>
                </select>

                <div class="row">
                  <div class="col-md-12">
                    <label for="exampleInputTit1e">Assignment Title:<span class="redstar">*</span> </label>
                    <input type="text" placeholder="Enter Titler Here" class="form-control " name="assignment_title" id="exampleInputTitle" value="" required="">
                  </div>
                  <div class="col-md-12"> 
                    <label for="exampleInputTit1e">Assignment Details:<span class="redstar">*</span> </label>
                    <textarea class="form-control " name="assignment_details" >
                    </textarea> 
                  </div>

                  <div class="col-md-12"> 
                    <label for="exampleInputTit1e">Submission Date:<span class="redstar">*</span> </label>
                    <input type="date" name="submission_date" class="form-control"  required=""/>
                      
                  
                  </div>


                 

                    <div class="col-md-12"> 
                    <label for="exampleInputTit1e">Select File:<span class="redstar">*</span> </label>
                    <input type="file" name="file" class="form-control"  required=""/>
                      
                  
                  </div>
                  

                </div>
           
                     
                <div class="box-footer">
                 <button type="submit" class="btn btn-md col-md-3 btn-primary">{{ __('adminstaticword.Submit') }}</button>
                </div>
                   
              </form>
            </div>
          </div>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div>

  </div>
</div>


</section> 
