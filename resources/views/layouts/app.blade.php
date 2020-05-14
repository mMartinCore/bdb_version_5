<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge"> 
    <meta name="csrf-token" content="{{ csrf_token() }}"> 
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <link rel="stylesheet" href="{{asset('bower_components/Ionicons/css/ionicons.min.css')}}">
    <link rel="stylesheet" href="{{mix('css/app.css')}}">     
    <link rel="stylesheet" href="{{asset('bower_components/bootstrap/dist/css/bootstrap.min.css')}}"> 
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    {{-- <link rel="stylesheet" href="{{asset('bower_components/font-awesome/css/font-awesome.min.css')}}">   --}}
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.19.1/moment.min.js"></script>
    {{-- <script type="text/javascript" src="{{asset('moment/moment.js')}}"></script>   --}}
    {{-- <script src="//{{ Request::getHost() }}:6001/socket.io/socket.io.js"></script> --}}
   <style>    
      #dasboard :hover{
      background-color: red;
      color: aliceblue;
      font-size: large;
      }
   </style>
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
   
<title>{{ config('app.name', 'DBDS') }}</title>
</head>

<body  id="contentLoad"  class="hold-transition skin-blue sidebar-mini">


@include('layouts.quickSearchModal') 
<div class="wrapper">
     @include('layouts/header') 
  <aside class="main-sidebar">
        @include('layouts/sidebar')
  </aside>
<div class="content-wrapper ">
  <div>
     @include('flash-message')
 </div >
      @yield('content')  
</div> 
<footer class="main-footer" >  
  @include('layouts/footer')
</footer>
</div> 
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
  </body>
  {{-- <script type="text/javascript" src="{{asset('jquery.min.js')}}"></script> --}}
  {{-- <script type="text/javascript" src="{{asset('jquery.pjax.js')}}"></script>  --}}
  <script type="text/javascript">
         // $(function(){       
    //       $(document).pjax('.a', '#contentLoad')
    //       })
    //           $(document).ready(function(){
        
    //           if ($.support.pjax) {
    //           $.pjax.defaults.timeout = 2000; // time in milliseconds
    //           }
              
    //           }); 
              
  </script>
<!-- REQUIRED JS SCRIPTS --> 
<script src="{{ asset('dist/js/adminlte.min.js')}}"></script> 
<script src="{{ asset('bower_components/bootstrap/dist/js/bootstrap.min.js')}}"></script>
@include('layouts.recentActivities')

<script>
 
function getViewId(id) {

  var url ='';
  if( window.location.port===''){
        url = window.location.protocol+"//"+window.location.hostname+"/corpses/"+id;
    }else{
        url = window.location.protocol+"//"+window.location.hostname+":"+window.location.port+"/corpses/"+id;
    }

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
  var url ='';
  if( window.location.port===''){
        url = window.location.protocol+"//"+window.location.hostname+"/corpses/"+id;
    }else{
        url = window.location.protocol+"//"+window.location.hostname+":"+window.location.port+"/corpses/"+id;
    }
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


</html>
