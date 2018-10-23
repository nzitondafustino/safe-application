<!-- Left side column. contains the logo and sidebar -->
<aside class="main-sidebar">

    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">

        <!-- Sidebar user panel (optional) -->
        @if (! Auth::guest())
            <div class="user-panel">
                <div class="pull-left image">
                    <img src="/img/avatar3.png" class="img-circle" alt="User Image" />
                </div>
                <div class="pull-left info">
                    <p>{{ Auth::user()->name }}</p>
                    <!-- Status -->
                    <!-- <a href="#"><i class="fa fa-circle text-success"></i> {{ trans('adminlte_lang::message.online') }}</a> -->
                </div>
            </div>
        @endif

        <!-- search form (Optional) -->
       <!--  <form action="#" method="get" class="sidebar-form">
            <div class="input-group">
                <input type="text" name="q" class="form-control" placeholder="{{ trans('adminlte_lang::message.search') }}..."/>
              <span class="input-group-btn">
                <button type='submit' name='search' id='search-btn' class="btn btn-flat"><i class="fa fa-search"></i></button>
              </span>
            </div>
        </form> -->
        <!-- /.search form -->

        <!-- Sidebar Menu -->
        <ul class="sidebar-menu">
            <!-- Optionally, you can add icons to the links -->
            <li><a href="{{ url('home') }}"><i class='fa fa-home'></i> <span>{{ trans('adminlte_lang::message.home') }}</span></a></li>
            <!-- <li><a href="#"><i class='fa fa-car'></i> <span>Vehicles</span></a></li>
            <li><a href="#"><i class='fa fa-id-card-o'></i> <span>Identification Card</span></a></li> -->
            @if(Auth::user()->hasAnyRole('user'))
            <li><a href="{{ url('report') }}"><i class='fa fa-list-ul'></i> <span>Report</span></a></li>
            @endif
            @if(Auth::user()->hasAnyRole('district-admin'))
            <li><a href="{{ url('district/report') }}"><i class='fa fa-list-ul'></i> <span>Report</span></a></li>
            @endif
            @if(Auth::user()->hasAnyRole('province-admin'))
            <li><a href="{{ url('province/report') }}"><i class='fa fa-list-ul'></i> <span>Report</span></a></li>
            @endif
            @if(Auth::user()->hasAnyRole('overall-admin'))
            <li><a href="{{ url('overall/report') }}"><i class='fa fa-list-ul'></i> <span>Report</span></a></li>
            @endif
            @if(Auth::user()->hasAnyRole('overall-admin'))
            <li><a href="{{ url('users') }}"><i class='fa fa-users'></i> <span>manage Users</span></a></li>
            <li><a href="{{ url('districts') }}"><i class='fa fa-area-chart'></i> <span>manage Districts</span></a></li>
            <li><a href="{{ url('sectors') }}"><i class='fa fa-area-chart'></i> <span>manage Sectors</span></a></li>
            <li><a href="{{ url('stations') }}"><i class='fa fa-area-chart'></i> <span>manage Stations</span></a></li>
            @endif
            <li><a href="{{ route('users.show',Auth::id()) }}"><i class='fa fa-user'></i> <span>My Profile</span></a></li>
            <!-- <li class="treeview">
                <a href="#"><i class='fa fa-link'></i> <span>{{ trans('adminlte_lang::message.multilevel') }}</span> <i class="fa fa-angle-left pull-right"></i></a>
                <ul class="treeview-menu">
                    <li><a href="#">{{ trans('adminlte_lang::message.linklevel2') }}</a></li>
                    <li><a href="#">{{ trans('adminlte_lang::message.linklevel2') }}</a></li>
                </ul>
            </li> -->
        </ul><!-- /.sidebar-menu -->
    </section>
    <!-- /.sidebar -->
</aside>
