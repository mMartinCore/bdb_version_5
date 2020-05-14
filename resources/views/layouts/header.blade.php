  <!-- Main Header -->
  <header class="main-header">

    <!-- Logo -->
    <a href="#" class="logo">
      <!-- mini logo for sidebar mini 50x50 pixels -->
      <span class="logo-mini"><b>D</b>BDS</span>
      <!-- logo for regular state and mobile devices -->
      <span class="logo-lg"><b><small> DBD</small></b>System</span>
    </a>

    <!-- Header Navbar -->
    <nav class="navbar navbar-static-top" role="navigation">
      <!-- Sidebar toggle button-->
      <a href="#" class="sidebar-toggle" data-toggle="push-menu" role="button">
        <span class="sr-only">Toggle navigation</span>
      </a>
      <div class="navbar-custom-menu">
        <ul class="nav navbar-nav"> 
          <li class="dropdown messages-menu"> 
           <div id="app" class="form-inline"><br> 
            <a   class="form-group  " href="#"><newcorpse v-bind:corpsenotification="corpsenotification"></newcorpse> </a>
            <span href="#"  class="form-group"> <span style="color:#3C8DBC">........................................................................................................</span> </span>
            </div>
           <script src="{{ mix('js/app.js') }}" type="text/javascript"></script>
          </li> 
            </li>
          <!-- User Account Menu -->
          <li class="dropdown user user-menu">
            <!-- Menu Toggle Button -->
            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
              <!-- The user image in the navbar-->
              <img src="{{asset('/dist/img/jcflogo.png')}}" class="user-image" alt="User Image">
              <!-- hidden-xs hides the username on small devices so only the image appears. -->
            <span class="hidden-xs">         {{ isset(auth()->user()->firstName  )?auth()->user()->firstName  :''}}</span>
            </a>
            <ul class="dropdown-menu">
              <!-- The user image in the menu -->
              <li class="user-header">
                <img src="{{asset('/dist/img/jcflogo.png')}}" class="img-circle" alt="User Image">
                <p> {{ isset(auth()->user()->firstName  )?auth()->user()->firstName  :'' }} - Current login user
                  <small>Please be responsible...</small>
                </p>
              </li>
              <!-- Menu Body -->
              <li class="user-body">
                <div class="row">
                  <div class="col-xs-4 text-center">
                    <a href="#">.</a>
                  </div>
                  <div class="col-xs-4 text-center">
                    <a href="#">.</a>
                  </div>
                  <div class="col-xs-4 text-center">
                    <a href="#">.</a>
                  </div>
                </div>
                <!-- /.row -->
              </li>
              <!-- Menu Footer-->
              <li class="user-footer">
                <div class="pull-left">
                  <a href="#" class="btn btn-default btn-flat">Profile</a>
                </div>
                <div class="pull-right">
                  <a   href="{{ route('logout') }}" class="btn btn-default btn-flat"   onclick="event.preventDefault();
                  document.getElementById('logout-form').submit();"
                  > {{ __('Logout') }}</a>
                  <form id="logout-form"  action="{{ route('logout') }}" method="POST" style="display: none;">
                      @csrf
                  </form>
                </div>
              </li>
            </ul>
          </li>
          <!-- Control Sidebar Toggle Button -->
          <li>
           <!-- <a href="#" data-toggle="control-sidebar"><i class="fa fa-gears"></i></a>  i hide the gear and comment it-->
           <a href="#" data-toggle=" "><i class="fa  "></i></a>
          </li>
        </ul>
      </div>
    </nav>
  </header>