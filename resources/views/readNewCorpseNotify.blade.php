@extends('layouts.app')
@section('content')
<style>
        .myStyle{
            -webkit-box-shadow: 0px 10px 13px -7px #000000, 5px 5px 15px 5px rgba(0,0,0,0);
              box-shadow: 0px 10px 13px -7px #000000, 5px 5px 15px 5px rgba(0,0,0,0);
        }</style>



<div class="container">
        <div class="col-lg-10 col-lg-offset-2">
                <br><br>


        <div class=" myStyle col-md-8">
            <div class="card">
                    <div class="card-header  " >
                      <h3 style="text-align:center; box-sizing: border-box; font-family: sans-serif; font-weight: 500; line-height: 1.1;
                         color: #333333; margin-top: 20px; margin-bottom: 10px; font-size: 30px; background-color: #ecf0f5; ">  Corpse Notification</h3>
                        <hr>
                    </div>

                <div class=" card-body">
                    <ul class="item-group">
                        @foreach ($corpses as $corpse)

                        <li class="list-group-item">
                            @if ($corpse->data['newCorpse']['type']==='Created')

                                {{$corpse->data['newCorpse']['user'] }} of {{ $corpse->data['newCorpse']['division']  }} formation <b><i> posted</i> </b>
                                @if ( $corpse->data['newCorpse']['first_name']==="Unidentified")
                                an unidentified corpse info..
                                <b>{{ $corpse->created_at->diffForHumans()}}</b> <a   onclick="getViewId_view_Notify({!!$corpse->data['newCorpse']['id']!!});" href="#"><i>View</i></a>
                                @else
                                {{ $corpse->data['newCorpse']['first_name'] }} {{ $corpse->data['newCorpse']['last_name'] }} corpse info..
                                <b>{{ $corpse->created_at->diffForHumans()}}</b> <a   onclick="getViewId_view_Notify({!!$corpse->data['newCorpse']['id']!!});" href="#"><i>View</i></a>
                                @endif

                          @elseif ($corpse->data['newCorpse']['type']==='Updated')
                                {{$corpse->data['newCorpse']['user'] }} of {{ $corpse->data['newCorpse']['division']  }} formation <b><i>updated</i> </b>
                                @if ( $corpse->data['newCorpse']['first_name']==="Unidentified")
                                an unidentified corpse info..
                                <b>{{ $corpse->created_at->diffForHumans()}}</b> <a   onclick="getViewId_view_Notify({!!$corpse->data['newCorpse']['id']!!});" href="#"><i>View</i></a>
                                @else
                                {{ $corpse->data['newCorpse']['first_name'] }} {{ $corpse->data['newCorpse']['last_name'] }} corpse info..
                                <b>{{ $corpse->created_at->diffForHumans()}}</b> <a   onclick="getViewId_view_Notify({!!$corpse->data['newCorpse']['id']!!});" href="#"><i>View</i></a>
                                @endif

                        @elseif ($corpse->data['newCorpse']['type']==='Request')
                                {{$corpse->data['newCorpse']['user'] }} of {{ $corpse->data['newCorpse']['division']  }} formation  made a Pauper's Burial <b><i>Request</i> </b> for
                                @if ( $corpse->data['newCorpse']['first_name']==="Unidentified")
                                an unidentified corpse.  Corpse Reference #: {{ $corpse->data['newCorpse']['id'] }}
                                <b>{{ $corpse->created_at->diffForHumans()}}</b> <a   onclick="getViewId_view_Notify({!!$corpse->data['newCorpse']['id']!!});" href="#"><i>View</i></a>
                                @else
                                {{ $corpse->data['newCorpse']['first_name'] }} {{ $corpse->data['newCorpse']['last_name'] }} corpse.  Corpse Reference #: {{ $corpse->data['newCorpse']['id'] }}
                                <b>{{ $corpse->created_at->diffForHumans()}}</b> <a   onclick="getViewId_view_Notify({!!$corpse->data['newCorpse']['id']!!});" href="#"><i>View</i></a>
                                @endif

                            @elseif ( $corpse->data['newCorpse']['type']==="message")
                            {{  $corpse->data['newCorpse']['from'] }}   sent you a new  <b><i>Message</i> </b>
                            <b>{{ $corpse->created_at->diffForHumans()}}</b> <a   onclick="getViewId_view_Notify({!!$corpse->data['newCorpse']['id']!!});" href="#"><i>View</i></a>
    

                                
                            @elseif ( $corpse->data['newCorpse']['type']==="Overthirty")
                            Corpse Reference #: {{ $corpse->data['newCorpse']['id'] }}     of {{ $corpse->data['newCorpse']['division'] }} Over <b >thirty(30)</b> days <b><i>...</i> </b>
                            <b>{{ $corpse->created_at->diffForHumans()}}</b> <a   onclick="getViewId_view_Notify({!!$corpse->data['newCorpse']['id']!!});" href="#"><i>View</i></a>

                            @elseif ( $corpse->data['newCorpse']['type']==="PostCompletedNotBuried")
                            Corpse Reference #: {{ $corpse->data['newCorpse']['id'] }}     of {{ $corpse->data['newCorpse']['division'] }}  <b > Postmortem completed and No burial </b>  <b><i>...</i> </b>
                            <b>{{ $corpse->created_at->diffForHumans()}}</b> <a   onclick="getViewId_view_Notify({!!$corpse->data['newCorpse']['id']!!});" href="#"><i>View</i></a>

                            @elseif ( $corpse->data['newCorpse']['type']==="FifteenDays")
                            Corpse Reference #: {{ $corpse->data['newCorpse']['id'] }}     of {{ $corpse->data['newCorpse']['division'] }} <b >Fifteen Days(15)</b> past No Postmortem conduct and corpse not buried<b><i>...</i> </b>
                           <b>{{ $corpse->created_at->diffForHumans()}}</b> <a   onclick="getViewId_view_Notify({!!$corpse->data['newCorpse']['id']!!});" href="#"><i>View</i></a>

                            @elseif ( $corpse->data['newCorpse']['type']==="TwentyFiveDays")
                            Corpse Reference #: {{ $corpse->data['newCorpse']['id'] }}     of {{ $corpse->data['newCorpse']['division'] }} <b >Twenty Five Days(25)</b> past No Postmortem conduct and corpse not buried<b><i>...</i> </b>
                           <b>{{ $corpse->created_at->diffForHumans()}}</b> <a   onclick="getViewId_view_Notify({!!$corpse->data['newCorpse']['id']!!});" href="#"><i>View</i></a>

                            @elseif ( $corpse->data['newCorpse']['type']==="PendingPastNoPostmortem")
                            Corpse Reference #: {{ $corpse->data['newCorpse']['id'] }}     of {{ $corpse->data['newCorpse']['division'] }}  <b > Postmortem Pending date expired No Postmortem conducted</b>  <b><i>...</i> </b>
                           <b>{{ $corpse->created_at->diffForHumans()}}</b> <a   onclick="getViewId_view_Notify({!!$corpse->data['newCorpse']['id']!!});" href="#"><i>View</i></a>

                            @elseif ( $corpse->data['newCorpse']['type']==="PendingPastNoPostmortem")
                            Corpse Reference #: {{ $corpse->data['newCorpse']['id'] }}     of {{ $corpse->data['newCorpse']['division'] }} Postmortem Pending date expired <b > No Postmortem conducted</b>  <b><i>...</i> </b>
                           <b>{{ $corpse->created_at->diffForHumans()}}</b> <a   onclick="getViewId_view_Notify({!!$corpse->data['newCorpse']['id']!!});" href="#"><i>View</i></a>

                            @elseif ( $corpse->data['newCorpse']['type']==="Approved")
                            Corpse Reference #: {{ $corpse->data['newCorpse']['id'] }}     of {{ $corpse->data['newCorpse']['division'] }} Postmortem Request <b > Approved</b>  <b><i>...</i> </b>
                            <b>{{ $corpse->created_at->diffForHumans()}}</b> <a   onclick="getViewId_view_Notify({!!$corpse->data['newCorpse']['id']!!});" href="#"><i>View</i></a>

                            @elseif ( $corpse->data['newCorpse']['type']==="Denied")
                            Corpse Reference #: {{ $corpse->data['newCorpse']['id'] }}     of {{ $corpse->data['newCorpse']['division'] }} Postmortem Request <b > Denied</b>  <b><i>...</i> </b>
                            <b>{{ $corpse->created_at->diffForHumans()}}</b> <a   onclick="getViewId_view_Notify({!!$corpse->data['newCorpse']['id']!!});" href="#"><i>View</i></a>

                            @elseif ( $corpse->data['newCorpse']['type']==="task")
                            {{  $corpse->data['newCorpse']['from'] }} <b>@</b>DCP Admin sent you a new <b><i>task</i> </b>
                            <b>{{ $corpse->created_at->diffForHumans()}}</b> <a   onclick="getViewId_view_Notify({!!$corpse->data['newCorpse']['id']!!});" href="#"><i>View</i></a>

                            
                            @elseif ( $corpse->data['newCorpse']['type']==="NewUser")
                             New user  {{  $corpse->data['newCorpse']['name'] }} of {{  $corpse->data['newCorpse']['station'] }}  {{  $corpse->data['newCorpse']['division'] }} <b><i> Request Role id:{{ $corpse->data['newCorpse']['id'] }}</i> </b> ->
                            <b>{{ $corpse->created_at->diffForHumans()}}</b> <a   href="{!! route('users.edit', [$corpse->data['newCorpse']['id'] ]) !!}"  ><i>View</i></a>

                           @endif

                           </li><hr>
                        @endforeach
                    </ul>

                </div>
            </div>
        </div>
    </div>
    </div> <br><br><br>

    @include('corpses.showModal')
@endsection


