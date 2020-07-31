<!DOCTYPE html>
<html lang="en">


<head>
<!-- Start Meta -->
<meta charset="UTF-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge" />
<meta name="viewport" content="width=device-width, initial-scale=1">
<!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
<title>BR SUPER LEARNERS | KATOL</title>
<!-- Plugins CSS -->
<link href="{{url('front/css/plugins.css')}}" rel="stylesheet" >
<!-- Custom CSS -->
<link href="{{url('front/css/style.css')}}" rel="stylesheet">
<!-- Favicon -->

</head>

<body>
<!-- Pre Loader -->
<div id="dvLoading"></div>
<!-- Top Header -->
<header class="top-header">
  <div class="container">
    <div class="row align-items-center">
      <div class="col-lg-3 col-md-2">
       
      </div>
      <div class="col-lg-9 col-md-10">
        <ul  class="top-header-right">
          <li> <i class='fa fa-map'></i>BR Super Learners,Katol</li>
          <li> <i class='fa fa-envelope'></i> <a href="mailto:info@test.com">brsuperlearners@gmail.com</a> </li>
          <li> <i class='fa fa-phone'></i> <a href="tel:+91-8605195919">+91-8605195919</a> </li>
        </ul>
      </div>
    </div>
  </div>
</header>
<!-- Top Header End --> 
<!-- Start Navbar Area -->

<div class="navbar-area"> 
  <!-- Menu For Mobile Device -->
  <div class="mobile-nav"> <a href="{{route('webhome')}}" class="logo"> <img src="{{ asset('images/logo/logo.jpeg') }}" style="width: 70px;" alt="Logo"> </a> </div>
  
  <!-- Menu For Desktop Device -->
  <div class="top-nav main-nav">
    <div class="container-fluid">
      <nav class="navbar navbar-expand-md navbar-light "> 
        <a class="navbar-brand" href="{{route('webhome')}}"> 
          <img src="{{ asset('images/logo/logo.jpeg') }}" alt="Logo" style="width:70px;"></a>
          <p style="color:#010101;">BR SUPER LEARNERS</p>
        <div class="collapse navbar-collapse mean-menu" id="navbarSupportedContent">
          <ul class="navbar-nav m-auto">
            <li class="nav-item"> <a href="{{route('webhome')}}" class="nav-link active"> Home </a></li>
            <li class="nav-item"> <a href="#aboutarea" > About Us </a>
           
            </li>
            <li class="nav-item"><a href="#testimonialsection">Testimonials</a>
          
            </li>
            <li class="nav-item"><a href="#mnvsection">Mission & Vission</a></li>
            
            <li class="nav-item"> <a href="#contactsection" > Contact </a> </li>
          </ul>
          @guest
          <div class="appointment-btn"><a href="{{route('login')}}" class="btn ">User Login <i class='bx bx-right-arrow-alt'></i> </a> </div>
          @endguest

          @auth

          @if(Auth::user()->role == "user")
           <div class="appointment-btn"><a href="{{route('dashboard')}}" class="btn ">User Dashboard <i class='bx bx-right-arrow-alt'></i> </a> </div>
          @endif

           @if(Auth::user()->role == "instructor")
           <div class="appointment-btn"><a href="{{route('admin.index')}}" class="btn ">Teacher Dashboard <i class='bx bx-right-arrow-alt'></i> </a> </div>
          @endif

            @if(Auth::user()->role == "admin")
           <div class="appointment-btn"><a href="{{route('admin.index')}}" class="btn ">Admin Dashboard <i class='bx bx-right-arrow-alt'></i> </a> </div>
          @endif

          @endauth
        </div>
      </nav>
    </div>
  </div>
