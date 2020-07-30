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
          <a href="#"><i class="fa fa-circle text-success"></i> {{ __('adminstaticword.Instructor') }}</a>
        </div>
      </div>
 

      @if(Auth::User()->role == "instructor")
        <ul class="sidebar-menu" data-widget="tree">
          <li class="header">{{ __('adminstaticword.Navigation') }} </li>

          <li class="{{ Nav::isRoute('instructor.index') }}"><a href="{{route('instructor.index')}}"><i class="fa fa-tachometer" aria-hidden="true"></i><span>{{ __('adminstaticword.Dashboard') }}</span></a></li>
          
          <li class="{{ Nav::isResource('category') }} {{ Nav::isResource('subcategory') }} {{ Nav::isResource('childcategory') }} {{ Nav::isResource('course') }} {{ Nav::isResource('courselang') }} treeview">
            <a href="#">
                <i class="fa fa-folder"></i>{{ __('adminstaticword.Course') }}
                <i class="fa fa-angle-left pull-right"></i>
            </a>

            <ul class="treeview-menu">
              <li class="{{ Nav::isResource('category') }} {{ Nav::isResource('subcategory') }} {{ Nav::isResource('childcategory') }} {{ Nav::isResource('course') }} {{ Nav::isResource('courselang') }} treeview">
                 
                  @if($gsetting->cat_enable == 1)
                  <a href="#"><i class="fa fa-star" aria-hidden="true"></i>{{ __('adminstaticword.Category') }}<i class="fa fa-angle-left pull-right"></i></a>
                  
                  <ul class="treeview-menu">
                    <li class="{{ Nav::isResource('category') }}"><a href="{{url('category')}}"><i class="fa fa-circle-o"></i>{{ __('adminstaticword.Category') }}</a></li>
                    <li class="{{ Nav::isResource('subcategory') }}"><a href="{{url('subcategory')}}"><i class="fa fa-circle-o"></i>{{ __('adminstaticword.SubCategory') }}</a></li>
                    <li class="{{ Nav::isResource('childcategory') }}"><a href="{{url('childcategory')}}"><i class="fa fa-circle-o"></i>{{ __('adminstaticword.ChildCategory') }}</a></li>
                  </ul>
                  @endif                           

                
                  <li class="{{ Nav::isResource('course') }}"><a href="{{url('course')}}"><i class="fa fa-book" aria-hidden="true"></i><span>{{ __('adminstaticword.Course') }}</span></a></li>

                  <li class="{{ Nav::isResource('courselang') }}"><a href="{{url('courselang')}}"> <i class="fa fa-language" aria-hidden="true"></i></i><span> {{ __('adminstaticword.Course') }} {{ __('adminstaticword.Language') }}</span></a></li>
                 
                </li>
              </ul>
          </li>



        



          <li class="{{ Nav::isRoute('user.index') }} {{ Nav::isRoute('user.add') }} {{ Nav::isRoute('user.edit') }}"><a href="{{route('user.index')}}"><i class="fa fa-user-o" aria-hidden="true"></i><span>Students & Reports</span></a></li>


          <li class="{{ Nav::isResource('userenroll') }}"><a href="{{url('userenroll')}}"><i class="fa fa-user" aria-hidden="true"></i><span>Enrolled Students List</span></a></li>


            <li class="{{ Nav::isResource('category') }} {{ Nav::isResource('subcategory') }} {{ Nav::isResource('childcategory') }} {{ Nav::isResource('course') }} {{ Nav::isResource('courselang') }} treeview">
            <a href="#">
                <i class="fa fa-pie-chart"></i>Reports
                <i class="fa fa-angle-left pull-right"></i>
            </a>

            <ul class="treeview-menu">
              <li class="{{ Nav::isResource('reports') }} treeview">
                 
                
                
                                       

                
                  <li class="{{ Nav::isResource('examreport') }}"><a href="{{url('course')}}"><i class="fa fa-book" aria-hidden="true"></i><span>Exam Report</span></a></li>

                  <li class="{{ Nav::isResource('courselang') }}"><a href="{{url('courselang')}}"> <i class="fa fa-language" aria-hidden="true"></i></i><span> {{ __('adminstaticword.Course') }} {{ __('adminstaticword.Language') }}</span></a></li>
                 
                </li>
              </ul>
          </li>


          <li class="{{ Nav::isResource('instructorquestion') }} {{ Nav::isResource('instructoranswer') }} treeview">
            <a href="#">
                <i class="fa fa-question"></i> {{ __('adminstaticword.Question') }} / {{ __('adminstaticword.Answer') }}
                <i class="fa fa-angle-left pull-right"></i>
            </a>                            

            <ul class="treeview-menu">
              <li class="{{ Nav::isResource('instructorquestion') }}"><a href="{{url('instructorquestion')}}"><i class="fa fa-circle-o" aria-hidden="true"></i><span>{{ __('adminstaticword.Question') }}</span></a></li>

              <li class="{{ Nav::isResource('instructoranswer') }}"><a href="{{url('instructoranswer')}}"><i class="fa fa-circle-o" aria-hidden="true"></i><span>{{ __('adminstaticword.Answer') }}</span></a></li>
            </ul>
          </li>

          <li class="{{ Nav::isResource('instructor/announcement') }}"><a href="{{url('instructor/announcement')}}"><i class="fa fa-compass" aria-hidden="true"></i><span>{{ __('adminstaticword.Announcement') }}</span></a></li>

        
          
          @if(isset($gsetting->feature_amount))
          <li class="{{ Nav::isResource('featurecourse') }}"><a href="{{url('featurecourse')}}"><i class="fa fa-book" aria-hidden="true"></i><span> {{ __('adminstaticword.Feature') }} {{ __('adminstaticword.Course') }}</span></a></li>
          @endif

          @if(isset($zoom_enable) && $zoom_enable == 1)
          <li class="{{ Nav::isRoute('meeting.create') }} {{ Nav::isRoute('zoom.show') }} {{ Nav::isRoute('zoom.edit') }} {{ Nav::isRoute('zoom.setting') }} {{ Nav::isRoute('zoom.index') }}  treeview">
            <a href="" onclick="alert('Feature Not Available!');">
             <i class="fa fa-grav" aria-hidden="true"></i> <span>{{ __('Zoom Live Meetings') }}</span>
              <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
              </span>
            </a>
            <ul class="treeview-menu">
              <li class="{{ Nav::isRoute('zoom.setting') }}"><a href=""><i class="fa fa-circle-o"></i>{{ __('Zoom Settings') }}</a></li>
              <li class="{{ Nav::isRoute('zoom.index') }} {{ Nav::isRoute('zoom.show') }} {{ Nav::isRoute('zoom.edit') }} {{ Nav::isRoute('meeting.create') }}"><a href=""><i class="fa fa-circle-o"></i>{{ __('Zoom Dashboard') }}</a></li>
            </ul>
          </li>
       @endif


      

         
          
          

          <li class="{{ Nav::isResource('usermessage') }}"><a href="{{url('usermessage')}}"><i class="fa fa-phone" aria-hidden="true"></i><span>{{ __('adminstaticword.ContactUs') }}</span></a></li>
          

        <ul>
      @endif


    </section>
    <!-- /.sidebar -->
</aside>