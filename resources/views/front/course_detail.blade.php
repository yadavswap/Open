@extends('theme.master')
@section('title', "$course->title")
@section('content')

@include('admin.message')
<!-- course detail header start -->
<section id="about-home" class="about-home-main-block">
    <div class="container">
        <div class="row">
            <div class="col-lg-8">
                <div class="about-home-block text-white">
                    <h1 class="about-home-heading text-white">{{ $course['title'] }}</h1>
                    <p>{{ $course['short_detail'] }}</p> 
                    <ul>
                        <li>
                            <?php 
                            $learn = 0;
                            $price = 0;
                            $value = 0;
                            $sub_total = 0;
                            $sub_total = 0;
                            $reviews = App\ReviewRating::where('course_id',$course->id)->where('status','1')->get();
                            ?> 
                            @if(!empty($reviews[0]))
                                <?php
                                $count =  App\ReviewRating::where('course_id',$course->id)->count();

                                foreach($reviews as $review){
                                    $learn = $review->price*5;
                                    $price = $review->price*5;
                                    $value = $review->value*5;
                                    $sub_total = $sub_total + $learn + $price + $value;
                                }

                                $count = ($count*3) * 5;
                                $rat = $sub_total/$count;
                                $ratings_var = ($rat*100)/5;
                                ?>
                
                                <div class="pull-left">
                                    <div class="star-ratings-sprite"><span style="width:<?php echo $ratings_var; ?>%" class="star-ratings-sprite-rating"></span>
                                    </div>
                                </div>
                            @else
                             
                            @endif
                        </li>

                        <?php 
                            $learn = 0;
                            $price = 0;
                            $value = 0;
                            $sub_total = 0;
                            $count =  count($reviews);
                            $onlyrev = array();

                            $reviewcount = App\ReviewRating::where('course_id', $course->id)->where('status',"1")->WhereNotNull('review')->get();

                        foreach($reviews as $review){

                            $learn = $review->learn*5;
                            $price = $review->price*5;
                            $value = $review->value*5;
                            $sub_total = $sub_total + $learn + $price + $value;
                        }

                        $count = ($count*3) * 5;
                         
                        if($count != "")
                        {
                            $rat = $sub_total/$count;
                     
                            $ratings_var = ($rat*100)/5;
                   
                            $overallrating = ($ratings_var/2)/10;
                        }
                         
                        ?>

                        
                        @if(! $reviews->isEmpty())
                        <li>
                            {{ round($overallrating, 1) }} {{ __('frontstaticword.rating') }}
                        </li>
                        @endif
                        <li>
                            (@php
                                $data = App\ReviewRating::where('course_id', $course->id)->get();
                                if(count($data)>0){

                                    echo count($data);
                                }
                                else{

                                    echo "0";
                                }
                            @endphp {{ __('frontstaticword.Reviews') }})
                        </li>
                        <li>
                            @php
                                $data = App\Order::where('course_id', $course->id)->get();
                                if(count($data)>0){

                                    echo count($data);
                                }
                                else{

                                    echo "0";
                                }
                            @endphp 
                            {{ __('frontstaticword.studentsenrolled') }}
                        </li>
                    </ul>
                    <ul>
                        <li><a href="#" title="about">{{ __('frontstaticword.Created') }}: {{ $course->user['fname'] }} </a></li>
                        <li><a href="#" title="about">{{ __('frontstaticword.LastUpdated') }}: {{ date('jS F Y', strtotime($course['updated_at'])) }}</a></li>
                        @if($course['language_id'] == !NULL)
                        <li><a href="#" title="about"><i class="fa fa-comment"></i></a> {{ $course->language['name'] }}</li>
                        @endif
                    </ul>
                </div>
            </div>
            <!-- course preview -->
            <div class="col-lg-4">
               
                
                <div class="about-home-product">
                    <div class="video-item hidden-xs">
                        <script type="text/javascript">
                        @if($course->video !="")
                        var video_url = '<iframe src="{{ asset('video/preview/'.$course['video']) }}" frameborder="0" allowfullscreen></iframe>';
                        @endif
                        @if($course->url !="")
                        var video_url = '<iframe src="{{ str_replace('watch?v=','embed/',$course['url']) }}" frameborder="0" allowfullscreen></iframe>';
                        @endif
                        </script>
                        <div class="video-device">
                            @if($course['preview_image'] !== NULL && $course['preview_image'] !== '')
                                <img src="{{ asset('images/course/'.$course['preview_image']) }}" class="bg_img img-fluid" alt="Background">
                            @else
                                <img src="{{ Avatar::create($course->title)->toBase64() }}" class="bg_img img-fluid" alt="Background">
                            @endif
                            <div class="video-preview">
                                <a href="javascript:void(0);" class="btn-video-play"><i class="fa fa-play"></i></a>
                            </div>
                        </div>
                    </div>
               
                     
                    <div class="about-home-dtl-training">
                        <div class="about-home-dtl-block btm-10">
                        @if($course->type == 1)
                            <div class="about-home-rate">
                                <ul>
                                    @php
                                        $currency = App\Currency::first();
                                    @endphp
                                    @if($course->discount_price == !NULL) 
                                        <li><i class="{{ $currency['icon'] }}"></i>{{ $course['discount_price'] }}</li>
                                        <li><span><s><i class="{{ $currency->icon }}"></i>{{ $course['price'] }}</s></span></li>
                                    @else
                                        <li><i class="{{ $currency['icon'] }}"></i>{{ $course['price'] }}</li>
                                    @endif

                                </ul>
                            </div>
                            @if(Auth::check())
                                @if(Auth::User()->role == "admin")
                                    <div class="about-home-btn btm-20">
                                        <a href="{{url('show/coursecontent',$course->id)}}" class="btn btn-secondary" title="course">{{ __('frontstaticword.GoToCourse') }}</a>
                                    </div>
                                @else
                                    @if(isset($course->duration))
                                    <div class="course-duration btm-10">{{ __('frontstaticword.EnrollDuration') }}: {{ $course->duration }} Months</div>
                                    @endif

                                    @php
                                        $order = App\Order::where('user_id', Auth::User()->id)->where('course_id', $course->id)->first();
                                    @endphp

                                   

                                    @if(!empty($order) && $order->status == 1)
                                       
                                        <div class="about-home-btn btm-20">
                                            <a href="{{url('show/coursecontent',$course->id)}}" class="btn btn-secondary" title="course">{{ __('frontstaticword.GoToCourse') }}</a>
                                        </div>

                                    @else
                                        @php
                                            $cart = App\Cart::where('user_id', Auth::User()->id)->where('course_id', $course->id)->first();
                                        @endphp
                                        @if(!empty($cart))
                                            <div class="about-home-btn btm-20">
                                                <form id="demo-form2" method="post" action="{{ route('remove.item.cart',$cart->id) }}">
                                                    {{ csrf_field() }}
                                                            
                                                    <div class="box-footer">
                                                     <button type="submit" class="btn btn-primary"><i class="fa fa-shopping-cart" aria-hidden="true"></i>&nbsp;{{ __('frontstaticword.RemoveFromCart') }}</button>
                                                    </div>
                                                </form>
                                            </div>
                                        @else
                                            <div class="about-home-btn btm-20">
                                                <form id="demo-form2" method="post" action="{{ route('addtocart',['course_id' => $course->id, 'price' => $course->price, 'discount_price' => $course->discount_price ]) }}"
                                                    data-parsley-validate class="form-horizontal form-label-left">
                                                        {{ csrf_field() }}

                                                    <input type="hidden" name="category_id"  value="{{$course->category->id}}" />
                                                            
                                                    <div class="box-footer">
                                                     <button type="submit" class="btn btn-primary"><i class="fa fa-cart-plus" aria-hidden="true"></i>&nbsp;{{ __('frontstaticword.AddToCart') }}</button>
                                                    </div>
                                                </form>
                                            </div>
                                        @endif
                                    @endif
                                @endif
                            @else
                                <div class="about-home-btn btm-20">
                                    <a href="{{ route('login') }}" class="btn btn-primary"><i class="fa fa-cart-plus" aria-hidden="true"></i>&nbsp;{{ __('frontstaticword.AddToCart') }}</a>
                                </div>
                            @endif
                        @else
                            
                            @if(Auth::check())
                                @if(Auth::User()->role == "admin")
                                    <div class="about-home-btn btm-20">
                                        <a href="{{url('show/coursecontent',$course->id)}}" class="btn btn-secondary" title="course">{{ __('frontstaticword.GoToCourse') }}</a>
                                    </div>
                                @else
                                    @php
                                        $enroll = App\Order::where('user_id', Auth::User()->id)->where('course_id', $course->id)->first();
                                    @endphp
                                    @if($enroll == NULL)
                                        <div class="about-home-btn btm-20">
                                            <a href="{{url('enroll/show',$course->id)}}" class="btn btn-primary" title="Enroll Now">{{ __('frontstaticword.EnrollNow') }}</a>
                                        </div>
                                    @else
                                        <div class="about-home-btn btm-20">
                                            <a href="{{url('show/coursecontent',$course->id)}}" class="btn btn-secondary" title="Cart">{{ __('frontstaticword.GoToCourse') }}</a>
                                        </div>
                                    @endif
                                @endif
                            @else
                                <div class="about-home-btn btm-20">
                                    <a href="{{ route('login') }}" class="btn btn-primary" title="Enroll Now">{{ __('frontstaticword.EnrollNow') }}</a>
                                </div>
                            @endif
                        @endif
                            <div class="about-home-includes-list btm-40">
                                <ul class="btm-40">
                                    @if($courseinclude->isNotEmpty())
                                        <li><span>Course Includes</span></li>
                                        @foreach($course->include as $in)
                                            @if($in->status ==1)
                                                <li><i class="fa {{ $in->icon }}"></i>{{ str_limit($in->detail, $limit = 50, $end = '...') }}</li>
                                            @endif
                                        @endforeach
                                    @endif
                                </ul>
                            </div>
                            <hr>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- course header end -->
