<!-- sidebar: style can be found in sidebar.less -->
<section class="sidebar">

<!-- Sidebar user panel (optional) -->
<div class="user-panel">
<div class="pull-left image">
  <img src="{{asset('/dist/img/jcflogo.png')}}" class="img-circle" alt="User Image">
</div>
<div class="pull-left info">
  <p><small> {{ isset(auth()->user()->email  )?auth()->user()->email  :'' }}</small></p>
  <!-- Status -->
  <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
</div>
</div>


@include('../search')
<!-- Sidebar Menu -->
<ul class="sidebar-menu" data-widget="tree">
  <a  id="dasboard" href="/"> <li class="header"> <center>Dashboard</center></li></a>
<!-- Optionally, you can add icons to the links -->


@hasrole('SuperAdmin|Administer')
<li class="treeview">
  <a href="#"><i class="fa fa-lock" aria-hidden="true"></i><span><b>System Admin</b> </span>
    <span class="pull-right-container">
        <i class="fa fa-angle-left pull-right"></i>
      </span>
  </a>
  <ul class="treeview-menu">
    <li class="{{ Request::is('feedbacks*') ? 'active' : '' }}">
      <a href="{!! route('feedbacks.index') !!}"><i class="fa fa-comments" aria-hidden="true"></i><span>Feedback</span></a>
  </li>
  
    <li><a href="{{ route('users.create') }}"><i class="fa fa-user-plus" aria-hidden="true"></i>Create Users</a></li>

    <li><a href="{{ route('users.index') }}"><i class="fa fa-list-ol" aria-hidden="true"></i>User List</a></li>
    <li class="active"><a href="{{ route('roles.index')}}">  <i class="fa fa-key"></i><span>Roles</span></a></li>
    <li><a href="{{ route('permissions.index') }}"><i class="fa fa-key"></i> <span>Permissions</span></a></li>


  </ul>
</li>



<li class="treeview">
        <a href="#"><i class="fa fa-lock" aria-hidden="true"></i><span><b>Populate Database</b> </span>
          <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
        </a>
        <ul class="treeview-menu">
                @include('layouts/populate')
        </ul>
      </li>



@elserole('Admin')
<li class="treeview">
    <a href="#"><i class="fa fa-lock" aria-hidden="true"></i><span><b>System Admin D</b> </span>
      <span class="pull-right-container">
          <i class="fa fa-angle-left pull-right"></i>
        </span>
    </a>
    <ul class="treeview-menu">
      <li><a href="{{ route('users.create') }}"><i class="fa fa-user-plus" aria-hidden="true"></i>Create Users</a></li>
      <li><a href="{{ route('users.index') }}"><i class="fa fa-list-ol" aria-hidden="true"></i>User List</a></li>


    </ul>
  </li>

@endrole

 <ul class="sidebar-menu" data-widget="tree">
            @include('layouts/menu')
</ul>






      <script>// load the officer list
            // $(document).ready(function(){
            //         $(".officers_list_link").click( function() {
            //         $('#load_officer_list').load('/officers', function(responseTxt, statusTxt, jqXHR){
            //         if(statusTxt == "success"){
            //         }
            //         if(statusTxt == "error"){
            //             alert("Error: " + jqXHR.status + " " + jqXHR.statusText);
            //         }
            //             });
            //         });

            // });
           </script>

</section>