</div>
<!-- Quote Section -->
<!-- End Navbar Area --> 
<!-- Start Banner Section --> 
<section class="slider-one">
  <div class="slider-one__carousel owl-carousel owl-theme">
    <div class="item slider-one__slider-1" style="background-image: url('{{ asset('images/sl24.jpg') }}');">
      <div class="container">
        <h2 class="slider-one__title"></span></h2>
        <!-- /.slider-one__title -->
        <p class="slider-one__text"></p>
        <a href="" class="theme-btn btn-style-one" style="display: none;">
        <div class="btn-title"><span class="btn-icon"><span class="icon fa fa-long-arrow-right" aria-hidden="true"></span> </span></div>
        </a> 
        <!-- /.slider-one__text --> 
      </div>
      <!-- /.container --> 
    </div>
    <!-- /.item -->
    <div class="item slider-one__slider-2" style="background-image: url('{{ asset('images/sl22.jpg') }}')">
      <div class="container">
        <h2 class="slider-one__title"></h2>
        <!-- /.slider-one__title -->
        <p class="slider-one__text"></p>
       <a href="" class="theme-btn btn-style-one" style="display: none;">
        <div class="btn-title"><span class="btn-icon"><span class="icon fa fa-long-arrow-right" aria-hidden="true"></span> </span></div>
        </a> 
        <!-- /.slider-one__text --> 
      </div>
      <!-- /.container --> 
    </div>
    <!-- /.item -->
    <div class="item slider-one__slider-3" style="background-image: url('{{ asset('images/sl111.png') }}')">
      <div class="container">
        <h2 class="slider-one__title"></h2>
        <!-- /.slider-one__title -->
        <p class="slider-one__text"></p>
        <a href="" class="theme-btn btn-style-one" style="display: none;">
        <div class="btn-title"><span class="btn-icon"><span class="icon fa fa-long-arrow-right" aria-hidden="true"></span> </span></div>
        </a> 
        <!-- /.slider-one__text --> 
      </div>
      <!-- /.container --> 
    </div>
    <!-- /.item --> 
  </div>
  <!-- /.slider-one__carousel --> 
</section>
<!--End Banner Section --> 
<!--Start About Section -->
<section class="about-area" id="aboutarea">
  <div class="container">
    <div class="row">
      <div class="col-lg-7 col-md-12">
        <div class="full-sec-content">
          <div class="sec-title style-two">
            <h2>More About Us</h2>
            <span class="decor"> <span class="inner"></span> </span> </div>
          <h3>We are Providing best educational institute</h3>
          <p>At SUPER LEARNERS ACADEMY OF SCIENCE our mission is to provide excellent education for IIT JEE/NEET/AIIMS, Board exams. Here you'll find exceptional teachers, study materials, practice sessions and learning environment that encourage children to learn, explore & grow in a dynamic and nurturing environment. </p>
        </div>
      </div>
      <div class="col-lg-5 col-md-12">
        <div class="about-img"> <img src="{{url('images/school.jpeg')}}" alt="" data-popupalt-original-title="null" title=""></div>
      </div>
    </div>
  </div>
</section>
<!--End About Section --> 



<!--Start Testmonials Section -->
<section class="testimonials-sec" id="testimonialsection">
  <div class="container">
    <div class="sec-title text-center mb-0">
      <h2>Our <span>Testimonials</span></h2>
      <p>Know What Students Say About Us</p>
      <span class="decor"><span class="inner"></span></span> </div>
    <div class="row">
      <div class="col-lg-12">
        <div class="test-active owl-carousel">
          <div class="item">
            <div class="review-box">
              
               <div class="about-author d-flex align-items-center">
                <div class="author-ava"> <img src="{{ asset('images/testimonial3.jpg') }}" alt="" style="width: 90px;"> </div>
                <div class="author-desination author-desination-2">
                  <h4>MANISHA DEOGHARE </h4>
                  <h6>STATE (96.40%)</h6>
                </div>
              </div>
              <div class="members-text">
                <p><br/>Hi friends, I  joined SUPER LEARNERS INSTITUTE OF SCIENCE after my 10th board exams to prepare for entrance exam . Here faculty members follow the motto Where "Your Karma Meets Our Dharma".  A dream institution for anyone really desirous of enjoying a life full of interesting information and securing a great future too. </p>
              </div>
              <div class="members-rating">
                <ul>
                  <li><i class="fas fa-star"></i></li>
                  <li><i class="fas fa-star"></i></li>
                  <li><i class="fas fa-star"></i></li>
                  <li><i class="fas fa-star"></i></li>
                  <li><i class="fas fa-star"></i></li>
                </ul>
              </div>
             
            </div>

          </div>

          <!-- 2nd start -->

          <div class="item">
            <div class="review-box">
            
            
              <div class="about-author d-flex align-items-center">
                <div class="author-ava"> <img src="{{ asset('images/testimonial4.jpg') }}" alt="" style="width: 90px;"> </div>
                <div class="author-desination author-desination-2">
                  <h4> POONAM LENDE</h4>
                  <h6>STATE  (94.20%)</h6>
                </div>
              </div>

                <div class="members-text">
                <p>  
                   It has been a great privilege to be a part of such an excellent institute like SUPER LEARNERS INSTITUTE OF SCIENCE,KATOL. This institution is to provide knowledge and guidance and thereby create an environment to guide students in the path of success as well as inspire them to recognize and explore their potential of intellectual capabilities.
