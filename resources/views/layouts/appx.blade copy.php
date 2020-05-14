

<!DOCTYPE html>
<!--
This is a starter template page. Use this page to start your new project from
scratch. This page gets rid of all links and provides the needed markup only.
-->
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>DOBSystem</title>
  <meta name="csrf-token" content="{{ csrf_token() }}">


  <script>
        window.Laravel = {!! json_encode([
            'csrfToken' => csrf_token(),
            ]) !!};
 </script>
       @if(!auth()->guest())
            <script>
                window.Laravel.userId = {!!auth()->user()->id!!}
            </script>
        @endif


  <!-- Tell the browser to be responsive to screen width -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <link rel="stylesheet" href="{{asset('bower_components/bootstrap/dist/css/bootstrap.min.css')}}">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="{{asset('bower_components/font-awesome/css/font-awesome.min.css')}}">
  <!-- Ionicons -->
  <link rel="stylesheet" href="{{asset('bower_components/Ionicons/css/ionicons.min.css')}}">
  <!-- Theme style -->
  <link rel="stylesheet" href="{{asset('dist/css/AdminLTE.min.css')}}">

  <link rel="stylesheet" href="{{asset('plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.min.css  ')}}">



 <script type="text/javascript" src="{{asset('moment/moment.js')}}"></script>
 <script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
<script src="{{ asset('bower_components/jquery/dist/jquery-1.11.1.min.js')}}"></script>
<script src="//{{ Request::getHost() }}:6001/socket.io/socket.io.js"></script>

  <!-- AdminLTE Skins. We have chosen the skin-blue for this starter
        page. However, you can choose any other skin. Make sure you
        apply the skin class to the body tag so the changes take effect. -->
  <link rel="stylesheet" href="{{asset('dist/css/skins/skin-blue.min.css')}}">


  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">

  <link rel="stylesheet" href=" https://cdn.datatables.net/1.10.19/css/jquery.dataTables.min.css">

  <link rel="stylesheet" href="https://cdn.datatables.net/responsive/2.2.3/css/responsive.dataTables.min.css">


  <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
  <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
  <!--[if lt IE 9]>
  <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
  <![endif]-->

  <!-- Google Font -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">

  <link rel="stylesheet" href="{{ asset('Pace/pace.css')}}">
  <link rel="stylesheet" href="{{ asset('Pace/pace.css')}}">
  <style>
    .loading {
        background: lightgoldenrodyellow url('{{asset('images/loading.gif')}}') no-repeat center 65%;
        height: 80px;
        width: 100px;
        position: fixed;
        border-radius: 4px;
        left: 50%;
        top: 50%;
        margin: -40px 0 0 -50px;
        z-index: 2000;
        display: none;
    }
</style>
<style>

#dasboard :hover{

  background-color: red;
  color: aliceblue;
  font-size: large;
}

h3.box-title {
  font-size:1m;
  font-weight: 300;

  display: block;
  line-height:1em;

  color:  #3c8dbc;
}

/*******************************
* MODAL AS LEFT/RIGHT SIDEBAR
* Add "left" or "right" in modal parent div, after class="modal".
* Get free snippets on bootpen.com
*******************************/
.modal.left .modal-dialog,
	.modal.right .modal-dialog {
		position: fixed;
		margin: auto;
		width: 520px;
		height: 100%;
		-webkit-transform: translate3d(0%, 0, 0);
		    -ms-transform: translate3d(0%, 0, 0);
		     -o-transform: translate3d(0%, 0, 0);
		        transform: translate3d(0%, 0, 0);
	}

	.modal.left .modal-content,
	.modal.right .modal-content {
		height: 100%;
		overflow-y: auto;
	}

	.modal.left .modal-body,
	.modal.right .modal-body {
		padding: 15px 15px 80px;
	}

/*Left*/
	.modal.left.fade .modal-dialog{
		left: -320px;
		-webkit-transition: opacity 0.3s linear, left 0.3s ease-out;
		   -moz-transition: opacity 0.3s linear, left 0.3s ease-out;
		     -o-transition: opacity 0.3s linear, left 0.3s ease-out;
		        transition: opacity 0.3s linear, left 0.3s ease-out;
	}

	.modal.left.fade.in .modal-dialog{
		left: 0;
	}