<!-- course detail start -->
<section id="about-product" class="about-product-main-block">
    <div class="container">
        <div class="row">
            <div class="col-lg-8">
                @if($whatlearns->isNotEmpty())
                    <div class="product-learn-block">
                        <h3 class="product-learn-heading">{{ __('frontstaticword.Whatlearn') }}</h2>
                        <div class="row">
                            @foreach($course['whatlearns'] as $wl)
                            @if($wl->status ==1)
                            <div class="col-lg-6 col-md-6">
                                <div class="product-learn-dtl">
                                    <ul>
                                        <li><i class="fa fa-check"></i>{{ str_limit($wl['detail'], $limit = 120, $end = '...') }}</li>
                                    </ul>
                                </div>
                            </div>
                            @endif
                            @endforeach
                        </div>
                    </div>
                @endif
            
                <div class="description-block btm-30">
                    <h3>{{ __('frontstaticword.Description') }}</h3>

                    <p>{{ $course->detail }}</p>
               
                </div>

                @auth
                @php
                    $alreadyrated = App\ReviewRating::where('course_id', $course->id)->limit(1)->first();
                @endphp
                @if($alreadyrated == !NULL)
                @if($alreadyrated->featured == 1)
                    <div class="featured-review btm-40">
                        <h3>{{ __('frontstaticword.FeaturedReview') }}</h3>
                        <?php

                            $user_count = count([$alreadyrated]);
                            $user_sub_total = 0;
                            $user_learn_t = $alreadyrated->learn * 5;
                            $user_price_t = $alreadyrated->price * 5;
                            $user_value_t = $alreadyrated->value * 5;
                            $user_sub_total = $user_sub_total + $user_learn_t + $user_price_t + $user_value_t;

                            $user_count = ($user_count * 3) * 5;
                            $rat1 = $user_sub_total / $user_count;
                            $ratings_var1 = ($rat1 * 100) / 5;

                        ?>
                       
                    </div>
                @endif
                @endif
                @endauth

                @if($coursechapters->isNotEmpty())
                <div class="course-content-block btm-30">
                    <h3>{{ __('frontstaticword.CourseContent') }}</h3>
                    <div class="faq-block">
                        <div class="faq-dtl">
                            <div id="accordion" class="second-accordion">
                                @foreach($coursechapters as $chapter)
                                @if($chapter->status == 1 and $chapter->count() > 0 )
                                
                                <div class="card">
                                    <div class="card-header" id="headingTwo{{ $chapter->id }}">
                                        <div class="mb-0">
                                            <button class="btn btn-link" data-toggle="collapse" data-target="#collapseTwo{{ $chapter->id }}" aria-expanded="false" aria-controls="collapseTwo">
                                               
                                                <div class="row">
                                                <div class="col-lg-8 col-6">
                                                    {{ $chapter['chapter_name'] }}
                                                </div>
                                                <div class="col-lg-2 col-6">
                                                    <div class="text-right">
                                                        @php
                                                            $classone = App\CourseClass::where('coursechapter_id', $chapter->id)->get();
                                                            if(count($classone)>0){

                                                                echo count($classone);
                                                            }
                                                            else{

                                                                echo "0";
                                                            }
                                                        @endphp
                                                        {{ __('frontstaticword.Classes') }}
                                                    </div>
                                                </div>

                                                <div class="col-lg-2 col-12">
                                                    <div class="text-right">
                                                        @php
                                                        echo $classtwo =  App\CourseClass::where('coursechapter_id', $chapter->id)->sum("duration");
                                                        @endphp
                                                        min
                                                    </div>
                                                </div>
                                            </div>
                                            
                                            </button>
                                        </div>

                                    </div>
                                    <div id="collapseTwo{{ $chapter->id }}" class="collapse {{ $loop->first ? "show" : "" }}" aria-labelledby="headingTwo" data-parent="#accordion">
                                        
                                        <div class="card-body">
                                            <table class="table">  
                                                <tbody>
                                                    @foreach($courseclass as $class)
                                                    @if($class->coursechapter_id == $chapter->id)
                                                    <tr>
                                                        <th class="class-icon">
                                                        @if($class->type =='video' )
                                                        <a href="#" title="Course"><i class="fa fa-play-circle"></i></a>
                                                        @endif
                                                        @if($class->type =='image' )
                                                        <a href="#" title="Course"><i class="fas fa-image"></i></a>
                                                        @endif
                                                        @if($class->type =='pdf' )
                                                        <a href="#" title="Course"><i class="fas fa-file-pdf"></i></a>
                                                        @endif
                                                        @if($class->type =='zip' )
                                                        <a href="#" title="Course"><i class="far fa-file-archive"></i></a>
                                                        @endif
                                                        </th>

                                                        <td><a href="#" title="Course">{{ $class['title'] }}</a>&nbsp;
                                                            @if($class->date_time != NULL)
                                                           <div class="live-class">Live at: {{ $class->date_time }}</div>
                                                        @endif
                                                        </td>

                                                        <td>
                                                            @if($class->preview_url != NULL || $class->preview_video != NULL )

                                                            <a href="{{ route('lightbox',$class->id) }}" class="iframe" style="display: block;">preview</a>

                                                            @endif

                                                        </td>

                                                        
                                                        <td class="txt-rgt">
                                                        @if($class->type =='video')
                                                        {{ $class['duration'] }}min
                                                        @else
                                                        {{ $class['size'] }}mb
                                                        @endif
                                                        </td>
                                                        
                                                    </tr>
                                                    @endif
                                                    @endforeach
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                               
                                @endif
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>
                @endif
              
                <div class="about-instructor-block">
                    <h3>Teacher Details</h3>
                    
                    <div class="about-instructor btm-40">
                        <div class="row">
                            <div class="col-lg-4 col-sm-4">
                                <div class="instructor-img btm-30">
                                    @if($course->user->user_img != null || $course->user->user_img !='')
                                      <img src="{{ asset('images/user_img/'.$course->user['user_img']) }}" class="img-fluid"  alt="instructor" >
                                    @else
                                      <img src="{{ asset('images/default/user.jpg')}}" class="img-fluid" alt="instructor">
                                    @endif
                                </div>
                            </div>
                            <div class="col-lg-8 col-sm-8">
                                <div class="instructor-block">
                                    <div class="instructor-name btm-10"><a href="#" title="instructor-name">{{ $course->user['fname'] }}</a></div>
                                    <div class="instructor-post btm-20">{{ __('frontstaticword.AboutInstructor') }}</div>
                                    <p>{!! $course->user['detail'] !!}</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                
                @if(! $reviews->isEmpty())
                <div class="student-feedback btm-40">
                    <h3 class="student-feedback-heading">{{ __('frontstaticword.StudentFeedback') }}</h3>
                    <div class="student-feedback-block">

                        <div class="rating">
                            <?php 
                                $learn = 0;
                                $price = 0;
                                $value = 0;
                                $sub_total = 0;
                                $count =  count($reviews);
                                $onlyrev = array();

                                $reviewcount = App\ReviewRating::where('course_id',1)->where('status',"1")->WhereNotNull('review')->get();

                            foreach($reviews as $review){

                                $learn = $review->learn*5;
                                $price = $review->price*5;
                                $value = $review->value*5;
                                $sub_total = $sub_total + $learn + $price + $value;
                            }

                            $count = ($count*3) * 5;
                             
                            if($count != "")
                            {
                                $rat = $sub_total/$count;
                         
                                $ratings_var = ($rat*100)/5;
                       
                                $overallrating = ($ratings_var/2)/10;
                            }
                             
                            ?>

                            <div class="rating-num">{{ round($overallrating, 1) }}</div>
                            
                            <?php 
                            $learn = 0;
                            $price = 0;
                            $value = 0;
                            $sub_total = 0;
                            $sub_total = 0;
                            $reviews = App\ReviewRating::where('course_id',$course->id)->where('status','1')->get();
                            ?> 
                            @if(!empty($reviews[0]))
                                <?php
                                $count =  App\ReviewRating::where('course_id',$course->id)->count();

                                foreach($reviews as $review){
                                    $learn = $review->learn*5;
                                    $price = $review->price*5;
                                    $value = $review->value*5;
                                    $sub_total = $sub_total + $learn + $price + $value;
                                }

                                $count = ($count*3) * 5;
                                $rat = $sub_total/$count;
                                $ratings_var = ($rat*100)/5;
                                ?>
                                <div class="pull-left">
                                    <div class="star-ratings-sprite star-ratings-center"><span style="width:<?php echo $ratings_var; ?>%" class="star-ratings-sprite-rating"></span>
                                    </div>
                                </div>
                            @else
                                <div class="pull-left">
                                    <div class="star-ratings-sprite star-ratings-center"><span style="width:%" class="star-ratings-sprite-rating"></span>
                                    </div>
                                </div>
                            @endif
                            <div class="rating-users">{{ __('frontstaticword.CourseRating') }}</div>
                        </div>
                        <div class="histo">
                            <div class="three histo-rate">
                                <span class="histo-star">
                                    <?php 
                                    $learn = 0;
                                    $total = 0;
                                    $reviews = App\ReviewRating::where('course_id',$course->id)->where('status','1')->get();
                                    ?> 
                                    @if(!empty($reviews[0]))
                                        <?php
                                        $count =  App\ReviewRating::where('course_id',$course->id)->count();

                                        foreach($reviews as $review){
                                            $learn = $review->learn*5;
                                            $total = $total + $learn;
                                        }

                                        $count = ($count*1) * 5;
                                        $rat = $total/$count;
                                        $ratings_var = ($rat*100)/5;
                                        ?>
                        
                                        <div class="pull-left">
                                            <div class="star-ratings-sprite star-ratings-center"><span style="width:<?php echo $ratings_var; ?>%" class="star-ratings-sprite-rating"></span>
                                            </div>
                                        </div>
                                     
                                    @else
                                        <div class="pull-left">
                                            <div class="star-ratings-sprite star-ratings-center"><span style="width:%" class="star-ratings-sprite-rating"></span>
                                            </div>
                                        </div>
                                    @endif
                                </span>
                                <span class="histo-percent">
                                    <a href="#" title="rate">{{ round($ratings_var) }}%</a>
                                </span>
                                <span class="bar-block">
                                    <span id="bar-three" style=" width:{{ $ratings_var }}%;" class="bar bar-clr bar-radius">&nbsp;</span> 
                                </span>
                            </div>
                            <div class="two histo-rate">
                                <span class="histo-star">
                                    <?php 
                                    $price = 0;
                                    $total = 0;
                                    $reviews = App\ReviewRating::where('course_id',$course->id)->where('status','1')->get();
                                    ?> 
                                    @if(!empty($reviews[0]))
                                        <?php
                                        $count =  App\ReviewRating::where('course_id',$course->id)->count();

                                        foreach($reviews as $review){
                                            $price = $review->price*5;
                                            $total = $total + $price;
                                        }

                                        $count = ($count*1) * 5;
                                        $rat = $total/$count;
                                        $ratings_var = ($rat*100)/5;
                                        ?>
                        
                                        <div class="pull-left">
                                            <div class="star-ratings-sprite star-ratings-center"><span style="width:<?php echo $ratings_var; ?>%" class="star-ratings-sprite-rating"></span>
                                            </div>
                                        </div>
                                     
                                    @else
                                        <div class="pull-left">
                                            <div class="star-ratings-sprite star-ratings-center"><span style="width:%" class="star-ratings-sprite-rating"></span>
                                            </div>
                                        </div>
                                    @endif
                                </span>
                                <span class="histo-percent">
                                    <a href="#" title="rate">{{ round($ratings_var) }}%</a>
                                </span>
                                <span class="bar-block">
                                    <span id="bar-two" style="width: {{ $ratings_var }}%" class="bar bar-clr bar-radius">&nbsp;</span> 
                                </span>
                            </div>
                            <div class="one histo-rate">
                                <span class="histo-star">
                                    <?php 
                                    $value = 0;
                                    $total = 0;
                                    $reviews = App\ReviewRating::where('course_id',$course->id)->where('status','1')->get();
                                    ?> 
                                    @if(!empty($reviews[0]))
                                        <?php
                                        $count =  App\ReviewRating::where('course_id',$course->id)->count();

                                        foreach($reviews as $review){
                                            $value = $review->value*5;
                                            $total = $total + $value;
                                        }

                                        $count = ($count*1) * 5;
                                        $rat = $total/$count;
                                        $ratings_var = ($rat*100)/5;
                                        ?>
                        
                                        <div class="pull-left">
                                            <div class="star-ratings-sprite star-ratings-center"><span style="width:<?php echo $ratings_var; ?>%" class="star-ratings-sprite-rating"></span>
                                            </div>
                                        </div>
                                     
                                    @else
                                        <div class="pull-left">
                                            <div class="star-ratings-sprite star-ratings-center"><span style="width:%" class="star-ratings-sprite-rating"></span>
                                            </div>
                                        </div>
                                    @endif
                                </span>
                                <span class="histo-percent">
                                    <a href="#" title="rate">{{ round($ratings_var) }}%</a>
                                </span>
                                <span class="bar-block">
                                    <span id="bar-one" style="width: {{ $ratings_var }}%" class="bar bar-clr bar-radius">&nbsp;</span> 
                                </span>
                            </div>
                        </div>
                    </div>
                </div>
                <hr>
                @endif
                @auth
           



                    @php
                        $alreadyrated = App\ReviewRating::where('course_id', $course->id)->first();
                    @endphp
                    @if($alreadyrated == !NULL)

                    <div class="review-dtl">
                        <?php

                            $user_count = count([$alreadyrated]);
                            $user_sub_total = 0;
                            $user_learn_t = $alreadyrated->learn * 5;
                            $user_price_t = $alreadyrated->price * 5;
                            $user_value_t = $alreadyrated->value * 5;
                            $user_sub_total = $user_sub_total + $user_learn_t + $user_price_t + $user_value_t;

                            $user_count = ($user_count * 3) * 5;
                            $rat1 = $user_sub_total / $user_count;
                            $ratings_var1 = ($rat1 * 100) / 5;

                        ?>
                        @if(isset($alreadyrated))
                        @foreach($course->review as $rating)
                        @if($rating->review == !null && $rating->status == 1 && $rating->approved == 1)
                        <div class="row btm-20">
                            <div class="col-lg-4">
                                <div class="review-img text-white">
                                 {{ $rating->user->fname[0] }}{{ $rating->user->lname[0]  }}</div>
                                <div class="review-img-block">
                                    <div class="review-month">{{ date('d-m-Y', strtotime($rating['created_at'])) }}</div>
                                    <div class="review-name">{{ $rating->user['fname'] }}</div>
                                </div>
                            </div>
                            <div class="col-lg-8">
                                <div class="review-rating">
                                    <div class="pull-left-review">
                                        <div class="star-ratings-sprite"><span style="width:<?php echo $ratings_var1; ?>%" class="star-ratings-sprite-rating"></span>
                                        </div>
                                    </div>
                                    <div class="review-text">
                                        <p>{{ $rating['review'] }}<p>
                                    </div>
                                    
                                    <div class="review">{{ __('frontstaticword.helpful') }}?
                                        @php
                                        $help = App\ReviewHelpful::where('user_id', Auth::User()->id)->where('review_id', $rating->id)->first();
                                        @endphp
                                      
                                        @if($help == !NULL)
                                            <div class="helpful">
                                                <form  method="post" action="{{route('helpful.delete', $course->id)}}" data-parsley-validate class="form-horizontal form-label-left">
                                                    {{ csrf_field() }}
                                                    <button type="submit" class="btn btn-link lft-7 rgt-10 yes-submitted"><i class="fa fa-check"></i> {{ __('frontstaticword.Yes') }}</button>
                                                </form>
                                            </div>
                                            
                                        @else
                                            <div class="helpful">
                                                <form  method="post" action="{{route('helpful', $course->id)}}" data-parsley-validate class="form-horizontal form-label-left">
                                                {{ csrf_field() }}

                                                <input type="hidden" name="user_id"  value="{{Auth::User()->id}}" />

                                                <input type="hidden" name="review_id"  value="{{ $rating->id }}" />

                                                <input type="hidden" name="helpful"  value="yes" />
                                                
                                                  <button type="submit" class="btn btn-link lft-7 rgt-10">{{ __('frontstaticword.Yes') }}</button>
                                                </form>
                                            </div>
                                        @endif
                                        {{-- report --}}
                                        <a href="#" data-toggle="modal" data-target="#myModalreport"  title="report">{{ __('frontstaticword.Report') }}</a>
                                        <div class="modal fade" id="myModalreport" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                                            <div class="modal-dialog modal-lg" role="document">
                                              <div class="modal-content">
                                                <div class="modal-header">
                                                  <h4 class="modal-title" id="myModalLabel">{{ __('frontstaticword.Report') }}</h4>
                                                  <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                                </div>
                                                <div class="box box-primary">
                                                  <div class="panel panel-sum">
                                                    <div class="modal-body">
                                                        @php
                                                            $courses = App\Course::first();
                                                        @endphp
                                                        <form id="demo-form2" method="post" action="{{ route('report.review', $course->id) }}"              data-parsley-validate class="form-horizontal form-label-left">
                                                            {{ csrf_field() }}

                                                            <input type="hidden" name="review_id"  value="{{ $rating->id }}" />
                                                                    
                                                            <div class="row">
                                                              <div class="col-md-6">
                                                                <div class="form-group">
                                                                    <label for="title">{{ __('frontstaticword.Title') }}:<sup class="redstar">*</sup></label>
                                                                    <input type="text" class="form-control" name="title" id="title" placeholder="Please Enter Title" value="">
                                                                </div>
                                                              </div>
                                                              <div class="col-md-6">
                                                                <div class="form-group">
                                                                    <label for="email">{{ __('frontstaticword.Email') }}:<sup class="redstar">*</sup></label>
                                                                    <input type="email" class="form-control" name="email" id="title" placeholder="Please Enter Email" value="{{ Auth::User()->email }}" required>
                                                                </div>
                                                              </div>
                                                            </div>
                                                            <div class="row">
                                                              <div class="col-md-12">
                                                                <div class="form-group">
                                                                    <label for="detail">{{ __('frontstaticword.Detail') }}:<sup class="redstar">*</sup></label>
                                                                    <textarea name="detail" rows="4"  class="form-control" placeholder=""></textarea>
                                                                </div>
                                                              </div>
                                                            </div>
                                                            <br>
                                                            <div class="box-footer">
                                                             <button type="submit" class="btn btn-lg col-md-3 btn-primary">{{ __('frontstaticword.Submit') }}</button>
                                                            </div>
                                                        </form>
                                                    </div>
                                                  </div>
                                                </div>
                                              </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <hr>
                        @endif
                        @endforeach
                        @endif
                    </div>
                    @endif
                    
                </div>
                @endauth
                
                @if(!$relatedcourse->isEmpty())
                <div class="more-courses btm-30">
                    <h2 class="more-courses-heading">{{ __('frontstaticword.RelatedCourses') }}</h2>
                    <div class="row">
                        @foreach($relatedcourse as $rel)
                        @if($rel->status ==1)
                        <div class="col-lg-4 col-sm-6">
                            <div class="together-img">
                                <div class="student-view-block">
                                    <div class="view-block">
                                        <div class="view-img">
                                            @if($rel->courses['preview_image'] !== NULL && $rel->courses['preview_image'] !== '')
                                                <a href="{{ route('user.course.show',['id' => $rel->course_id, 'slug' => $rel->courses->slug ]) }}"><img src="{{ asset('images/course/'.$rel->courses->preview_image) }}" alt="student">
                                                </a>
                                            @else
                                                <a href="{{ route('user.course.show',['id' => $rel->course_id, 'slug' => $rel->courses->slug ]) }}"><img src="{{ Avatar::create($rel->courses->title)->toBase64() }}" alt="student">
                                                </a>
                                            @endif
                                        </div>
                                        {{-- Add to wishlisht --}}
                                        @if (Auth::check())
                                        @php
                                            $wishtt = App\Wishlist::where('user_id', Auth::User()->id)->where('course_id', $rel->course_id)->first();
                                        @endphp
                                        @if ($wishtt == NULL)
                                            <div class="heart">
                                                <form id="demo-form2" method="post" action="{{ url('show/wishlist', $rel->course_id) }}" data-parsley-validate 
                                                    class="form-horizontal form-label-left">
                                                    {{ csrf_field() }}

                                                    <input type="hidden" name="user_id"  value="{{Auth::User()->id}}" />
                                                    <input type="hidden" name="course_id"  value="{{$rel->course_id}}" />

                                                    <button class="wishlisht-btn heart" title="Add to wishlist" type="submit"><i class="fa fa-heart rgt-10"></i></button>
                                                </form>
                                            </div>
                                        @else
                                            <div class="heart-two">
                                                <form id="demo-form2" method="post" action="{{ url('remove/wishlist', $rel->course_id) }}" data-parsley-validate 
                                                    class="form-horizontal form-label-left">
                                                    {{ csrf_field() }}

                                                    <input type="hidden" name="user_id"  value="{{Auth::User()->id}}" />
                                                    <input type="hidden" name="course_id"  value="{{$rel->course_id}}" />

                                                    <button class="wishlisht-btn heart"  title="Remove from Wishlist" type="submit"><i class="fa fa-heart rgt-10"></i></button>
                                                </form>
                                            </div>
                                        @endif
                                        @else
                                            <div class="heart">
                                                <a href="{{ route('login') }}" title="heart"><i class="fa fa-heart rgt-10"></i></a>
                                            </div>
                                        @endif
                                        {{-- Add to wishlisht end--}}

                                        <div class="view-dtl">
                                            <div class="view-heading btm-10"><a href="{{ route('user.course.show',['id' => $rel->course_id, 'slug' => $rel->courses->slug ]) }}">{{ str_limit($rel->courses['title'], $limit = 30, $end = '...') }}</a></div>
                                            <p class="btm-10"><a herf="#">by {{ $rel->user['fname'] }}</a></p>
                                            <div class="rating">
                                                <ul>
                                                    <li>
                                                    <?php 
                                                    $learn = 0;
                                                    $price = 0;
                                                    $value = 0;
                                                    $sub_total = 0;
                                                    $sub_total = 0;
                                                    $reviews = App\ReviewRating::where('course_id',$rel->course_id)->where('status','1')->get();
                                                    ?> 
                                                    @if(!empty($reviews[0]))
                                                    <?php
                                                    $count =  App\ReviewRating::where('course_id',$rel->course_id)->count();

                                                    foreach($reviews as $review){
                                                        $learn = $review->price*5;
                                                        $price = $review->price*5;
                                                        $value = $review->value*5;
                                                        $sub_total = $sub_total + $learn + $price + $value;
                                                    }

                                                    $count = ($count*3) * 5;
                                                    $rat = $sub_total/$count;
                                                    $ratings_var = ($rat*100)/5;
                                                    ?>
                                    
                                                    <div class="pull-left">
                                                        <div class="star-ratings-sprite"><span style="width:<?php echo $ratings_var; ?>%" class="star-ratings-sprite-rating"></span>
                                                        </div>
                                                    </div>
                                                    @else
                                                        <div class="pull-left no-rating">
                                                            {{ __('frontstaticword.NoRating') }}
                                                        </div>
                                                    @endif 
                                                    </li>

                                                    <?php 
                                                    $learn = 0;
                                                    $price = 0;
                                                    $value = 0;
                                                    $sub_total = 0;
                                                    $count =  count($reviews);
                                                    $onlyrev = array();

                                                    $reviewcount = App\ReviewRating::where('course_id', $course->id)->where('status',"1")->WhereNotNull('review')->get();

                                                    foreach($reviews as $review){

                                                        $learn = $review->learn*5;
                                                        $price = $review->price*5;
                                                        $value = $review->value*5;
                                                        $sub_total = $sub_total + $learn + $price + $value;
                                                    }

                                                    $count = ($count*3) * 5;
                                                     
                                                    if($count != "")
                                                    {
                                                        $rat = $sub_total/$count;
                                                 
                                                        $ratings_var = ($rat*100)/5;
                                               
                                                        $overallrating = ($ratings_var/2)/10;
                                                    }
                                                     
                                                    ?>

                                                    @php
                                                        $reviewsrating = App\ReviewRating::where('course_id', $rel->course_id)->first();
                                                    @endphp
                                                    @if(!empty($reviewsrating))
                                                    <li>
                                                        <b>({{ round($overallrating, 1) }})</b>
                                                    </li>
                                                    @endif
                                                </ul>
                                            </div>
                                            @if( $rel->courses->type == 1)
                                                @php
                                                    $currency2 = App\Currency::first();
                                                @endphp
                                                @if($rel->courses->discount_price == !NULL)
                                                    <div class="rate text-right">
                                                        <ul>
                                                            <li><a><b><i class="{{ $currency2['icon'] }}"></i>{{ $rel->courses['discount_price'] }}</b></a></li>&nbsp;
                                                            <li><a><b><strike><i class="{{ $currency2['icon'] }}"></i>{{ $rel->courses['price'] }}</strike></b></a></li>
                                                        </ul>
                                                    </div>
                                                @else
                                                    <div class="rate text-right">
                                                        <ul>
                                                            <li><a><b><i class="{{ $currency2['icon'] }}"></i>{{ $rel->courses['price'] }}</b></a></li>
                                                        </ul>
                                                    </div>
                                                @endif
                                            @else
                                                <div class="rate text-right">
                                                    <ul>
                                                        <li><a><b>{{ __('frontstaticword.Free') }}</b></a></li>
                                                    </ul>
                                                </div>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        @endif
                        @endforeach
                    </div>
                </div>
                @endif
                @if(Auth::check())
                   
                @else
                   
                @endif

                <!--Model start-->
                @auth
              
                @endauth
                <!--Model close -->
            </div>
        </div>
    </div>
