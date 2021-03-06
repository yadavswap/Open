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
    
        	{{ csrf_field() }}
            {{ method_field('PUT') }}

	        <div class="row">
	            <div class="col-xl-3 col-lg-3">
	                
	                <div class="dashboard-items">
	                    <ul>
	                        <li><i class="fa fa-book"></i><a href="{{ route('mycourse.show') }}" title="Dashboard">{{ __('frontstaticword.MyCourses') }}</a></li>
	                     <li><i class="fa fa-bar-chart"></i><a href="{{route('profile.attendance',Auth::user()->id)}}">My Attendance</a></li>
	                     
	                        <li><i class="fa fa-history"></i><a href="{{ route('purchase.show') }}" title="Followers">Enrolled History</a></li>
	                        <li><i class="fa fa-user"></i><a href="{{route('profile.show',Auth::User()->id)}}" title="Upload Items">{{ __('frontstaticword.UserProfile') }}</a></li>
	       
	                           <li><i class="fa fa-pie-chart"></i><a href="{{ route('front.report.index') }}" title="Followers">Report</a></li>


                                <a href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                    <div>
                                      <li style="color: #716E6E;
font-weight: normal; font-size: 14px;"><i class="fa fa-sign-out"> Logout</i>
                                        
                                        <form id="logout-form" action="{{ route('logout') }}" method="POST" class="display-none">
                                            @csrf
                                    
                                    </div>
                                </a>

                            </li>
                         


	                        @if(Auth::User()->role == "user")
	                       
	                        @endif
	                    </ul>
	                </div>
	            </div>
	            <div class="col-xl-9 col-lg-7">

	                <div class="profile-info-block">
	                    <div class="profile-heading">Watch Time Report</div>

	              
		                
     <div id = "container" style = "width: 550px; height: 400px; margin: 0 auto">
      </div>

         <div id = "container2" style = "width: 550px; height: 400px; margin: 0 auto">
      </div>
		               
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


  <script type = "text/javascript">
         google.charts.load('current', {packages: ['corechart']});    

      </script>



  <script language = "JavaScript">
         function drawChart() {
            // Define the chart to be drawn.

            <?php foreach ($watchdata as  $value): ?>

                var data = google.visualization.arrayToDataTable([
               ['Time', 'Minutes'],
               ['<?= $value['course_name'] ?>',  <?= $value['course_duration'] ?>]
              
            ]);

              
            <?php endforeach ?>
          
            var options = {title: 'Watch Duration In Minutes'}; 

            // Instantiate and draw the chart.
            var chart = new google.visualization.ColumnChart(document.getElementById('container'));
            chart.draw(data, options);
         }
         google.charts.setOnLoadCallback(drawChart);


           function pieChartStat() {
            // Define the chart to be drawn.
            var data = new google.visualization.DataTable();
            data.addColumn('string', 'Course Name');
            data.addColumn('number', 'Time');

         
               data.addRows([
                 ['Course',  10.12]
            ]);
           
               
            // Set chart options
            var options = {
               'title':'Courses Names',
               'width':550,
               'height':400,
               is3D:true
            };

            // Instantiate and draw the chart.
            var chart = new google.visualization.PieChart(document.getElementById('container2'));
            chart.draw(data, options);
         }
         google.charts.setOnLoadCallback(pieChartStat);
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