/*Right*/
	.modal.right.fade .modal-dialog {
		right: -320px;
		-webkit-transition: opacity 0.3s linear, right 0.3s ease-out;
		   -moz-transition: opacity 0.3s linear, right 0.3s ease-out;
		     -o-transition: opacity 0.3s linear, right 0.3s ease-out;
		        transition: opacity 0.3s linear, right 0.3s ease-out;
	}

	.modal.right.fade.in .modal-dialog {
		right: 0;
	}

/* ----- MODAL STYLE ----- */
	.modal-content {
		border-radius: 0;
		border: none;
	}

	.modal-header {
		border-bottom-color: #EEEEEE;
		background-color: #FAFAFA;
	}

/* ----- v CAN BE DELETED v ----- */
body {
	background-color: #78909C;
}

.demo {
	padding-top: 60px;
	padding-bottom: 110px;
}

.btn-demo {
	margin: 15px;
	padding: 10px 15px;
	border-radius: 0;
	font-size: 16px;
	background-color: #FFFFFF;
}

.btn-demo:focus {
	outline: 0;
}

.demo-footer {
	position: fixed;
	bottom: 0;
	width: 100%;
	padding: 15px;
	background-color: #212121;
	text-align: center;
}

.demo-footer > a {
	text-decoration: none;
	font-weight: bold;
	font-size: 16px;
	color: #fff;
}






















:root {
  --mainColor: #ff9800;
}




#curlyStyle:hover {
  background-image: url("data:image/svg+xml;charset=utf8,%3Csvg id='squiggle-link' xmlns='http://www.w3.org/2000/svg' xmlns:xlink='http://www.w3.org/1999/xlink' xmlns:ev='http://www.w3.org/2001/xml-events' viewBox='0 0 20 4'%3E%3Cstyle type='text/css'%3E.squiggle{animation:shift .3s linear infinite;}@keyframes shift {from {transform:translateX(0);}to {transform:translateX(-20px);}}%3C/style%3E%3Cpath fill='none' stroke='%23ff9800' stroke-width='2' class='squiggle' d='M0,3.5 c 5,0,5,-3,10,-3 s 5,3,10,3 c 5,0,5,-3,10,-3 s 5,3,10,3'/%3E%3C/svg%3E");
  background-position: 0 100%;
  background-size: auto 6px;
  background-repeat: repeat-x;
  text-decoration: none;
   font-size: 20px;
}






























</style>







<style>
    div {
      font-family: sans-serif;
    }


    .loader {
        position: fixed;
        z-index: 99;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background: #ECF0F5;
        display: flex;
        justify-content: center;
        align-items: center;
    }

    .loader > img {
        width: 100px;
    }

    .loader.hidden {
        animation: fadeOut 1s;
        animation-fill-mode: forwards;
    }

    @keyframes fadeOut {
        100% {
            opacity: 0;
            visibility: hidden;
        }
    }


    </style>


    <script>

    window.addEventListener("load", function () {
        const loader = document.querySelector(".loader");
        loader.className += " hidden"; // class "loader hidden"
    });

    </script>


    <div class="loader">
            <img src="{{asset('/dist/img/loading.gif')}}"   alt="Loading...">     </div>















    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'DOBS') }}</title>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet" type="text/css">


      </head>