</p>
              </div>

                <div class="members-rating">
                <ul>
                  <li><i class="fas fa-star"></i></li>
                  <li><i class="fas fa-star"></i></li>
                  <li><i class="fas fa-star"></i></li>
                  <li><i class="fas fa-star"></i></li>
                  <li><i class="fas fa-star"></i></li>
                </ul>
              </div>

            </div>
          </div>




<!-- 2nd end -->


<!-- 3rd start -->

 <div class="item">
            <div class="review-box">
            
            
              <div class="about-author d-flex align-items-center">
                <div class="author-ava"> <img src="{{ asset('images/testimonial2.jpg') }}" alt="" style="width: 90px;"> </div>
                <div class="author-desination author-desination-2">
                  <h4>TEJAS BARAI</h4>
                  <h6>STATE (94%)</h6>
                </div>
              </div>

                <div class="members-text">
                <p style="font-size: 13px;">  
                    After performing well in class-X, I focused on  exams like JEE and NEET. It's necessary to prepare from class-XI and also to choose a coaching which is best not by banner but by dedication. When most students rush to renowned classes in Nagpur or other cities, I choose SUPERLEARNERS INSTITUTE OF SCIENCE ,KATOL for the dedication of teachers and other members towards student encouraging them to perform better. In the very beginning, strategies and ultimate goal, which was study plan for me for next two years  have been discussed thoroughly.
</p>
              </div>

                <div class="members-rating">
                <ul>
                  <li><i class="fas fa-star"></i></li>
                  <li><i class="fas fa-star"></i></li>
                  <li><i class="fas fa-star"></i></li>
                  <li><i class="fas fa-star"></i></li>
                  <li><i class="fas fa-star"></i></li>
                </ul>
              </div>

            </div>
          </div>


<!-- 3rd end -->


<!-- 4th start -->

<div class="item">
            <div class="review-box">
            
            
              <div class="about-author d-flex align-items-center">
                <div class="author-ava"> <img src="{{ asset('images/testimonial.jpeg.jpg') }}" alt="" style="width: 90px;"> </div>
                <div class="author-desination author-desination-2">
                  <h4>TEJAS BARAI</h4>
                  <h6>STATE (94%)</h6>
                </div>
              </div>

                <div class="members-text">
                <p style="font-size: 13px;">  
                     I am very grateful to be the part of B.R SUPER LEARNERS PLATFORM. I have taken admission in this institution due to the college reputation and my  career goals....  "Opportunity don't happen , you create it",and this institution gives me an opportunity to fulfill my dreams .The faculty is the biggest strength of this institution and  teach  with great encouragement. As we know there is no substitution for hardwork  and hardwork is key of success ... And  being  a BRSUPERLEARNER we are destine to be the successful and a good human being
</p>
              </div>

                <div class="members-rating">
                <ul>
                  <li><i class="fas fa-star"></i></li>
                  <li><i class="fas fa-star"></i></li>
                  <li><i class="fas fa-star"></i></li>
                  <li><i class="fas fa-star"></i></li>
                  <li><i class="fas fa-star"></i></li>
                </ul>
              </div>

            </div>
          </div>


<!-- 4th end -->

     
      </div>
    </div>
  </div>
</section>
<!--End Testmonials Section --> 
<!--Start Pricing Table Section -->



<!-- Start Brand Wrapper -->
<div class="brand-wrapper" id="#mnvsection">
  <div class="container">
    <div class="sec-title text-center mb-0">
      <h2>Our <span>Mission & Vission</span></h2>
    
      <span class="decor"><span class="inner"></span></span> </div>
    <div class="row justify-content-center">
      <div class="col-lg-10">
      <blockquote>
        Our efforts to deliver quality education, we will emphasis more on the need to establish one to one contact with every student and be attentive to his /her need so that the teacher can monitor individual progress and guide them accordingly on the way to success. Our faculty team will be of committed bunch of professionals who will be responsible to make positive difference in the life of our students. We are also committed to bring change in the teaching learning process in which students can learn in free and unstressed environment. We are fully aware of our social responsibilities and humanitarian ground which will help us to contribute to the society.
      </blockquote>
      </div>
    </div>
  </div>
