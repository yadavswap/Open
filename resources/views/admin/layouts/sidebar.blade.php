<aside class="main-sidebar">
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">
      <!-- Sidebar user panel -->
      <div class="user-panel">
        <div class="pull-left image">
          @if(Auth::User()->user_img != null || Auth::User()->user_img !='')
          <img src="{{ asset('images/user_img/'.Auth::User()->user_img)}}" class="img-circle" alt="User Image">

          @else
          <img src="{{ asset('images/default/user.jpg') }}" class="img-circle" alt="User Image">

          @endif
        </div>
        <div class="pull-left info">
          <p>{{ Auth::User()->fname }}</p>
          <a href="#"><i class="fa fa-circle text-success"></i> {{ __('adminstaticword.Online') }}</a>
        </div>
      </div>

      @if(Auth::User()->role == "admin")
        <ul class="sidebar-menu" data-widget="tree">
          <li class="header">{{ __('adminstaticword.Navigation') }}</li>
        
          <li class="{{ Nav::isRoute('admin.index') }}"><a href="{{route('admin.index')}}"><i class="fa fa-tachometer" aria-hidden="true"></i><span>{{ __('adminstaticword.Dashboard') }}</span></a></li>

          <li class="{{ Nav::isRoute('user.index') }} {{ Nav::isRoute('user.add') }} {{ Nav::isRoute('user.edit') }}"><a href="{{route('user.index')}}"><i class="fa fa-user-o" aria-hidden="true"></i><span>{{ __('adminstaticword.User') }}</span></a></li>

           <li class="{{ Nav::isRoute('assign.index') }}"><a href="{{route('assign.index')}}"><i class="fa fa-plus" aria-hidden="true"></i><span>Assign To Teacher</span></a></li>



          @if(isset($zoom_enable) && $zoom_enable == 1)
          <li class="{{ Nav::isRoute('meeting.create') }} {{ Nav::isRoute('zoom.show') }} {{ Nav::isRoute('zoom.edit') }} {{ Nav::isRoute('zoom.setting') }} {{ Nav::isRoute('zoom.index') }}  treeview">
            <a href="#">
             <i class="fa fa-grav" aria-hidden="true"></i> <span>{{ __('Zoom Live Meetings') }}</span>
              <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
              </span>
            </a>
            <ul class="treeview-menu">
              <li class="{{ Nav::isRoute('zoom.setting') }}"><a href="{{route('zoom.setting')}}"><i class="fa fa-circle-o"></i>{{ __('Zoom Settings') }}</a></li>
              <li class="{{ Nav::isRoute('zoom.index') }} {{ Nav::isRoute('zoom.show') }} {{ Nav::isRoute('zoom.edit') }} {{ Nav::isRoute('meeting.create') }}"><a href="{{route('zoom.index')}}"><i class="fa fa-circle-o"></i>{{ __('Zoom Dashboard') }}</a></li>
              <li class="{{ Nav::isRoute('meeting.show') }}"><a href="{{route('meeting.show')}}"><i class="fa fa-circle-o"></i>{{ __('adminstaticword.AllMeetings') }}</a></li>
            </ul>
          </li>
       @endif

          <li class="{{ Nav::isResource('admin/country') }} {{ Nav::isResource('admin/state') }} {{ Nav::isResource('admin/city') }} treeview">
            <a href="#">
              <i class="fa fa-globe" aria-hidden="true"></i> <span>{{ __('adminstaticword.Location') }}</span>
              <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
              </span>
            </a>
            <ul class="treeview-menu">
             
              <li class="{{ Nav::isResource('admin/state') }}"><a href="{{url('admin/state')}}"><i class="fa fa-circle-o"></i>{{ __('adminstaticword.State') }}</a></li>
              <li class="{{ Nav::isResource('admin/city') }}"><a href="{{url('admin/city')}}"><i class="fa fa-circle-o"></i>{{ __('adminstaticword.City') }}</a></li>
            </ul>
          </li>

          <li class="treeview">
           <a href="#">
             <i class="fa fa-user-plus" aria-hidden="true"></i> <span>{{"Attendance"}}</span>
              <span class="pull-right-container">
                <i class="fa fa-angle-left pull-right"></i>
              </span>
            </a>
            <ul class="treeview-menu">
              <li class="{{ Nav::isRoute('all.instructor') }}"><a href="{{route('students.attendance.index')}}"><i class="fa fa-circle-o"></i>{{"Student Attendance"}}</a></li>
              <li class="{{ Nav::isResource('requestinstructor') }}"><a href="{{url('requestinstructor')}}"><i class="fa fa-circle-o"></i>{{"Teacher Attendance"}}</a></li>
            </ul>
          </li>

          <li class="treeview">
           <a href="#">
             <i class="fa fa-pie-chart" aria-hidden="true"></i> <span>{{"Reports"}}</span>
              <span class="pull-right-container">
                <i class="fa fa-angle-left pull-right"></i>
              </span>
            </a>
            <ul class="treeview-menu">
              <li class="{{ Nav::isRoute('all.instructor') }}"><a href="{{route('all.instructor')}}"><i class="fa fa-circle-o"></i>{{"Exam Report"}}</a></li>
            </ul>
          </li>
         

          <li class="{{ Nav::isResource('category') }} {{ Nav::isResource('subcategory') }} {{ Nav::isResource('childcategory') }} {{ Nav::isResource('course') }} {{ Nav::isResource('courselang') }} treeview">
            <a href="#">
                <i class="fa fa-book"></i>{{ __('adminstaticword.Course') }}
                <i class="fa fa-angle-left pull-right"></i>
            </a>                            

            <ul class="treeview-menu">
                <li class="{{ Nav::isResource('category') }} {{ Nav::isResource('subcategory') }} {{ Nav::isResource('childcategory') }} {{ Nav::isResource('course') }} {{ Nav::isResource('courselang') }} {{ Nav::isResource('coursereview') }} treeview">
                    <a href="#"><i class="fa fa-star" aria-hidden="true"></i>{{ "Classes & Subjects" }}<i class="fa fa-angle-left pull-right"></i></a>
                    
                    <ul class="treeview-menu">
                      <li class="{{ Nav::isResource('category') }}"><a href="{{url('category')}}"><i class="fa fa-circle-o"></i>{{ "Class"}}</a></li>
                      <li class="{{ Nav::isResource('subcategory') }}"><a href="{{url('subcategory')}}"><i class="fa fa-circle-o"></i>{{ "Subject" }}</a></li>
                      <li class="{{ Nav::isResource('childcategory') }}"><a href="{{url('childcategory')}}"><i class="fa fa-circle-o"></i>{{ "Category" }}</a></li>
                    </ul>

                    <li class="{{ Nav::isResource('course') }}"><a href="{{url('course')}}"><i class="fa fa-book" aria-hidden="true"></i><span>{{ __('adminstaticword.Course') }}</span></a></li>

                    <li class="{{ Nav::isResource('courselang') }}"><a href="{{url('courselang')}}"><i class="fa fa-language" aria-hidden="true"></i><span>{{ __('adminstaticword.CourseLanguage') }}</span></a></li>

                    <li class="{{ Nav::isResource('coursereview') }}"><a href="{{url('coursereview')}}"><i class="fa fa-history" aria-hidden="true"></i><span>{{ __('adminstaticword.CourseReview') }}</span></a></li>
                </li>
            </ul>
          </li>

         
          <li class="{{ Nav::isRoute('all.instructor') }} {{ Nav::isResource('requestinstructor') }} treeview">
           <a href="#">
             <i class="fa fa-user-plus" aria-hidden="true"></i> <span>{{"Teacher"}}</span>
              <span class="pull-right-container">
                <i class="fa fa-angle-left pull-right"></i>
              </span>
            </a>
            <ul class="treeview-menu">
              <li class="{{ Nav::isRoute('all.instructor') }}"><a href="{{route('all.instructor')}}"><i class="fa fa-circle-o"></i>{{ __("All Teacher") }}</a></li>
              <li class="{{ Nav::isResource('requestinstructor') }}"><a href="{{url('requestinstructor')}}"><i class="fa fa-circle-o"></i>{{ __('adminstaticword.InstructorRequest') }}</a></li>
            </ul>
          </li>

          
          

         
    
        

       

       
          
     

          <li class="{{ Nav::isRoute('player.set') }} {{ Nav::isResource('ads') }} {{ Nav::isResource('ad.setting') }} treeview">
           <a href="#">
             <i class="fa fa-cogs" aria-hidden="true"></i> <span>{{ __('adminstaticword.PlayerSettings') }}</span>
              <span class="pull-right-container">
                <i class="fa fa-angle-left pull-right"></i>
              </span>
            </a>
            <ul class="treeview-menu">

              <li class="{{ Nav::isRoute('player.set') }}"><a href="{{route('player.set')}}"><i class="fa fa-circle-o"></i> {{ __('adminstaticword.PlayerCustomization') }}</a></li>

              
              @php $ads = App\Ads::all(); @endphp
             
            </ul>
          </li>

          <li class="{{ Nav::isRoute('show.lang') }}"><a href="{{route('show.lang')}}"><i class="fa fa-language" aria-hidden="true"></i><span>{{ __('adminstaticword.Language') }}</span></a></li>

        
          

        </ul>
      @endif


    </section>
    <!-- /.sidebar -->
</aside>