</section>
<!-- course detail end -->
@endsection


@section('custom-script')


<script>
// Hide the extra content initially, using JS so that if JS is disabled, no problemo:
    $('.read-more-content').addClass('hide_content')
    $('.read-more-show, .read-more-hide').removeClass('hide_content')

    // Set up the toggle effect:
    $('.read-more-show').on('click', function(e) {
      $(this).next('.read-more-content').removeClass('hide_content');
      $(this).addClass('hide_content');
      e.preventDefault();
    });

    // Changes contributed by @diego-rzg
    $('.read-more-hide').on('click', function(e) {
      var p = $(this).parent('.read-more-content');
      p.addClass('hide_content');
      p.prev('.read-more-show').removeClass('hide_content'); // Hide only the preceding "Read More"
      e.preventDefault();
    });
</script>

<script>
(function($) {
  "use strict";
  $(document).ready(function(){
    
    $(".group1").colorbox({rel:'group1'});
    $(".group2").colorbox({rel:'group2', transition:"fade"});
    $(".group3").colorbox({rel:'group3', transition:"none", width:"75%", height:"75%"});
    $(".group4").colorbox({rel:'group4', slideshow:true});
    $(".ajax").colorbox();
    $(".youtube").colorbox({iframe:true, innerWidth:640, innerHeight:390});
    $(".vimeo").colorbox({iframe:true, innerWidth:500, innerHeight:409});
    $(".iframe").colorbox({iframe:true, width:"50%", height:"50%"});
    $(".inline").colorbox({inline:true, width:"50%"});
    $(".callbacks").colorbox({
      onOpen:function(){ alert('onOpen: colorbox is about to open'); },
      onLoad:function(){ alert('onLoad: colorbox has started to load the targeted content'); },
      onComplete:function(){ alert('onComplete: colorbox has displayed the loaded content'); },
      onCleanup:function(){ alert('onCleanup: colorbox has begun the close process'); },
      onClosed:function(){ alert('onClosed: colorbox has completely closed'); }
    });

    $('.non-retina').colorbox({rel:'group5', transition:'none'})
    $('.retina').colorbox({rel:'group5', transition:'none', retinaImage:true, retinaUrl:true});
    
    
    $("#click").click(function(){ 
      $('#click').css({"background-color":"#f00", "color":"#fff", "cursor":"inherit"}).text("Open this window again and this message will still be here.");
      return false;
    });
  });
})(jQuery);
</script>
@endsection


<style type="text/css">
    .read-more-show{
      cursor:pointer;
      color: #0284A2;
    }
    .read-more-hide{
      cursor:pointer;
      color: #0284A2;
    }

    .hide_content{
      display: none;
    }
</style>