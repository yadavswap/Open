<section id="nav-bar" class="nav-bar-main-block">
    <div class="container">
        <div class="row">
            <div class="col-lg-6">
                <div class="row">
                    <div class="col-lg-2 col-md-2 col-sm-12">
                        <div class="logo">
                            @php
                                $setting = App\Setting::first();
                            @endphp

                            @if($setting->logo_type == 'L')
                                <a href="{{ url('/') }}" ><img src="{{ asset('images/logo/'.$setting->logo) }}" class="img-fluid" alt="logo"></a>
                            @else()
                                <a href="{{ url('/') }}"><b><div class="logotext">{{ str_limit($setting->project_title, $limit=6, $end="") }}</div></b></a>
                            @endif
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-3 col-sm-12">
                        <div class="navigation">
                            <div id="cssmenu">
                                <ul>
                                    <li><a href="#" title="Categories"><i class="flaticon-grid"></i>{{ __('frontstaticword.Categories') }}</a>
                                        @php
                                         $categories = App\Categories::orderBy('position','ASC')->get();
                                        @endphp
                                        <ul>
                                            @foreach($categories as $cate)
                                            @if($cate->status == 1 )
                                            <li><a href="{{ route('category.page',$cate->id) }}" title="{{ $cate->title }}"><i class="fa {{ $cate->icon }} rgt-20"></i>{{ $cate->title }}<i class="fa fa-chevron-right float-rgt"></i></a>
                                            <ul>   
                                                @foreach($cate->subcategory as $sub)
                                                @if($sub->status ==1)
                                                <li><a href="{{ route('subcategory.page',$sub->id) }}" title="{{ $sub->title }}"><i class="fa {{ $sub->icon }} rgt-20"></i>{{ $sub->title }}
                                                    <i class="fa fa-chevron-right float-rgt"></i></a>
                                                    <ul>
                                                        @foreach($sub->childcategory as $child)
                                                        @if($child->status ==1)
                                                        <li>
                                                            <a href="{{ route('childcategory.page',$child->id) }}" title="{{ $child->title }}"><i class="fa {{ $child->icon }} rgt-20"></i>{{ $child->title }}</a>
                                                        </li>
                                                        @endif
                                                        @endforeach
                                                    </ul>
                                                </li>
                                                @endif
                                               @endforeach
                                            </ul>
                                            </li>
                                            @endif
                                            @endforeach
                                        </ul>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-7 col-md-7 col-sm-12">
                        <div class="nav-search">
                            <form action="{{ route('search') }}" class="form-inline search-form" method="GET">
                                <div class="form-group">
                                    <input type="text" class="form-control" id="search" name="searchTerm" placeholder="{{ __('frontstaticword.Searchforcourses') }}" value="{{ isset($searchTerm) ? $searchTerm : '' }}">
                                </div>              
                                <button type="submit" class="btn btn-primary"><i class="fas fa-search"></i></button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-6">
               

                @auth
                <div class="row">
                    <div class="col-lg-3 col-md-3 col-6">
                        <div class="learning-business learning-business-two">
                            @if(Auth::User()->role == "user")
                                @if($setting->instructor_enable == 1)
                                    <a href="#" class="btn btn-link" data-toggle="modal" data-target="#myModalinstructor" title="Become An Instructor">{{ __('frontstaticword.BecomeAnInstructor') }}</a>
                                @endif
                            @endif
                        </div>
                    </div>
                    <div class="hidemobile-sm">
                    <div class="col-lg-2 col-md-2 hidden-md">
                        <div class="learning-business">
                            <a href="{{ route('mycourse.show') }}" class="btn btn-link" title="My Course">{{ __('frontstaticword.MyCourses') }}</a>
                        </div>
                        </div>
                    </div>
                    <div class="col-lg-1 col-md-1 col-sm-2 col-2 hidemobile-sm">
                        <div class="nav-wishlist">
                            <ul id="nav">
                                <li id="notification_li">
                                    <a href="{{ url('send') }}" id="notificationLink" title="Notification"><i class="fa fa-bell"></i></a>
                                    <span class="red-menu-badge red-bg-success">
                                        {{ Auth()->user()->unreadNotifications->count() }}
                                    </span>
                                    <div id="notificationContainer">
                                    <div id="notificationTitle">{{ __('frontstaticword.Notifications') }}</div>
                                    <div id="notificationsBody" class="notifications">
                                        <ul>
                                            @foreach(Auth()->user()->unreadNotifications as $notification)
                                                <li class="unread-notification">
                                                    <a href="{{url('notifications/'.$notification->id)}}">          
                                                    <div class="notification-image">
                                                        @if($notification->data['image'] !== NULL )
                                                            <img src="{{ asset('images/course/'.$notification->data['image']) }}" alt="course" class="img-fluid" >
                                                        @else
                                                            <img src="{{ Avatar::create($notification->data['id'])->toBase64() }}" alt="course" class="img-fluid">
                                                        @endif
                                                    </div>
                                                    <div class="notification-data">
                                                        In {{ str_limit($notification->data['id'], $limit = 20, $end = '...') }}
                                                        <br>
                                                        {{ str_limit($notification->data['data'], $limit = 20, $end = '...') }}
                                                    </div>
                                                    </a>
                                                </li>
                                            @endforeach

                                            @foreach(Auth()->user()->readNotifications as $notification)
                                                <li>
                                                    <a href="{{ route('mycourse.show') }}">
                                                    <div class="notification-image">
                                                        @if($notification->data['image'] !== NULL )
                                                            <img src="{{ asset('images/course/'.$notification->data['image']) }}" alt="course" class="img-fluid" >
                                                        @else
                                                           <img src="{{ Avatar::create($notification->data['id'])->toBase64() }}" alt="course" class="img-fluid">
                                                        @endif
                                                    </div>
                                                    <div class="notification-data">
                                                        In {{  str_limit($notification->data['id'], $limit = 20, $end = '...') }}
                                                        <br>
                                                        {{ str_limit($notification->data['data'], $limit = 20, $end = '...') }}
                                                    </div>
                                                    </a>
                                                </li>
                                            @endforeach
                                        </ul>
                                    </div>
                                    <div id="notificationFooter"><a href="{{route('deleteNotification')}}">{{ __('frontstaticword.ClearAll') }}</a></div>
                                    </div>
                                </li>
                            </ul>
                        </div>
                    </div>
                   
                    <div class="col-lg-4 col-md-3 col-sm-6 col-6 hidemobile-sm">
                        <div class="my-container">
                          <div class="dropdown">
                            <button class="btn btn-default dropdown-toggle  my-dropdown" type="button" id="dropdownMenu1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
                                @if(Auth::User()->user_img != null || Auth::User()->user_img !='')
                                  <img src="{{ url('/images/user_img/'.Auth::User()->user_img) }}" class="circle" alt="user">
                                @else
                                    <img src="{{ asset('images/default/user.jpg')}}"  class="circle" alt="user">
                                @endif
                                <span class="dropdown__item name" id="name">{{ str_limit(Auth::User()->fname, $limit = 10, $end = '..') }}</span>
                                <span class="dropdown__item caret"></span>
                            </button>
                            <ul class="dropdown-menu dropdown-menu-right User-Dropdown U-open" aria-labelledby="dropdownMenu1">
                                <div id="notificationTitle">
                                    @if(Auth::User()->user_img != null || Auth::User()->user_img !='')
                                      <img src="{{ url('/images/user_img/'.Auth::User()->user_img) }}" class="dropdown-user-circle" alt="user">
                                    @else
                                        <img src="{{ asset('images/default/user.jpg')}}" class="dropdown-user-circle" alt="user">
                                    @endif
                                    <div class="user-detailss">
                                        {{ Auth::User()->fname }}
                                        <br>
                                        {{ Auth::User()->email }}
                                    </div>
                                    
                                </div>
                                @if(Auth::User()->role == "admin" || Auth::User()->role == "instructor"  )
                                <a target="_blank" href="{{ url('/admins') }}"><li><i class="fa fa-dashboard"></i>{{ __('frontstaticword.AdminDashboard') }}</li></a>
                                @endif
                               
                            
                                <a href="{{route('dashboard')}}"><li ><i class="fa fa-user"></i>{{ "User Dashboard"}}</li></a>
                                @if(Auth::User()->role == "user")
                               
                        
                                @endif

                                <a href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                    <div id="notificationFooter">
                                        {{ __('frontstaticword.Logout') }}
                                        
                                        <form id="logout-form" action="{{ route('logout') }}" method="POST" class="display-none">
                                            @csrf
                                        </form>
                                    </div>
                                </a>
                            </ul>
                          </div>
                        </div>
                    </div>
                </div>
                @endauth
            </div>
        </div>
    </div>
</section>

@include('instructormodel')
