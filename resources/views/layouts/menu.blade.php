



@hasrole('SuperAdmin|Admin|viewer|writer')
<li class="{{ Request::is('corpses*') ? 'active' : '' }}">
    <a href="{!! route('corpses.create') !!}"><i class="fa fa-edit"></i><span> New Corpse </span></a>
</li>
<li style="cursor: pointer; "  class="{{ Request::is('corpses*') ? 'active' : '' }}">
    <a class="hover showRecentActivities"  data-toggle="popover-x" data-target="#myPopover2" data-placement="right"><i class="fa fa-clock-o" aria-hidden="true"></i><span>Recent Activity</span> </a>
 </li>
 @hasrole('SuperAdmin')
<li class="{{ Request::is('corpses*') ? 'active' : '' }}">
    <a href="/isOnlines"><i class="fa fa-user"></i><span> Online User</span></a>
</li>
@endrole
<li class="{{ Request::is('corpses*') ? 'active' : '' }}">
    <a class="a" href="{!! route('corpses.index') !!}"><i class="fa fa-list"></i><span>Corpse Index</span></a>
</li>

<li class="{{ Request::is('corpses*') ? 'active' : '' }}">
    <a class="a" href="{!! route('corpses.notApprove') !!}"><i class="fa fa-list"></i><span>Request Denied</span></a>
</li>


<li class="{{ Request::is('corpses*') ? 'active' : '' }}">
    <a href="{!! route('corpses.noRequest') !!}"><i class="fa fa-list"></i><span> No Request</span></a>
</li>

<li class="{{ Request::is('corpses*') ? 'active' : '' }}">
    <a href="{!! route('corpses.approve') !!}"><i class="fa fa-list"></i><span>Request List</span></a>
</li>
<li class="{{ Request::is('corpses*') ? 'active' : '' }}">
    <a href="{!! route('corpses.thirtyDaylist') !!}"><i class="fa fa-list"></i><span>Thirty Day's List</span></a>
</li>


<li class="{{ Request::is('feedbacks*') ? 'active' : '' }}">
    <a href="{!! route('feedbacks.create') !!}"><i class="fa fa-comments" aria-hidden="true"></i><span>Feedback</span></a>
</li>


@else

@endrole

