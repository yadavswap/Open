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

          <li class="{{ Nav::isRoute('user.index') }} {{ Nav::isRoute('user.add') }} {{ Nav::isRoute('user.edit') }}"><a href="{{route('user.index')}}"><i class="fa fa-user-o" aria-hidden="true"></i><span>Students & Report</span></a></li>

          
       
           <li class="{{ Nav::isRoute('parent.index') }}"><a href="{{route('parent.index')}}"><i class="fa fa-user-circle-o" aria-hidden="true"></i><span>Parents</span></a></li>

            <li class="{{ Nav::isRoute('teacher.index') }}"><a href="{{route('teacher.index')}}"><i class="fa fa-graduation-cap" aria-hidden="true"></i><span>Teachers</span></a></li>




           <li class="{{ Nav::isRoute('assign.index') }}"><a href="{{route('assign.index')}}"><i class="fa fa-plus" aria-hidden="true"></i><span>Assign To Teacher</span></a></li>




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
                      <li class="{{ Nav::isResource('category') }}"><a href="{{url('category')}}"><i class="fa fa-circle-o"></i>{{ "Category"}}</a></li>
                      <li class="{{ Nav::isResource('subcategory') }}"><a href="{{url('subcategory')}}"><i class="fa fa-circle-o"></i>{{ "Subject" }}</a></li>
                      <li class="{{ Nav::isResource('childcategory') }}"><a href="{{url('childcategory')}}"><i class="fa fa-circle-o"></i>Units</a></li>
                    </ul>

                    <li class="{{ Nav::isResource('course') }}"><a href="{{url('course')}}"><i class="fa fa-book" aria-hidden="true"></i><span>{{ __('adminstaticword.Course') }}</span></a></li>

                    <li class="{{ Nav::isResource('courselang') }}"><a href="{{url('courselang')}}"><i class="fa fa-language" aria-hidden="true"></i><span>{{ __('adminstaticword.CourseLanguage') }}</span></a></li>

                    <li class="{{ Nav::isResource('coursereview') }}"><a href="{{url('coursereview')}}"><i class="fa fa-history" aria-hidden="true"></i><span>{{ __('adminstaticword.CourseReview') }}</span></a></li>
                </li>
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