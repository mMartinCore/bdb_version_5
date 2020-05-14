

<!DOCTYPE html>
<!--
This is a starter template page. Use this page to start your new project from
scratch. This page gets rid of all links and provides the needed markup only.
-->
<html>
<head> 
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
 
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
<link rel="stylesheet" href="{{asset('dist/css/skins/skin-blue.min.css')}}">
  <!-- Google Font -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">

  <link rel="stylesheet" href="{{ asset('Pace/pace.css')}}">
  {{-- <link rel="stylesheet" href="{{ asset('Pace/pace.css')}}"> --}}
  <style>
    /* .loading {
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
    } */
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
        opacity: 7;
        display: flex;
        justify-content: center;
        align-items: center;
    }

    .loader > img {
        width: 100px;
    }

    .loader.hidden {
        animation: fadeOut 0s;
        animation-fill-mode: forwards;
    }

    @keyframes fadeOut {
        100% {
            opacity: 0;
            visibility: hidden;
        }
    }


    @media only screen and (orientation: landscape) {
      body {
        background-color: lightblue;
      }
    }
    </style>


    <script>

    // window.addEventListener("load", function () {
    //     const loader = document.querySelector(".loader");
    //     loader.className += " hidden"; // class "loader hidden"
    // });

    </script>

{{--
    <div class="loader">
            <img src="{{asset('/dist/img/loading.gif')}}"   alt="Loading...">
          </div> --}}

 
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'DBDS') }}</title>

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
  <script language="javascript">

    if ( $(window).width() >= 1280 && $(window).width() <= 1536) {

        document.write("<style>body{zoom:88%;}</style>");
    }
   else if ( $(window).width()>= 1180   && $(window).width() < 1280) {
       document.write("<style>body{zoom:75%;}</style>");
   }
   else if ( $(window).width()>=750  && $(window).width() < 1080 ) {
       document.write("<style>body{zoom:68%;}</style>");
   }
   else if ( $(window).width() <= 750 ) {
       document.write("<style>body{zoom:50%;}</style>");
   }else{
     
      }
</script>














    <div class="wrapper">

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

            <span href="#"  class="form-group"> <span style="color:#3C8DBC">........................................................................................................</span> </span>

            </div>
           <script src="{{ asset('js/app.js') }}" type="text/javascript"></script>






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










  <div class="content-wrapper ">

           <div>

              @include('flash-message')
          </div>




   @yield('content')

  </div>
  <!-- /.content-wrapper -->


{{---------------------------------------------------}}










    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <script>

         $(document).ready(function() {

            function loadContent(hash){

            if (hash===''){
                hash='/';
            }
            $('#loadhere').load(hash);
            }


            $(window).on('hashchange', function() {
                loadContent(location.hash.slice(1));
            });

            var url = window.location.href;
            var hash = url.substring(url.indexOf("#")+1);
            if (hash===url){
                 hash='/';
            }
            $('#loadhere').load(hash);
                    });
    </script>




  <!-- Main Footer -->
  <footer class="main-footer" >  
    <strong>Copyright &copy; <?php echo date('Y') ?> <a href="#">DBD System</a>.</strong> All rights reserved.
  </footer>
 

 
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
          @livewireScripts
</body>




<!-- AdminLTE App -->
<script src="{{ asset('dist/js/adminlte.min.js')}}"></script>

<script src="{{ asset('bower_components/jquery/dist/jquery.min.js')}}"></script>
<script src="{{ asset('bower_components/bootstrap/dist/js/bootstrap.min.js')}}"></script>
<script src="{{ asset('bower_components/jquery-slimscroll/jquery.slimscroll.min.js')}}"></script>
<script src="{{ asset('bower_components/datatables.net/js/jquery.dataTables.min.js')}}"></script>
<script src="{{ asset('bower_components/datatables.net-bs/js/dataTables.bootstrap.min.js')}}"></script>

@include('layouts.recentActivities')




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




  <script>





function getViewId(id) {
  var url =window.location.protocol+"//"+window.location.hostname+"/corpses/"+id;
$("#load_show_view").load(url, function(responseTxt, statusTxt, xhr){
if(statusTxt == "success")
{
    document.getElementById('demo02').click(); // Works!
    return false;
}
if(statusTxt == "error"){
Command: toastr["error"]("Inconceivable!","Error: " + xhr.status + ": " + xhr.statusText)

toastr.options = {
"closeButton": true,
"debug": false,
"newestOnTop": false,
"progressBar": true,
"positionClass": "toast-top-center",
"preventDuplicates": false,
"onclick": null,
"showDuration": "900",
"hideDuration": "1000",
"timeOut": "5000",
"extendedTimeOut": "1000",
"showEasing": "swing",
"hideEasing": "linear",
"showMethod": "fadeIn",
"hideMethod": "fadeOut"
}

}
return false;

});
}



function getViewId_view_Notify(id) {
  var url =window.location.protocol+"//"+window.location.hostname+"/corpses/"+id;
$("#load_show_view").load(url, function(responseTxt, statusTxt, xhr){
if(statusTxt == "success")
{
    document.getElementById('demo02').click(); // Works!
    return false;
}
if(statusTxt == "error"){

Command: toastr["error"]("Inconceivable!","Error: " + xhr.status + ": " + xhr.statusText)

toastr.options = {
"closeButton": true,
"debug": false,
"newestOnTop": false,
"progressBar": true,
"positionClass": "toast-top-center",
"preventDuplicates": false,
"onclick": null,
"showDuration": "900",
"hideDuration": "1000",
"timeOut": "5000",
"extendedTimeOut": "1000",
"showEasing": "swing",
"hideEasing": "linear",
"showMethod": "fadeIn",
"hideMethod": "fadeOut"
}

}
return false;

});
}






</script>