</div>
<!-- End Brand Wrapper --> 

<section class="contact-area inner-content-wrapper" id="contactsection">
  <div class="container">
    <div class="row">
        <div class="col-lg-8">
          <div class="contact-form">
            <div class="title">
              <h3>Write Us</h3>
            </div>
            <form id="contactForm">
              <div class="row">
                <div class="col-lg-6 col-md-12">
                  <div class="form-group">
                    <label>Name</label>
                    <input type="text" name="name" id="name" class="form-control" required data-error="Please enter your name">
                    <div class="help-block with-errors"></div>
                  </div>
                </div>
                <div class="col-lg-6 col-md-12">
                  <div class="form-group">
                    <label>Email Address</label>
                    <input type="email" name="email" id="email" class="form-control" required data-error="Please enter your email">
                    <div class="help-block with-errors"></div>
                  </div>
                </div>
                <div class="col-lg-12 col-md-12">
                  <div class="form-group">
                    <label>Subject</label>
                    <input type="text" name="msg_subject" id="msg_subject" class="form-control" required data-error="Please enter your subject">
                    <div class="help-block with-errors"></div>
                  </div>
                </div>
                <div class="col-lg-12 col-md-12">
                  <div class="form-group">
                    <label>Message</label>
                    <textarea name="message" class="form-control" id="message" cols="30" rows="5" required data-error="Write your message"></textarea>
                    <div class="help-block with-errors"></div>
                  </div>
                </div>
                <div class="col-lg-12 col-md-12">
                  <button type="submit" class="btn mt-3"> Send message <span></span> </button>
                </div>
              </div>
            </form>
          </div>
        </div>
        <div class="col-lg-4">
          <div class="contact-side-box">
            <div class="title">
              <h3>Contact BR SUPER LEARNERS</h3>
            </div>
          
            <div class="info-box">
              <div class="icon"> <i class="fa fa-map-marker"></i> </div>
              <h4>Address</h4>
              <span>BR Super Learners,Institute Of Science,Katol</span> </div>
            <div class="info-box">
              <div class="icon"> <i class="fa fa-phone"></i> </div>
              <h4>Phone</h4>
              <span> <a href="tel:+91-8605195919">+91-8605195919</a> </span> <span> <a href="tel:1012312-6688">+91-7083801183</a> </span> </div>
            <div class="info-box">
              <div class="icon"> <i class="fa fa-envelope-o"></i> </div>
              <h4>Email</h4>
              <span> <a href="mailto:brsuperlearners@gmail.com">brsuperlearners@gmail.com</a> </span> </div>
          </div>
        </div>
      </div>      
  </div>
</section>

<div class="copyright">
  <div class="container">
    <div class="row">
      <div class="col-lg-12 text-center">
        <p>©  <span id="year">2020</span>  <span class="color">ProgWiggle Data Solution PVT LTD</span>.</p>
      </div>
    </div>
  </div>
</div>

<!--jquery js --> 
<script src="{{url('front/js/jquery-min.js')}}"></script> 
<script src="{{url('front/js/popper.min.js')}}"></script> 
<!--jquery js --> 
<script src="{{url('front/js/bootstrap.min.js')}}"></script> 
<!--jquery js --> 
<script src="{{url('front/js/plugins.js')}}"></script> 
<!--Owl js --> 
<script src="{{url('front/js/owl.js')}}"></script> 
<!--Fontawesome js --> 
<script src="{{url('front/js/fontawesome.js')}}"></script> 
<!-- MagnificPopup JS --> 
<script src="{{url('front/js/jquery.magnific-popup.min.js')}}"></script> 
<!-- Meanmenu JS --> 
<script src="{{url('front/js/meanmenu.js')}}"></script> 
<!-- Count-to JS --> 
<script src="{{url('front/js/count-to.js')}}"></script> 
<!-- jQuery Appear JS --> 
<script src="{{url('front/js/jquery.appear.js')}}"></script> 
<!--jquery js --> 
<script src="{{url('front/js/custom.js')}}"></script>
</body>

<!-- Mirrored from sbtechnosoft.com/edupark/index.html by HTTrack Website Copier/3.x [XR&CO'2017], Fri, 31 Jul 2020 06:16:47 GMT -->
</html>
