
@extends('layouts.app')

@section('title', '| Edit User')

@section('content')

<div class='col-lg-12 col-lg-offset-2'>

    <h1><i class='fa fa-user-plus'></i> Edit {{$user->name}}</h1>
    <hr>

    {{ Form::model($user, array('route' => array('users.update', $user->id), 'method' => 'PUT')) }}{{-- Form model binding to automatically populate our fields with user data --}}


    <div class='row'>
            <div class='col-lg-3  '>
<!-- Firstname Field -->
<div class="form-group  ">
        {!! Form::label('firstName', 'Firstname:') !!}
        {!! Form::text('firstName', null, ['class' => 'form-control']) !!}
    </div>

    <!-- Middlename Field -->
    <div class="form-group  ">
        {!! Form::label('middleName', 'Middlename:') !!}
        {!! Form::text('middleName', null, ['class' => 'form-control']) !!}
    </div>

    <!-- Lastname Field -->
    <div class="form-group  ">
        {!! Form::label('lastName', 'Lastname:') !!}
        {!! Form::text('lastName', null, ['class' => 'form-control']) !!}
    </div>

        <!-- Rank Id Field -->
        <div class="form-group    {{$errors->has('rank_id') ? 'has-error' :''}}">
            {{Form::label('rank_id', 'Rank')}}<small id="Error_rank_id"></small>
            <select name="rank_id" value="{{Request::old('rank_id')}}" class=" rank_id form-control" >
            <option value="{!!$user->rank->id!!}">{!!$user->rank->rank !!} </option> 
                          @foreach($ranks as $rank)
                                @if ( $rank->id != $user->rank->id)
                                <option value='{{$rank->id }}'>{{ $rank->rank}}</option>
                                @endif                                 
                          @endforeach
            </select>
        </div>
    </div>









            <div class='col-lg-3  '>

    <!-- Regno Field -->
    <div class="form-group  ">
        {!! Form::label('regNo', 'Reg #:') !!}
        {!! Form::number('regNo', null, ['class' => 'form-control']) !!}
    </div>

    <div class="form-group     {{$errors->has('station_id') ? 'has-error' :''}}">
        {{Form::label('station_id', 'Station')}}<small id="Error_station_id"></small>
        <select name="station_id" value="{{Request::old('station_id')}}" onchange="investigator_stn()" class=" station_id form-control" >
        <option value='{!! $user->station->id !!}'>{!! $user->station->station !!}  </option>               
                      @foreach($stations as $station)
                            @if ( $user->station->id !=$station->id )
                            <option value='{!! $station->id !!}'>{!! $station->station!!}</option>
                            @endif
                      @endforeach
        </select>
    </div>



</div>

@hasrole('SuperAdmin')

  <div class='col-lg-3  '>
    <div class="form-group">
        {{ Form::label('email', 'Email') }}
        {{ Form::email('email', null, array('class' => 'form-control')) }}
    </div>

    <h5><b>Give Role</b></h5>

    <div class='form-group'>
        @foreach ($roles as $role)
            {{ Form::checkbox('roles[]',  $role->id, $user->roles ) }}
            {{ Form::label($role->name, ucfirst($role->name)) }}<br>

        @endforeach
    </div>
{{--
    <div class="form-group">
        {{ Form::label('password', 'Password') }}<br>
        {{ Form::password('password', array('class' => 'form-control')) }}

    </div>

    <div class="form-group">
        {{ Form::label('password', 'Confirm Password') }}<br>
        {{ Form::password('password_confirmation', array('class' => 'form-control')) }}

    </div> --}}
</div>

@endrole

</div>

    {{ Form::submit('Update User', array('class' => 'btn btn-primary')) }}

    {{ Form::close() }}

</div>

@endsection
