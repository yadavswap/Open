<section class="content">
  @include('admin.message')
  <div class="row">
    <!-- left column -->
    <div class="col-xs-12">
      <!-- general form elements -->
        <div class="box-header with-border">
          <h3 class="box-title"> {{ __('adminstaticword.Edit') }} {{ __('adminstaticword.Course') }}</h3>
        </div>
        <br>
        <!-- /.box-header -->
        <div class="box-body">
          <div class="form-group">
            <form action="{{route('course.update',$cor->id)}}" method="post" enctype="multipart/form-data">
              {{ csrf_field() }}  
              {{ method_field('PUT') }}
             
              <div class="row">
                <div class="col-md-3">
                  <label>{{ __('adminstaticword.Category') }}<span class="redstar">*</span></label>
                  <select name="category_id" id="category_id" class="form-control js-example-basic-single" required>
                    <option value="0">{{ __('adminstaticword.SelectanOption') }}</option>
                    @php
                      $category = App\Categories::all();
                    @endphp 

                    @foreach($category as $caat)
                      <option {{ $cor->category_id == $caat->id ? 'selected' : "" }} value="{{ $caat->id }}">{{ $caat->title }}</option>
                    @endforeach 
                  </select>
                </div>
                <div class="col-md-3">
                  <label>{{ __('adminstaticword.SubCategory') }}:<span class="redstar">*</span></label>
                  <select name="subcategory_id" id="upload_id" class="form-control js-example-basic-single" required>
                    @php
                      $subcategory = App\SubCategory::all();
                    @endphp
                    @foreach($subcategory as $caat)
                      <option {{ $cor->subcategory_id == $caat->id ? 'selected' : "" }} value="{{ $caat->id }}">{{ $caat->title }}</option>
                    @endforeach
                  </select>
                </div>
                <div class="col-md-3">
                  <label>{{ __('adminstaticword.ChildCategory') }}:</label>
                  <select name="childcategory_id" id="grand" class="form-control js-example-basic-single">
                    @php
                      $childcategory = App\ChildCategory::all();
                    @endphp 

                    @foreach($childcategory as $caat)
                      <option {{ $cor->subcategory_id == $caat->id ? 'selected' : "" }} value="{{ $caat->id }}">{{ $caat->title }}</option>
                    @endforeach
                  </select>
                </div>     
                <div class="col-md-3">
                  @php
                    $User = App\User::all();
                  @endphp
                  <label for="exampleInputSlug">{{ __('adminstaticword.SelectUser') }}</label>
                  <select name="user" class="form-control js-example-basic-single col-md-7 col-xs-12">
                    <option  value="{{ Auth::user()->id }}">{{ Auth::user()->fname }}</option>
                  </select>
                </div>
              </div>
              <br>

              <div class="row">
                <div class="col-md-6"> 
                  @php
                      $languages = App\CourseLanguage::all();
                  @endphp
                  <label for="exampleInputSlug">{{ __('adminstaticword.SelectLanguage') }}</label>
                  <select name="language_id" class="form-control js-example-basic-single col-md-7 col-xs-12">
                    @foreach($languages as $cat)
                      <option {{ $cor->language_id == $cat->id ? 'selected' : "" }} value="{{ $cat->id }}">{{ $cat->name }}</option>
                    @endforeach
                  </select>
                </div>
                <div class="col-md-6"> 
                  <label for="exampleInputTit1e">{{ __('adminstaticword.Title') }}:<sup class="redstar">*</sup></label>
                  <input type="text" class="form-control" name="title" id="exampleInputTitle" value="{{ $cor->title }}">
                </div>
              </div>
              <br>

              <div class="row">
                <div class="col-md-6">
                  <label for="exampleInputDetails">{{ __('adminstaticword.ShortDetail') }}:<sup class="redstar">*</sup></label>
                  <textarea name="short_detail" rows="3" class="form-control" >{!! $cor->short_detail !!}</textarea>
                </div>
                <div class="col-md-6">
                  <label for="exampleInputSlug">{{ __('adminstaticword.Slug') }}</label>
                  <input type="slug" class="form-control" name="slug" id="exampleInputPassword1" value="{{ $cor->slug}}">
                </div>
              </div>
              <br>

              <div class="row">
                <div class="col-md-6">
                  <label for="exampleInputDetails">{{ __('adminstaticword.Requirements') }}:<sup class="redstar">*</sup></label>
                  <textarea name="requirement" rows="3" class="form-control" required >{!! $cor->requirement !!}</textarea>
                </div>
                <div class="col-md-6">
                  <label for="exampleInputDetails">{{ __('adminstaticword.Detail') }}:<sup class="redstar">*</sup></label>
                  <textarea name="detail" rows="3" class="form-control" required >{!! $cor->detail !!}</textarea>
                </div>
              </div>
              <br>

            
              <br>
           
              <div class="row">
                <div class="col-md-6">
                  <label for="exampleInputDetails">{{ __('adminstaticword.PreviewVideo') }}:</label>  
                  <li class="tg-list-item"> 
                    <input name="preview_type"  class="tgl tgl-skewed" id="preview" type="checkbox" {{ $cor->preview_type=="video" ? 'checked' : '' }}>

                    <label class="tgl-btn" data-tg-off="URL" data-tg-on="Upload" for="preview" ></label>
                  </li>
                  <input type="hidden" name="free" value="0" id="to">

                  <div @if($cor->preview_type =="url" ) class="display-none" @endif id="document1">
                    <label for="exampleInputSlug">{{ __('adminstaticword.UploadVideo') }}: <sup class="redstar">*</sup></label>
                    <input  type="file" class="form-control" name="video" id="video" value="{{ $cor->video }}">
                    @if($cor->video !="")
                      <video src="{{ asset('video/preview/'.$cor->video) }}" width="200" height="150" autoplay="no">
                      </video>
                    @endif 
                  </div>

                  <div @if($cor->preview_type =="video") class="display-none" @endif id="document2">
                    <br>
                    <label for="exampleInputSlug">{{ __('adminstaticword.URL') }}: <sup class="redstar">*</sup></label>
                    <input  class="form-control" placeholder="Enter Your URL" name="url" id="url" value="{{ $cor->url }}">
                  </div>
                </div>
                <div class="col-md-3">
                  <label>{{ __('adminstaticword.PreviewImage') }}:</label> 
                  <br> 
                  <input type="file" name="image" id="image" class="inputfile inputfile-1"  />
                  <label for="image"><svg xmlns="http://www.w3.org/2000/svg" width="10" height="7" viewBox="0 0 20 17"><path d="M10 0l-5.2 4.9h3.3v5.1h3.8v-5.1h3.3l-5.2-4.9zm9.3 11.5l-3.2-2.1h-2l3.4 2.6h-3.5c-.1 0-.2.1-.2.1l-.8 2.3h-6l-.8-2.2c-.1-.1-.1-.2-.2-.2h-3.6l3.4-2.6h-2l-3.2 2.1c-.4.3-.7 1-.6 1.5l.6 3.1c.1.5.7.9 1.2.9h16.3c.6 0 1.1-.4 1.3-.9l.6-3.1c.1-.5-.2-1.2-.7-1.5z"/></svg> <span>{{ __('adminstaticword.Chooseafile') }}&hellip;</span>
                  </label>
                  <br>
                  @if($cor['preview_image'] !== NULL && $cor['preview_image'] !== '')
                      <img src="{{ url('/images/course/'.$cor->preview_image) }}" height="70px;" width="70px;"/>
                  @else
                      <img src="{{ Avatar::create($cor->title)->toBase64() }}" alt="course" class="img-fluid">
                  @endif
                </div>
                <div class="col-md-3">
                  <label for="exampleInputSlug">Course Expire Duration</label>
                  <p class="inline info"> - Please enter duration in month</p>
                  <input min="1" class="form-control" name="duration" type="number" id="duration" value="{{ $cor->duration }}" placeholder="Enter Duration in months">
                </div>
              </div>
              <br>
              <br>

              <div class="box-footer">
                <button type="submit" class="btn btn-lg col-md-3 btn-primary">{{ __('adminstaticword.Save') }}</button>
              </div>
         
            </form>
          </div>
        </div>
        <!-- /.box -->
    </div>
    <!--/.col (right) -->
  </div>
  <!-- /.row -->
</section> 


@section('scripts')

<script>
(function($) {
  "use strict";

  $(function() {
    $('.js-example-basic-single').select2();
  });

  $(function() {
    $('#cb1').change(function() {
      $('#f').val(+ $(this).prop('checked'))
    })
  })

  $(function() {
    $('#cb3').change(function() {
      $('#test').val(+ $(this).prop('checked'))
    })
  })

  $(function(){

      $('#murl').change(function(){
        if($('#murl').val()=='yes')
        {
            $('#doab').show();
        }
        else
        {
            $('#doab').hide();
        }
      });

  });

  $(function(){

      $('#murll').change(function(){
        if($('#murll').val()=='yes')
        {
            $('#doabb').show();
        }
        else
        {
            $('#doab').hide();
        }
      });

  });

  $('#preview').on('change',function(){

    if($('#preview').is(':checked')){
      $('#document1').show('fast');
      $('#document2').hide('fast');    

    }else{
      $('#document2').show('fast');
      $('#document1').hide('fast');    
    }

  });

  $(function() {
    var urlLike = '{{ url('admin/dropdown') }}';
    $('#category_id').change(function() {
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
    var urlLike = '{{ url('admin/gcat') }}';
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
