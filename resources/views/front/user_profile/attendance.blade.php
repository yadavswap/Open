@extends('theme.master')
@section('title', 'Profile & Setting')
@section('content')

@include('admin.message')

<!-- about-home start -->
<section id="blog-home" class="blog-home-main-block">
   
</section> 
<!-- profile update start -->
<section id="profile-item" class="profile-item-block">
    <div class="container">
    	<form action="{{ route('user.profile',$orders->id) }}" method="POST" enctype="multipart/form-data">
        	{{ csrf_field() }}
            {{ method_field('PUT') }}

	        <div class="row">
	            <div class="col-xl-3 col-lg-3">
	                
	                <div class="dashboard-items">
	                    <ul>
	                        <li><i class="fa fa-book"></i><a href="{{ route('mycourse.show') }}" title="Dashboard">{{ __('frontstaticword.MyCourses') }}</a></li>
	                     <li><i class="fa fa-bar-chart"></i><a href="{{route('profile.attendance',Auth::user()->id)}}">My Attendance</a></li>
	                        <li><i class="fa fa-area-chart"></i><a href="">My Activity</a></li>
	                        <li><i class="fa fa-history"></i><a href="{{ route('purchase.show') }}" title="Followers">Enrolled History</a></li>
	                        <li><i class="fa fa-user"></i><a href="{{route('profile.show',Auth::User()->id)}}" title="Upload Items">{{ __('frontstaticword.UserProfile') }}</a></li>
	       
	                        <li><i class="fa fa-pie-chart"></i><a href="{{ route('purchase.show') }}" title="Followers">Report</a></li>
	                        @if(Auth::User()->role == "user")
	                       
	                        @endif
	                    </ul>
	                </div>
	            </div>
	            <div class="col-xl-9 col-lg-7">

	                <div class="profile-info-block">
	                    <div class="profile-heading">Attendance Info</div>
	                 		<span style="font-family: Monaco, Menlo, Consolas, 'Courier New', monospace; font-size: 13px; line-height: 18px; white-space: pre-wrap; background-color: rgb(255, 255, 255);"><div id="demo"></div></span>
	                
	              
		               
		                <br>
	                </div>
	              
	                <div class="upload-items text-right">
	                  
	                </div>
	                
	            </div>
	        </div>

        </form>
    </div>
</section>



<!-- profile update end -->
@endsection

@section('custom-script')



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


(function($) {
  "use strict";
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
  })(jQuery);

</script>

<script>
(function($) {
  "use strict";
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

<script>

	$(document).ready(function() {
    $('#example').DataTable();
} );
(function($) {
  "use strict";
	function readURL(input) {
	if (input.files && input.files[0]) {
	    var reader = new FileReader();
	    reader.onload = function(e) {
	        $('#imagePreview').css('background-image', 'url('+e.target.result +')');
	        $('#imagePreview').hide();
	        $('#imagePreview').fadeIn(650);
	    }
	    reader.readAsDataURL(input.files[0]);
		}
	}
	$("#imageUpload").change(function() {
	    readURL(this);
	});
})(jQuery);
</script>

<script>
  function myFunction() {
    var checkBox = document.getElementById("myCheck");
    var text = document.getElementById("update-password");
    if (checkBox.checked == true){
      text.style.display = "block";
    } else {
       text.style.display = "none";
    }
  }
</script>

<script>
(function($) {
  "use strict";
	$('#password, #confirm_password').on('keyup', function () {
	  if ($('#password').val() == $('#confirm_password').val()) {
	    $('#message').html('Password Match').css('color', 'green');
	  } else 
	    $('#message').html('Password Do Not Match').css('color', 'red');
	});
})(jQuery);

</script>

<script>
(function($) {
  "use strict";
	tinymce.init({selector:'textarea#detail'});
})(jQuery);
</script>

<style type="text/css">
	
	div.zabuto_calendar .badge-event, div.zabuto_calendar div.legend span.badge-event{
		background-color:#08ff50 !important;
	}

</style>

@endsection
