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
                <div class="card-body">
                        <h3 style="text-align:center; box-sizing: border-box; font-family: sans-serif; font-weight: 500; line-height: 1.1;
                         color: #333333; margin-top: 20px; margin-bottom: 10px; font-size: 30px; background-color: #ecf0f5; ">You Just Read update Corpse Notification</h3>
                        <hr>
                    <ul class="item-group">
                        @foreach ($corpses as $corpse)
                           <li class="list-group-item">
                             {{ $corpse->station->station }} of   {{ $corpse->station->division->division }} formation Updated
                                @if ( $corpse->first_name==="Unidentified")
                                an unidentified corpse info..
                                @else
                                {{ $corpse->first_name }} {{ $corpse->last_name}} corpse info..
                                @endif
                                <b>{{ $corpse->created_at->diffForHumans()}}</b>  <a href="/corpses/{{$corpse->id}} "><i>View</i></a>
                           </li>
                        @endforeach
                    </ul>

                </div>
            </div>
        </div>
</div>
</div>
@endsection
