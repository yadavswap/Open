@extends('theme.master')
@section('title', 'Online Courses')
@section('content')

@include('admin.message')

<style type="text/css">
    
    .containernew {
  background: #FFFFFF;
  width: 900px;
  height: 650px;
  margin: 5% auto;
  position: relative;
}
.containernew .map {
  width: 45%;
  float: left;
}
.containernew .contact-form {
  width: 53%;
  margin-left: 2%;
  float: left;
}
.containernew .contact-form .title {
  font-size: 2.5em;
  font-family: "Roboto", sans-serif;
  font-weight: 700;
  color: #242424;
  margin: 5% 8%;
}
.containernew .contact-form .subtitle {
  font-size: 1.2em;
  font-weight: 400;
  margin: 0 4% 5% 8%;
}
.containernew .contact-form input,
.containernew .contact-form textarea {
  width: 330px;
  padding: 3%;
  margin: 2% 8%;
  color: #242424;
  border: 1px solid #B7B7B7;
}
.containernew .contact-form input::placeholder,
.containernew .contact-form textarea::placeholder {
  color: #242424;
}
.containernew .contact-form .btn-send {
  background: #A383C9;
  width: 180px;
  height: 60px;
  color: #FFFFFF;
  font-weight: 700;
  margin: 2% 8%;
  border: none;
}

</style>

<section id="home-background-slider" class="background-slider-block owl-carousel">
    <div class="item home-slider-img">
      
        <div id="home" class="home-main-block" style="background-image: url('{{ asset('images/sl24.jpg') }}')">
            <div class="container">
                <div class="row">
                    <div class="col-lg-6">
                        <div class="home-dtl">
                            <div class="home-heading text-white"></div>
                            <p class="text-white btm-20"></div>
                            <div class="search-block">
                               
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

            <div id="home" class="home-main-block" style="background-image: url('{{ asset('images/sl22.jpg') }}')">
            <div class="container">
                <div class="row">
                    <div class="col-lg-6">
                        <div class="home-dtl">
                            <div class="home-heading text-white"></div>
                            <p class="text-white btm-20"></div>
                            <div class="search-block">
                               
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

         <div id="home" class="home-main-block" style="background-image: url('{{ asset('images/sl111.png') }}')">
            <div class="container">
                <div class="row">
                    <div class="col-lg-6">
                        <div class="home-dtl">
                            <div class="home-heading text-white"></div>
                            <p class="text-white btm-20"></div>
                            <div class="search-block">
                              
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
      
    </div>
</section>


<!-- home end -->
<!-- learning-work start -->
@php
    $facts = App\SliderFacts::limit(3)->get();
@endphp
@if(isset($facts))
<section id="learning-work" class="learning-work-main-block">
    <div class="container">
        <div class="row">
            @foreach($facts as $fact)
            <div class="col-lg-4 col-sm-6">
                <div class="learning-work-block text-white">
                    <div class="row">
                        <div class="col-lg-3 col-md-3">
                            <div class="learning-work-icon">
                                <i class="fa {{ $fact['icon'] }}"></i>
                            </div>
                        </div>
                        <div class="col-lg-9 col-md-9">
                            <div class="learning-work-dtl">
                                <div class="work-heading">{{ $fact['heading'] }}</div>
                                <p>{{ $fact['sub_heading'] }}</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</section>
@endif
<!-- learning-work end -->
<!-- learning-courses start -->
@php
    $categories = App\CategorySlider::first();
@endphp
@if(isset($categories))
<section id="learning-courses" class="learning-courses-main-block">
    <div class="container">
        <div class="row">
            @php
                $items = App\CourseText::first();
            @endphp
            @if(isset($items))
            
            <div class="col-lg-4">
                <div class="learning-selection">
                    <div class="selection-heading">{{ $items['heading'] }}</div>
                    <p>{{ $items['sub_heading'] }}</p>
                </div>
            </div>
           
            @endif
            <div class="col-lg-8">
                <div class="learning-courses">
                    @php
                        $categories = App\CategorySlider::first();
                    @endphp
                    @if(isset($categories->category_id))
                    <ul class="nav nav-tabs" id="myTab" role="tablist">
                      @foreach($categories->category_id as $cate)
                        @php
                            $cats= App\Categories::find($cate);
                        @endphp
                        @if($cats['status'] == 1)
                            <li class="btn nav-item" ><a class="nav-item nav-link" id="home-tab" data-toggle="tab" href="#content-tabs" role="tab" aria-controls="home" onclick="showtab('{{ $cats->id }}')" aria-selected="true">{{ $cats['title'] }}</a></li>
                        @endif
                      @endforeach
                    </ul>
                    @endif
                </div>
                <div class="tab-content" id="myTabContent">
                    @if(!empty($categories))
                        @foreach($categories->category_id as $cate)
                            <div class="tab-pane fade show active" id="content-tabs" role="tabpanel" aria-labelledby="home-tab">
                                
                                <div id="tabShow">
                                    
                                </div>
                                
                            </div>
                        @endforeach
                    @endif
                </div>
            </div>
        </div>
    </div>
