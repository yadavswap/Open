<section class="content">
 
  <div class="row">
    <div class="col-md-12">
      <a data-toggle="modal" data-target="#myModalp" href="#" class="btn btn-info btn-sm">+ {{ __('adminstaticword.Add') }}</a>
      <br>
      <br>
      <table id="example1" class="table table-bordered table-striped">
        <thead>
          <tr>
            <th>{{ __('adminstaticword.Course') }}</th>
            <th>{{ __('adminstaticword.ChapterName') }}</th>
            <th>{{ __('adminstaticword.Status') }}</th>
            <th>{{ __('adminstaticword.Edit') }}</th>
            <th>{{ __('adminstaticword.Delete') }}</th>
          </tr>
        </thead>
        <tbody>
          @foreach($coursechapter as $cat)
            <tr>
              <td>{{$cat->courses->title}}</td>
              <td>{{$cat->chapter_name}}</td>
              <td>
                <form action="{{ route('Chapter.quick',$cat->id) }}" method="POST">
                  {{ csrf_field() }}

                  <button type="Submit" class="btn btn-xs {{ $cat->status ==1 ? 'btn-success' : 'btn-danger' }}">
                    @if($cat->status ==1)
                    {{ __('adminstaticword.Active') }}
                    @else
                    {{ __('adminstaticword.Deactive') }}
                    @endif
                  </button>
                </form>
              </td>
              <td>
                <a class="btn btn-success btn-sm" href="{{url('coursechapter/'.$cat->id)}}"><i class="glyphicon glyphicon-pencil"></i></a>
              </td>

              <td>
                <form  method="post" action="{{url('coursechapter/'.$cat->id)}}"  data-parsley-validate class="form-horizontal form-label-left">
                      {{ csrf_field() }}
                      {{ method_field('DELETE') }}
                    <button type="submit" class="btn btn-danger"><i class="fa fa-fw fa-trash-o"></i></button>
                </form>
              </td>

            </tr>
          @endforeach
        </tbody>

      </table>
    </div>
  </div>

  <!--Model start-->
  <div class="modal fade" id="myModalp" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog modal-lg" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
          <h4 class="modal-title" id="myModalLabel">{{ __('adminstaticword.AddCourseChapter') }}</h4>
        </div>
        <div class="box box-primary">
          <div class="panel panel-sum">
            <div class="modal-body">
              <form id="demo-form2" method="post" action="{{ route('coursechapter.store') }}" data-parsley-validate class="form-horizontal form-label-left">
                {{ csrf_field() }}

                <select name="course_id" class="form-control display-none">
                  <option value="{{ $cor->id }}">{{ $cor->title }}</option>
                </select>

                <div class="row">
                  <div class="col-md-12">
                    <label for="exampleInputTit1e">{{ __('adminstaticword.ChapterName') }}:<span class="redstar">*</span> </label>
                    <input type="text" placeholder="Enter Your Chapter Name" class="form-control " name="chapter_name" id="exampleInputTitle" value="">
                  </div>
                  <div class="col-md-6"> 
                   
                  </div>
                </div>
                <br>

                <div class="row"> 
                  <div class="col-md-6"> 
                    <label for="exampleInputDetails">{{ __('adminstaticword.Status') }}:</label>
                    <li class="tg-list-item">
                      <input class="tgl tgl-skewed" id="cb300"   type="checkbox"/>
                      <label class="tgl-btn" data-tg-off="Deactive" data-tg-on="Active" for="cb300"></label>
                    </li>
                    <input type="hidden" name="status" value="1" id="ram">
                  </div>
                </div>
                <br>
                     
                <div class="box-footer">
                 <button type="submit" class="btn btn-md col-md-3 btn-primary">{{ __('adminstaticword.Submit') }}</button>
                </div>
                   
              </form>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  <!--Model close -->    

</section> 
