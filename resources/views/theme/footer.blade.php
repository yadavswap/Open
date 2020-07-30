<footer id="footer" class="footer-main-block">
    <div class="container">
        <div class="footer-block">
            <div class="row">
                @php
                    $widgets = App\WidgetSetting::first();
                @endphp
                @if(isset($widgets))

                <div class="col-lg-3 col-md-6">
                    <div class="widget"><b>{{ $widgets->widget_one }}</b></div>
                    <div class="footer-link">
                        <ul>
                            @if($gsetting->instructor_enable == 1)
                                @if(Auth::check())
                                    @if(Auth::User()->role == "user")
                                    <li><a href="#" data-toggle="modal" data-target="#myModalinstructor" title="Become An Instructor">{{ __('frontstaticword.BecomeAnInstructor') }}</a></li>
                                    @endif
                                @else
                                    <li><a href="{{ route('login') }}" title="Become an instructor">{{ __('frontstaticword.BecomeAnInstructor') }}</a></li>
                                @endif
                            @endif
                            <li><a href="{{ route('about.show') }}" title="About">{{ __('frontstaticword.Aboutus') }}</a></li>
                            @if(Auth::check())
                                <li><a href="{{url('user_contact')}}" title="About">{{ __('frontstaticword.Contactus') }}</a></li>
                            @else
                                <li><a href="{{ route('login') }}" title="Contact Us">{{ __('frontstaticword.Contactus') }}</a></li>
                            @endif
                        </ul>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6">
                    <div class="widget"><b>{{ $widgets->widget_two }}</b></div>
                    <div class="footer-link">
                        <ul>
                            <li><a href="{{ route('careers.show') }}" title="Careers">{{ __('frontstaticword.Careers') }}</a></li>
                            <li><a href="{{ route('blog.all') }}" title="Blog">{{ __('frontstaticword.Blog') }}</a></li>
                            
                        </ul>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6">
                    <div class="widget"><b>{{ $widgets->widget_three }}</b></div>
                    <div class="footer-link">
                        <ul>
                            <li><a href="{{ route('help.show') }}" title="Help">{{ __('frontstaticword.Help&Support') }}</a></li>
                            @php
                                $pages = App\Page::get();
                            @endphp
                            
                            @if(isset($pages))
                            @foreach($pages as $page)
                                <li><a href="{{ route('page.show', $page->slug) }}" title="Help">{{ $page->title }}</a></li>
                            @endforeach
                            @endif
                            
                        </ul>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6">
                    @php
                        $languages = App\Language::all(); 
                    @endphp
                    @if(isset($languages) && count($languages) > 0)
                    <div class="footer-dropdown txt-rgt">
                        <a href="#" class="a" data-toggle="dropdown"><i class="fa fa-globe rgt-15"></i>{{Session::has('changed_language') ? ucfirst(Session::get('changed_language')) : ''}}<i class="fa fa-angle-up lft-10"></i></a>

                        
                       
                        <ul class="dropdown-menu">
                          
                            @foreach($languages as $language)
                            <a href="{{ route('languageSwitch', $language->local) }}"><li>{{$language->name}}</li></a>
                            @endforeach
                        </ul>
                    </div>
                    @endif
                </div>
                @endif
            </div>
        </div>
        <div class="footer-local-page">
            <ul>
                @php
                    $languages = App\Language::all(); 
                @endphp
                @if(isset($languages) && count($languages) > 0)
                    <li class="active"><a href="#"><b>{{ __('frontstaticword.LocalHomePages') }}:</b></a></li>
                
                    @foreach($languages as $language)
                    <li><a href="{{ route('languageSwitch', $language->local) }}">{{$language->name}}</a></li>
                    @endforeach
                @endif
            </ul> 
        </div>
    </div>
    <hr>
    <div class="tiny-footer" style="background-color: #15151e !important;">
        <div class="container">
                <h5 style="color:#fff;">Quick Contact</h5>
            <div class="row">


                  <div class="col-12 col-md-6 col-lg-6">
                        <div class="kilimanjaro_part">
                        
                            <div class="row">
                            <div class="col-md-6">
                                  <h5 style="color: #fff;">Phone:</h5>
                                <a href="tel:91-8605195919">+91-8605195919<br> +91-7083801183</a>
                            </div>

                            <div class="col-md-6">
                                <h5 style="color: #fff;">Email:</h5>
                                 <a href="mailto:brsuperlearners@gmail.com">brsuperlearners@gmail.com</a>
                            </div>
                               </div>
                        </div>
                      
                    </div>


                    <div class="col-md-6">
                        
                        <div class="col-md-6">
                            

                    <div class="logo-footer">
                        <ul>
                            @php
                                $logo = App\Setting::first();
                            @endphp
                            <li>
                               
                                    <a href="{{ url('/') }}" style="color:#fff;"><b>BR SUPER LEARNERS</b>
                                    </br>Institute Of Science,Katol
                            
                                    </a>
                               
                            </li>

                          
                        </ul>
                  

                </div>
                

                        </div>


                    </div>

           
               
            </div>
        </div>
    </div>
</footer>

@include('instructormodel')
