@extends('layouts.app')

@section('title', '| Add User')

@section('content')

<div class='col-lg-12 col-lg-offset-2'>


    <h1><i class='fa fa-user-plus'></i> Add User</h1>
    <hr>


    {{ Form::open(array('url' => 'users')) }}

    <div class='row'>
            <div class='col-lg-3  '>
                    <!-- Firstname Field -->
                    <div class="form-group  ">
                            {!! Form::label('firstName', 'First Name:') !!}
                            {!! Form::text('firstName', null, ['class' => 'form-control']) !!}
                        </div>

                        <!-- Middlename Field -->
                        <div class="form-group  ">
                            {!! Form::label('middleName', 'Middle Name:') !!}
                            {!! Form::text('middleName', null, ['class' => 'form-control']) !!}
                        </div>

                        <!-- Lastname Field -->
                        <div class="form-group  ">
                            {!! Form::label('lastName', 'Last Name:') !!}
                            {!! Form::text('lastName', null, ['class' => 'form-control']) !!}
                        </div>

                        <!-- Rank Id Field -->
                        <div class="form-group    {{$errors->has('rank_id') ? 'has-error' :''}}">
                            {{Form::label('rank_id', 'Rank')}}<small id="Error_rank_id"></small>
                            <select name="rank_id" value="{{Request::old('rank_id')}}" onchange="investigatorRank()" class=" rank_id form-control" >
                                    <option value="">Select a Rank</option>
                                          @foreach($ranks as $rank)
                                                 <option value='{{$rank->id }}'>{{ $rank->rank}}</option>
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
                   <!-- Station Id Field -->
                   <div class="form-group     {{$errors->has('station_id') ? 'has-error' :''}}">
                    {{Form::label('station_id', 'Station')}}<small id="Error_station_id"></small>
                    <select name="station_id" value="{{Request::old('station_id')}}" onchange="investigator_stn()" class=" station_id form-control" >
                            <option value="">Select a Station</option>
                                  @foreach($stations as $station)
                                         <option value='{{ $station->id }}'>{{ $station->station}}</option>
                                  @endforeach
                    </select>
                </div>




            </div>
            <div class='col-lg-3  '>


                    <div class="form-group">
                            {{ Form::label('email', 'Email') }} <span id="Error_email"></span>
                            {{ Form::email('email', '', array('class' => ' email form-control')) }}
                        </div>
                        @hasrole('SuperAdmin')
                        <div class='form-group'>
                            @foreach ($roles as $role)
                                {{ Form::checkbox('roles[]',  $role->id ) }}
                                {{ Form::label($role->name, ucfirst($role->name)) }}<br>

                            @endforeach
                        </div>
                        @endrole

                        <div  name="frmCheckPassword" id="frmCheckPassword"  class="form-group">
                            {{ Form::label('password', 'Password') }}<br>

                            <input type="password" name="password" id="password"   autocomplete='off' class="demoInputBox  form-control" onKeyUp="checkPasswordStrength();" /><div id="password-strength-status"></div>
                           
                            {{ Form::label('password', 'Confirm Password') }}<br>
                            {{ Form::password('password_confirmation', array('class' => 'form-control')) }}

                        </div>
 
            </div>
    </div>


    {{ Form::submit('Add New User', array('class' => 'btn isEmailValid btn-primary')) }}
    {{ Form::close() }}
</div>



<script src="{{ asset('bower_components/jquery/dist/jquery-1.11.1.min.js')}}"></script>
<script>












$(".email").focusout(function() {
        email("email","email");
     });

     $(".email").keyup(function() {
        email("email","email");
      });



function email(name,myClass)
{

    var emailValidate = /^[a-zA-Z0-9_.+-]+@(?:(?:[a-zA-Z0-9-]+\.)?[a-zA-Z]+\.)?(jcf.gov)\.jm$/;
    var nameValue=false;
    namex=$("."+name).val();
    var my_val= $.trim(namex.length);
   if (my_val!=0) {

        if( namex.indexOf(' ')>=0){
            $(".isEmailValid").hide();
            $("#Error_"+myClass).html("<small style='color:red'>No spacing required... </small>");
            $("#Error_"+myClass).show();
            $("."+name).css("border","2px solid red");
            return nameValue  = false;
        }
        else if(!emailValidate.test(namex)){
            $(".isEmailValid").hide();
            $("#Error_"+myClass).html("<small style='color:red'>Only JCF email valid... </small>");
            $("#Error_"+myClass).show();
            $("."+name).css("border","2px solid red");
        return nameValue  = false;
        }
        else{
            $(".isEmailValid").show();
            $("."+name).css("border","2px solid green");
            $("#Error_"+myClass).hide();
            return nameValue = true;
        }

  }
}







</script>












<style>

    #frmCheckPassword {border-top:#F0F0F0 2px solid;background:#FAF8F8;padding:10px;}
    .demoInputBox{padding:7px; border:#F0F0F0 1px solid; border-radius:4px;}
    #password-strength-status {padding: 5px 10px;color: #FFFFFF; border-radius:4px;margin-top:5px;}
    .medium-password{background-color: #E4DB11;border:#BBB418 1px solid;}
    .weak-password{background-color: #FF6600;border:#AA4502 1px solid;}
    .strong-password{background-color: #12CC1A;border:#0FA015 1px solid;}
    </style>
    <script src="https://code.jquery.com/jquery-2.1.1.min.js" type="text/javascript"></script>
    <script type="text/javascript">
    function checkPasswordStrength() {
        var number = /([0-9])/;
        var alphabets = /([a-zA-Z])/;
        var special_characters = /([~,!,@,#,$,%,^,&,*,-,_,+,=,?,>,<])/;

        if($('#password').val().length<8) {
            $(".isEmailValid").hide();
            $('#password-strength-status').removeClass();
            $('#password-strength-status').addClass('weak-password');
            $('#password-strength-status').html("Weak (should be atleast 8 characters.)");
        } else {
            if($('#password').val().match(number) && $('#password').val().match(alphabets) && $('#password').val().match(special_characters)) {
                $(".isEmailValid").show();
                $('#password-strength-status').removeClass();
                $('#password-strength-status').addClass('strong-password');
                $('#password-strength-status').html("Strong");
            } else {
                $(".isEmailValid").hide();
                $('#password-strength-status').removeClass();
                $('#password-strength-status').addClass('medium-password');
                $('#password-strength-status').html("Medium (should include alphabets, numbers and special characters.)");
            }
        }
    }
    </script>


@endsection