<!--
BODY TAG OPTIONS:
=================
Apply one or more of the following classes to get the
desired effect
|---------------------------------------------------------|
| SKINS         | skin-blue                               |
|               | skin-black                              |
|               | skin-purple                             |
|               | skin-yellow                             |
|               | skin-red                                |
|               | skin-green                              |
|---------------------------------------------------------|
|LAYOUT OPTIONS | fixed                                   |
|               | layout-boxed                            |
|               | layout-top-nav                          |
|               | sidebar-collapse                        |
|               | sidebar-mini                            |
|---------------------------------------------------------|
-->
<body class="hold-transition skin-blue sidebar-mini">
    <div class="wrapper">

  <!-- Main Header -->
  <header class="main-header">

    <!-- Logo -->
    <a href="#" class="logo">
      <!-- mini logo for sidebar mini 50x50 pixels -->
      <span class="logo-mini"><b>D</b>OBS</span>
      <!-- logo for regular state and mobile devices -->
      <span class="logo-lg"><b><small> DOB</small></b>System</span>
    </a>

    <!-- Header Navbar -->
    <nav class="navbar navbar-static-top" role="navigation">
      <!-- Sidebar toggle button-->
      <a href="#" class="sidebar-toggle" data-toggle="push-menu" role="button">
        <span class="sr-only">Toggle navigation</span>
      </a>






      <!-- Navbar Right Menu -->
      <div class="navbar-custom-menu">
        <ul class="nav navbar-nav">
          <!-- Messages: style can be found in dropdown.less-->
          <li class="dropdown messages-menu">
            <!-- Menu toggle button -->









           <div id="app" class="form-inline"><br>
           {{-- <a class="form-group  " href="#"> <updatecorpsenotify v-bind:updatecorpsenotification="updatecorpsenotification"></updatecorpsenotify></a>
             <span  class="form-group"><span style="color:#3C8DBC">..............</span> </span> --}}

            <a   class="form-group  " href="#"><newcorpse v-bind:corpsenotification="corpsenotification"></newcorpse> </a>

            <span href="#"  class="form-group"> <span style="color:#3C8DBC">...................................................................</span> </span>

            </div>
           <script src="{{ asset('js/app.js') }}" type="text/javascript"></script>






          </li>
          <!-- /.messages-menu -->


{{--
          <!-- Tasks Menu -->
          <li class="dropdown tasks-menu">
            <!-- Menu Toggle Button -->


             <a href="#" class="dropdown-toggle" data-toggle="dropdown">
              <i class="fa fa-flag-o"></i>
              <span class="label label-danger">2</span>
            </a> --}}



















{{-- @if (Auth::check())

        <!-- Notifications Menu -->
        <li class="dropdown notifications-menu">
            <!-- Menu toggle button -->
            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
              <i class="fa fa-bell-o"></i>
            <span class="label label-warning" id="count-notification">{{ auth()->user()->unreadNotifications->count()}}</span>
            </a>
            <ul class="dropdown-menu">
                @if (auth()->user()->unreadNotifications->count())
                    <li class="header">You have {{ auth()->user()->unreadNotifications->count()}} notifications</li>
                    <li>
                    <!-- Inner Menu: contains the notifications -->
                    <ul class="menu">
                        @foreach (auth()->user()->unreadNotifications as $notifications)
                            <li><!-- start notification -->
                            <a href="#">
                                <i class="fa fa-users text-aqua"></i> {{$notifications->data['newCorpse']['first_name'],['last_name']}}

                            </a>
                            </li>
                            <!-- end notification -->
                            @endforeach
                    </ul>
                    </li>
                    <li class="footer"><a href="#">View all</a></li>
                @else
                <li class="header">You have no notifications</li>
                @endif

            </ul>
          </li>

@endif --}}









            <ul class="dropdown-menu">
              <li class="header">You have 2 tasks</li>
              <li>
                <!-- Inner menu: contains the tasks -->
                <ul class="menu">
                  <li><!-- Task item -->
                    <a href="#">
                      <!-- Task title and progress text -->
                      <h3>
                      <p> Call Half Way Tree Police Station </p>
                      <p> to get Sgt Brown Computer Number..</p>
                        <small class="pull-right">SSP. Lewis</small>
                      </h3>

                      <hr>
                      <h3>
                          <p> Email SP Martin and ask him for </p>
                          <p> wife name and nationality..</p>
                            <small class="pull-right">SSP. Lewis</small>
                          </h3>
                      <!-- The progress bar -->

                    </a>
                  </li>
                  <!-- end task item -->
                </ul>
              </li>
              <li class="footer">
                <a href="#">View all tasks</a>
              </li>
            </ul>
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

                <p>
                    {{ isset(auth()->user()->firstName  )?auth()->user()->firstName  :'' }} - Current login user
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
  <!-- Left side column. contains the logo and sidebar -->
  <aside class="main-sidebar">



        @include('layouts/sidebar')


  </aside>


{{---------------------------------------------------}}
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">

           <div>
              @include('flash-message')
          </div>



   @yield('content')
  </div>
  <!-- /.content-wrapper -->


{{---------------------------------------------------}}



  <!-- Main Footer -->
  <footer class="main-footer" >

    <!-- To the right
    <div class="pull-right hidden-xs">
      Anything you want
    </div>-->

    <!-- Default to the left -->
    <strong>Copyright &copy; 2019 <a href="#">DOB System</a>.</strong> All rights reserved.

  </footer>