</section>
@endif
<!-- learning-courses end -->

<!-- Student start -->
@if($gsetting->zoom_enable == '1')
<section id="student" class="student-main-block">
    <div class="container">
        @php
            $meetings = App\Meeting::all();
            $mytime = Carbon\Carbon::now();
        @endphp
        @if( ! $meetings->isEmpty() )
        <h4 class="student-heading">{{ __('frontstaticword.ZoomMeetings') }}</h4>
        <div id="zoom-view-slider" class="student-view-slider-main-block owl-carousel">
            @foreach($meetings as $meeting)
             
                <div class="item student-view-block student-view-block-1">
                    <div class="genre-slide-image protip" data-pt-placement="outside" data-pt-interactive="false" data-pt-title="#prime-next-item-description-block-2{{$meeting->id}}">
                        <div class="view-block">
                            <div class="view-img">
                                @if($meeting->user['user_img'] !== NULL && $meeting->user['user_img'] !== '')
                                    <img src="{{ asset('images/user_img/'.$meeting->user['user_img']) }}" alt="course" class="img-fluid">
                                @else
                                    <img src="{{ Avatar::create($meeting->user->fname)->toBase64() }}" alt="course" class="img-fluid">
                                @endif
                            </div>
                            <div class="view-dtl">
                                <div class="view-heading btm-10">{{ str_limit($meeting->meeting_title, $limit = 30, $end = '...') }}</div>
                                <p class="btm-10"><a herf="#">by {{ $meeting->user['fname'] }}</a></p>

                                <p class="btm-10"><a herf="#">Start At: {{ date('d-m-Y | h:i:s A',strtotime($meeting['start_time'])) }}</a></p>

                                
                              
                            </div>
                           
                        </div>
                    </div>
                    <div id="prime-next-item-description-block-2{{$meeting->id}}" class="prime-description-block">
                        <div class="prime-description-under-block">
                            <div class="prime-description-under-block">
                                <h5 class="description-heading">{{ $meeting['meeting_title'] }}</h5>
                                <div class="protip-img">
                                    <h3 class="description-heading">by {{ $meeting->user['fname'] }}</h>

                                    <p class="meeting-owner btm-10"><a herf="#">Meeting Owner: {{ $meeting->owner_id }}</a></p>
                                    
                                </div>
                                <div class="main-des">


                                    <p class="btm-10"><a herf="#">Start At: {{ date('d-m-Y | h:i:s A',strtotime($meeting['start_time'])) }}</a></p>
                                </div>
                                <div class="des-btn-block">
                                    @if($mytime >= $meeting->start_time)
                                        <a href="{{ $meeting->zoom_url }}" class="btn btn-light">Join Meeting</a>
                                    @else
                                        <a class="btn btn-light">Join Meeting</a>
                                    @endif

                                </div>
                            </div>
                        </div>
                    </div>
                    
                </div> 
             
            @endforeach
        </div>
        @endif
    </div>
</section>
@endif
<!-- Students end -->
<!-- recommendations start -->
<section id="border-recommendation" class="border-recommendation">
    @php
        $gets = App\GetStarted::first();
    @endphp
    @if(isset($gets)) 
    <div class="top-border"></div>
    <div class="recommendation-main-block  text-center" style="background-image: url('{{ asset('images/getstarted/'.$gets['image']) }}')">
        <div class="container">
            <h3 class="text-white">{{ $gets['heading'] }}</h3>
            <p class="text-white btm-20">{{ $gets['sub_heading'] }}</p>
            @if($gets->button_txt == !NULL)
            <div class="recommendation-btn text-white">
                <a href="{{ url('/') }}" class="btn btn-primary " title="search">{{ $gets['button_txt'] }}</a>
            </div>
            @endif 
        </div>
    </div>
    @endif
</section>
<!-- recommendations end -->

<!-- testimonial start -->