{{---------------------------------------------------}}




  <!-- Control Sidebar -->
  <aside class="control-sidebar control-sidebar-dark">
    <!-- Create the tabs -->
    <ul class="nav nav-tabs nav-justified control-sidebar-tabs">
      <li class="active"><a href="#control-sidebar-home-tab" data-toggle="tab"><i class="fa fa-home"></i></a></li>
      <li><a href="#control-sidebar-settings-tab" data-toggle="tab"><i class="fa fa-gears"></i></a></li>
    </ul>
    <!-- Tab panes -->
    <div class="tab-content">
      <!-- Home tab content -->
      <div class="tab-pane active" id="control-sidebar-home-tab">
        <h3 class="control-sidebar-heading">.</h3>
        <ul class="control-sidebar-menu">
          <li>
            <a href="javascript:;">


              <div class="menu-info">
                <h4 class="control-sidebar-subheading">..</h4>

                <p>.</p>
              </div>
            </a>
          </li>
        </ul>
        <!-- /.control-sidebar-menu -->

        <h3 class="control-sidebar-heading">.</h3>
        <ul class="control-sidebar-menu">
          <li>
            <a href="javascript:;">
              <h4 class="control-sidebar-subheading">
               .
                <span class="pull-right-container">

                  </span>
              </h4>


            </a>
          </li>
        </ul>
        <!-- /.control-sidebar-menu -->

      </div>
      <!-- /.tab-pane -->
      <!-- Stats tab content -->
      <div class="tab-pane" id="control-sidebar-stats-tab"> Content</div>
      <!-- /.tab-pane -->
      <!-- Settings tab content -->
      <div class="tab-pane" id="control-sidebar-settings-tab">
        <form method="post">
          <h3 class="control-sidebar-heading">General</h3>

          <div class="form-group">
            <label class="control-sidebar-subheading">


            </label>

            <p>
               information
            </p>
          </div>
          <!-- /.form-group -->
        </form>
      </div>
      <!-- /.tab-pane -->
    </div>
  </aside>
  <!-- /.control-sidebar -->
  <!-- Add the sidebar's background. This div must be placed
  immediately after the control sidebar -->
  <div class="control-sidebar-bg"></div>
</div>
<!-- ./wrapper -->

<!-- REQUIRED JS SCRIPTS -->


<script src="{{ asset('Pace/pace.js')}}"></script>

     <script src="/vendor/unisharp/laravel-ckeditor/ckeditor.js"></script>
     <script>
         CKEDITOR.replace( 'article-ckeditor' );
     </script>
</body>

<!-- AdminLTE App -->
<script src="{{ asset('dist/js/adminlte.min.js')}}"></script>

<script src="{{ asset('bower_components/jquery/dist/jquery.min.js')}}"></script>
<script src="{{ asset('bower_components/bootstrap/dist/js/bootstrap.min.js')}}"></script>
<script src="{{ asset('bower_components/jquery-slimscroll/jquery.slimscroll.min.js')}}"></script>
<script src="{{ asset('bower_components/datatables.net/js/jquery.dataTables.min.js')}}"></script>
<script src="{{ asset('bower_components/datatables.net-bs/js/dataTables.bootstrap.min.js')}}"></script>



</html>





<div class="container demo">


    <!-- Modal -->
    <div class="modal left fade" id="modalQuickSearch" tabindex="-1" role="dialog" aria-labelledby="modalQuickSearchLabel">
      <div class="modal-dialog" role="document">
        <div class="modal-content">

          <div  style="background-color:#3c8dbc; color:antiquewhite"  class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            <h4  class="modal-title" id="modalQuickSearchLabel">Quick Search Result</h4>
          </div>

          <div class="modal-body">

             <p>
                   <div id="searchXX"  >
                   </div>

             </p>
          </div>
          <footer  style="background-color:#3c8dbc;" class="demo-footer">
             <button type="button" class="btn  btn-danger btn-lg btn-block" data-dismiss="modal" >Close</button>

               </footer>

        </div><!-- modal-content -->
      </div><!-- modal-dialog -->
    </div><!-- modal -->

  </div><!-- container -->


  {{-- <script src="{{ url (mix('/js/app.js')) }}" type="text/javascript"></script> --}}