<section id="testimonial" class="testimonial-main-block">
    <div class="container">
        <h3 class="btm-30">{{ __('frontstaticword.HomeTestimonial') }}</h3>
        <div id="testimonial-slider" class="testimonial-slider-main-block owl-carousel">
            
          
            <div class="item testimonial-block">
                <ul>
                    <li><img src="{{ asset('images/testimonial.jpeg.jpg') }}" alt="blog"></li>
                    <li><h5 class="testimonial-heading">BHUMIKA PATRIKAR - CBSE (93.60%)</h5></li>
                </ul>
                <p>
                    I am very grateful to be the part of B.R SUPER LEARNERS PLATFORM. I have taken admission in this institution due to the college reputation and my  career goals....  "Opportunity don't happen , you create it",and this institution gives me an opportunity to fulfill my dreams .The faculty is the biggest strength of this institution and  teach  with great encouragement. As we know there is no substitution for hardwork  and hardwork is key of success ... And  being  a BRSUPERLEARNER we are destine to be the successful and a good human being

                </p>
            </div>

             <div class="item testimonial-block">
                <ul>
                    <li><img src="{{ asset('images/testimonial2.jpg') }}" alt="blog"></li>
                    <li><h5 class="testimonial-heading">TEJAS BARAI - STATE (94%)</h5></li>
                </ul>
                <p>
                    After performing well in class-X, I focused on  exams like JEE and NEET. It's necessary to prepare from class-XI and also to choose a coaching which is best not by banner but by dedication. When most students rush to renowned classes in Nagpur or other cities, I choose SUPERLEARNERS INSTITUTE OF SCIENCE ,KATOL for the dedication of teachers and other members towards student encouraging them to perform better. In the very beginning, strategies and ultimate goal, which was study plan for me for next two years  have been discussed thoroughly.

                </p>
            </div>

               <div class="item testimonial-block">
                <ul>
                    <li><img src="{{ asset('images/testimonial3.jpg') }}" alt="blog"></li>
                    <li><h5 class="testimonial-heading">MANISHA DEOGHARE - STATE (96.40%)</h5></li>
                </ul>
                <p>
                    Hi friends, I  joined SUPER LEARNERS INSTITUTE OF SCIENCE after my 10th board exams to prepare for entrance exam . Here faculty members follow the motto Where "Your Karma Meets Our Dharma".  A dream institution for anyone really desirous of enjoying a life full of interesting information and securing a great future too. 

                </p>
            </div>


               <div class="item testimonial-block">
                <ul>
                    <li><img src="{{ asset('images/testimonial.jpeg.jpg') }}" alt="blog"></li>
                    <li><h5 class="testimonial-heading">POONAM LENDE - STATE  (94.20%)</h5></li>
                </ul>
                <p>
                  It has been a great privilege to be a part of such an excellent institute like SUPER LEARNERS INSTITUTE OF SCIENCE,KATOL. This institution is to provide knowledge and guidance and thereby create an environment to guide students in the path of success as well as inspire them to recognize and explore their potential of intellectual capabilities.

                </p>
            </div>






            
        </div> 
        
    </div>
</section>

<section id="trusted" class="trusted-main-block">
    <div class="container">
        <div class="patners-block">
            
            <h1 class="text-center btm-40">ABOUT US</h1>

            <p>
                At SUPER LEARNERS ACADEMY OF SCIENCE our mission is to provide excellent education for IIT JEE/NEET/AIIMS, Board exams. Here you'll find exceptional teachers, study materials, practice sessions and learning environment that encourage children to learn, explore & grow in a dynamic and nurturing environment.
            </p>
            
        </div>
    </div>
</section>

<section id="trusted" class="trusted-main-block">
    <div class="container">
        <div class="patners-block">
            
            <h1 class="text-center btm-40">OUR MISSION</h1>

           <blockquote>
               “Our efforts to deliver quality education, we will emphasis more on the need to establish one to one contact with every student and be attentive to his /her need so that the teacher can monitor individual progress and guide them accordingly on the way to success. Our faculty team will be of committed bunch of professionals who will be responsible to make positive difference in the life of our students. We are also committed to bring change in the teaching learning process in which students can learn in free and unstressed environment. We are fully aware of our social responsibilities and humanitarian ground which will help us to contribute to the society.” 
           </blockquote>
            
        </div>
    </div>
</section>

<section id="trusted" class="trusted-main-block">
    <div class="container-fluid">
        <div class="patners-block">
            
            <h1 class="text-center btm-40">CONTACT US</h1>

      <div class="containernew">
    <div class="map">
        <iframe src="https://www.google.com/maps/embed?pb=!1m14!1m8!1m3!1d112061.09262729759!2d77.208022!3d28.632485!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x0%3A0x644e33bc3def0667!2sIndior+Tours+Pvt+Ltd.!5e0!3m2!1sen!2sus!4v1527779731123" width="100%" height="650px" frameborder="0" style="border:0" allowfullscreen></iframe>
    </div>
    <div class="contact-form">
      
        <form action="">
            <input type="text" name="name" placeholder="Your Name" />
            <input type="email" name="e-mail" placeholder="Your E-mail Adress" />
            <input type="tel" name="phone" placeholder="Your Phone Number"/>
            <textarea name="text" id="" rows="8" placeholder="Your Message"></textarea>
            <button class="btn-send">Get a Call Back</button>
        </form>
    </div>
</div>
            
        </div>
    </div>
</section>



@endsection

@section('custom-script')
<script>
    (function($) {
      "use strict";
        $(function() {
           $( "#home-tab" ).trigger( "click" );
        });
    })(jQuery);

    function showtab(id){
        $.ajax({
            type : 'GET',
            url  : '{{ url('/tabcontent') }}/'+id,
            dataType  : 'html',
            success : function(data){

                $('#tabShow').html('');
                $('#tabShow').append(data);
            }
        });
    }
</script>

@endsection
