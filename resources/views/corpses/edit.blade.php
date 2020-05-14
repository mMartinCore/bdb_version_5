@extends('layouts.app')

@section('content')
<link rel="stylesheet" href="{{asset('dist/investigatorEdit.css')}}">

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


    </style>


    {{-- <script>
    window.addEventListener("load", function () {
        const loader = document.querySelector(".loader");
        loader.className += " hidden"; // class "loader hidden"
    });

    </script>
    <div class="loader">
            <img src="{{asset('/dist/img/LOADING.gif')}}"   alt="Loading...">
   </div> --}}



















<style>
        .blueBox {
    -webkit-box-sizing: content-box;
    -moz-box-sizing: content-box;
    box-sizing: content-box;
    margin: 10px;
    height: auto;
    border: none;
    font: normal 14px/1 Tahoma, Geneva, sans-serif;
    color: black;
    -o-text-overflow: ellipsis;
    text-overflow: ellipsis;
    background:ghostwhite
    -webkit-box-shadow: 5px 5px 8px 2px rgba(0,0,0,0.4) ;
    box-shadow: 5px 5px 8px 2px rgba(0,0,0,0.4) ;
    /* text-shadow: 1px 1px 2px rgba(0,0,0,0.5) ; */
    -webkit-border-radius: 40px 0px 40px 0px;
    -moz-border-radius: 40px 0px 40px 0px;
    border-radius: 40px 0px 40px 0px;
    }
    
    .blueBoxInvestigator {
    -webkit-box-sizing: content-box;
    -moz-box-sizing: content-box;
    box-sizing: content-box;
    margin: 10px;
    height:auto;
    border: none;
    font: normal 14px/1 Tahoma, Geneva, sans-serif;
    color: black;
    -o-text-overflow: ellipsis;
    text-overflow: ellipsis;
    background:ghostwhite
    -webkit-box-shadow: 5px 5px 8px 2px rgba(0,0,0,0.4) ;
    box-shadow: 5px 5px 8px 2px rgba(0,0,0,0.4) ;
    /* text-shadow: 1px 1px 2px rgba(0,0,0,0.5) ; */
    -webkit-border-radius: 40px 0px 40px 0px;
    -moz-border-radius: 40px 0px 40px 0px;
    border-radius: 40px 0px 40px 0px;
    }

</style>
 <section class="content-header">
        <div class="title"><h4>   <i class="fa fa-pencil-square-o" aria-hidden="true"></i>  Edit   Corpse </h4></div> 
    </section>
    @include('corpses.step')
   {!! Form::open(['route' => 'corpses.editCorpse','id'=>'postForm', 'enctype' => 'multipart/form-data']) !!}
   {{csrf_field()}}

<input type="hidden" name="reference_id" value="{{$corpse->id}}">

   <div class="container"  >

    <div class="container" >
        
        <span id="form_output"></span>
<span class="CoprseSection">

    <div class="well col-sm-12" style="background:white">

    <h4>  Coprse Section</h4>
    <div    class=" row blueBox  ">
        <br><br>
     <!-- Unidentified Field -->
<div class="form-group col-sm-3">
    {!! Form::label('unidentified', 'Unidentified:') !!}<small id="Error_unidentified"></small>
    <select name="unidentified" class="form-control unidentified" onchange="is_unidentiied()" id="unidentified">
        <option value="{{$corpse->unidentified}}">{{$corpse->unidentified}}</option>
        
            <option value="Yes">Yes</option>
            <option value="No">No</option>
        </select>

</div>


<!-- First Name Field -->
<div class="form-group   col-sm-3">
    {!! Form::label('first_name', 'First Name:') !!} <small id="Error_first_name"></small>
    {!! Form::text('first_name', $corpse->first_name, ['class' => 'form-control first_name']) !!}

</div>



<!-- Middle Name Field -->
<div class="form-group col-sm-3">
    {!! Form::label('middle_name', 'Middle Name:') !!} <small id="Error_middle_name"></small>
    {!! Form::text('middle_name', $corpse->middle_name, ['class' => 'form-control middle_name']) !!}

</div>

   <!-- Last Name Field -->
   <div class="form-group col-sm-3">
    {!! Form::label('last_name', 'Last Name:') !!} <small id="Error_last_name"></small>
    {!! Form::text('last_name', $corpse->last_name, ['class' => 'form-control last_name ']) !!}

</div>


<div class="form-group col-sm-3">
    {!! Form::label('suspected_name', 'Account Alias:') !!} <small id="Error_suspected_name"></small>
    {!! Form::text('suspected_name', $corpse->suspected_name, ['class' => 'form-control suspected_name']) !!}

</div>

<!-- Dob Field -->
<div class="form-group col-sm-3">
    {!! Form::label('dob', 'Date of Birth:') !!}  <small id="Error_dob"></small>
    {!! Form::date('dob', $corpse->dob, ['class' => 'form-control dob','id'=>'dob']) !!}

</div>

@section('scripts')
    <script type="text/javascript">
        $('#dob').datetimepicker({
            format: 'YYYY-MM-DD',
             useCurrent: true
        })
    </script>
@endsection

<!-- Sex Field -->
<div class="form-group col-sm-3">
    {!! Form::label('sex', 'Gender:') !!} <small id="Error_sex"></small>
    <select name="sex" class="form-control sex" onchange="gender()" id="sex">
        <option value="{{$corpse->sex}}">{{$corpse->sex}}</option> 
        @if ($corpse->sex=="Male")
            <option value="Female">Female</option>
            <option value="Unknown">Unknown</option>
        @elseif($corpse->sex=="Female") 
        <option value="Male">Male</option>
        <option value="Unknown">Unknown</option>      
        @else
        <option value="Male">Male</option>         
        <option value="Female">Female</option>
  
        @endif

           
            
        </select>

</div>

<!-- Nationality Field -->
<input type="hidden" name="nationality" id="nationality">
<div class="form-group col-sm-3">
    {!! Form::label('corpseCountry', 'Country of Nationality:') !!} <small id="Error_corpseCountry"></small>
    <select name="nationality" class="form-control corpseCountry" onchange="country()" id="corpseCountry" >
        <option value="{{$corpse->nationality}}">{{$corpse->nationality}}</option> 
            <option value="Afghanistan">Afghanistan</option>
            <option value="Åland Islands">Åland Islands</option>
            <option value="Albania">Albania</option>
            <option value="Algeria">Algeria</option>
            <option value="American">America</option>
            <option value="American Samoa">American Samoa</option>
            <option value="Andorra">Andorra</option>
            <option value="Angola">Angola</option>
            <option value="Anguilla">Anguilla</option>
            <option value="Antarctica">Antarctica</option>
            <option value="Antigua and Barbuda">Antigua and Barbuda</option>
            <option value="Argentina">Argentina</option>
            <option value="Armenia">Armenia</option>
            <option value="Aruba">Aruba</option>
            <option value="Australia">Australia</option>
            <option value="Austria">Austria</option>
            <option value="Azerbaijan">Azerbaijan</option>
            <option value="Bahamas">Bahamas</option>
            <option value="Bahrain">Bahrain</option>
            <option value="Bangladesh">Bangladesh</option>
            <option value="Barbados">Barbados</option>
            <option value="Belarus">Belarus</option>
            <option value="Belgium">Belgium</option>
            <option value="Belize">Belize</option>
            <option value="Benin">Benin</option>
            <option value="Bermuda">Bermuda</option>
            <option value="Bhutan">Bhutan</option>
            <option value="Bolivia">Bolivia</option>
            <option value="Bosnia and Herzegovina">Bosnia and Herzegovina</option>
            <option value="Botswana">Botswana</option>
            <option value="Bouvet Island">Bouvet Island</option>
            <option value="Brazil">Brazil</option>
            <option value="British Indian Ocean Territory">British Indian Ocean Territory</option>
            <option value="Brunei Darussalam">Brunei Darussalam</option>
            <option value="Bulgaria">Bulgaria</option>
            <option value="Burkina Faso">Burkina Faso</option>
            <option value="Burundi">Burundi</option>
            <option value="Cambodia">Cambodia</option>
            <option value="Cameroon">Cameroon</option>
            <option value="Canada">Canada</option>
            <option value="Cape Verde">Cape Verde</option>
            <option value="Cayman Islands">Cayman Islands</option>
            <option value="Central African Republic">Central African Republic</option>
            <option value="Chad">Chad</option>
            <option value="Chile">Chile</option>
            <option value="China">China</option>
            <option value="Christmas Island">Christmas Island</option>
            <option value="Cocos (Keeling) Islands">Cocos (Keeling) Islands</option>
            <option value="Colombia">Colombia</option>
            <option value="Comoros">Comoros</option>
            <option value="Congo">Congo</option>
            <option value="Congo, The Democratic Republic of The">Congo, The Democratic Republic of The</option>
            <option value="Cook Islands">Cook Islands</option>
            <option value="Costa Rica">Costa Rica</option>
            <option value="Cote D'ivoire">Cote D'ivoire</option>
            <option value="Croatia">Croatia</option>
            <option value="Cuba">Cuba</option>
            <option value="Cyprus">Cyprus</option>
            <option value="Czech Republic">Czech Republic</option>
            <option value="Denmark">Denmark</option>
            <option value="Djibouti">Djibouti</option>
            <option value="Dominica">Dominica</option>
            <option value="Dominican Republic">Dominican Republic</option>
            <option value="Ecuador">Ecuador</option>
            <option value="Egypt">Egypt</option>
            <option value="El Salvador">El Salvador</option>
            <option value="England">England</option>
            <option value="Equatorial Guinea">Equatorial Guinea</option>
            <option value="Eritrea">Eritrea</option>
            <option value="Estonia">Estonia</option>
            <option value="Ethiopia">Ethiopia</option>
            <option value="Falkland Islands (Malvinas)">Falkland Islands (Malvinas)</option>
            <option value="Faroe Islands">Faroe Islands</option>
            <option value="Fiji">Fiji</option>
            <option value="Finland">Finland</option>
            <option value="France">France</option>
            <option value="French Guiana">French Guiana</option>
            <option value="French Polynesia">French Polynesia</option>
            <option value="French Southern Territories">French Southern Territories</option>
            <option value="Gabon">Gabon</option>
            <option value="Gambia">Gambia</option>
            <option value="Georgia">Georgia</option>
            <option value="Germany">Germany</option>
            <option value="Ghana">Ghana</option>
            <option value="Gibraltar">Gibraltar</option>
            <option value="Greece">Greece</option>
            <option value="Greenland">Greenland</option>
            <option value="Grenada">Grenada</option>
            <option value="Guadeloupe">Guadeloupe</option>
            <option value="Guam">Guam</option>
            <option value="Guatemala">Guatemala</option>
            <option value="Guernsey">Guernsey</option>
            <option value="Guinea">Guinea</option>
            <option value="Guinea-bissau">Guinea-bissau</option>
            <option value="Guyana">Guyana</option>
            <option value="Haiti">Haiti</option>
            <option value="Heard Island and Mcdonald Islands">Heard Island and Mcdonald Islands</option>
            <option value="Holy See (Vatican City State)">Holy See (Vatican City State)</option>
            <option value="Honduras">Honduras</option>
            <option value="Hong Kong">Hong Kong</option>
            <option value="Hungary">Hungary</option>
            <option value="Iceland">Iceland</option>
            <option value="India">India</option>
            <option value="Indonesia">Indonesia</option>
            <option value="Iran, Islamic Republic of">Iran, Islamic Republic of</option>
            <option value="Iraq">Iraq</option>
            <option value="Ireland">Ireland</option>
            <option value="Isle of Man">Isle of Man</option>
            <option value="Israel">Israel</option>
            <option value="Italy">Italy</option>
            <option value="Jamaica">Jamaica</option>
            <option value="Japan">Japan</option>
            <option value="Jersey">Jersey</option>
            <option value="Jordan">Jordan</option>
            <option value="Kazakhstan">Kazakhstan</option>
            <option value="Kenya">Kenya</option>
            <option value="Kiribati">Kiribati</option>
            <option value="Korea, Democratic People's Republic of">Korea, Democratic People's Republic of</option>
            <option value="Korea, Republic of">Korea, Republic of</option>
            <option value="Kuwait">Kuwait</option>
            <option value="Kyrgyzstan">Kyrgyzstan</option>
            <option value="Lao People's Democratic Republic">Lao People's Democratic Republic</option>
            <option value="Latvia">Latvia</option>
            <option value="Lebanon">Lebanon</option>
            <option value="Lesotho">Lesotho</option>
            <option value="Liberia">Liberia</option>
            <option value="Libyan Arab Jamahiriya">Libyan Arab Jamahiriya</option>
            <option value="Liechtenstein">Liechtenstein</option>
            <option value="Lithuania">Lithuania</option>
            <option value="Luxembourg">Luxembourg</option>
            <option value="Macao">Macao</option>
            <option value="Macedonia, The Former Yugoslav Republic of">Macedonia, The Former Yugoslav Republic of</option>
            <option value="Madagascar">Madagascar</option>
            <option value="Malawi">Malawi</option>
            <option value="Malaysia">Malaysia</option>
            <option value="Maldives">Maldives</option>
            <option value="Mali">Mali</option>
            <option value="Malta">Malta</option>
            <option value="Marshall Islands">Marshall Islands</option>
            <option value="Martinique">Martinique</option>
            <option value="Mauritania">Mauritania</option>
            <option value="Mauritius">Mauritius</option>
            <option value="Mayotte">Mayotte</option>
            <option value="Mexico">Mexico</option>
            <option value="Micronesia, Federated States of">Micronesia, Federated States of</option>
            <option value="Moldova, Republic of">Moldova, Republic of</option>
            <option value="Monaco">Monaco</option>
            <option value="Mongolia">Mongolia</option>
            <option value="Montenegro">Montenegro</option>
            <option value="Montserrat">Montserrat</option>
            <option value="Morocco">Morocco</option>
            <option value="Mozambique">Mozambique</option>
            <option value="Myanmar">Myanmar</option>
            <option value="Namibia">Namibia</option>
            <option value="Nauru">Nauru</option>
            <option value="Nepal">Nepal</option>
            <option value="Netherlands">Netherlands</option>
            <option value="Netherlands Antilles">Netherlands Antilles</option>
            <option value="New Caledonia">New Caledonia</option>
            <option value="New Zealand">New Zealand</option>
            <option value="Nicaragua">Nicaragua</option>
            <option value="Niger">Niger</option>
            <option value="Nigeria">Nigeria</option>
            <option value="Niue">Niue</option>
            <option value="Norfolk Island">Norfolk Island</option>
            <option value="Northern Mariana Islands">Northern Mariana Islands</option>
            <option value="Norway">Norway</option>
            <option value="Oman">Oman</option>
            <option value="Pakistan">Pakistan</option>
            <option value="Palau">Palau</option>
            <option value="Palestinian Territory, Occupied">Palestinian Territory, Occupied</option>
            <option value="Panama">Panama</option>
            <option value="Papua New Guinea">Papua New Guinea</option>
            <option value="Paraguay">Paraguay</option>
            <option value="Peru">Peru</option>
            <option value="Philippines">Philippines</option>
            <option value="Pitcairn">Pitcairn</option>
            <option value="Poland">Poland</option>
            <option value="Portugal">Portugal</option>
            <option value="Puerto Rico">Puerto Rico</option>
            <option value="Qatar">Qatar</option>
            <option value="Reunion">Reunion</option>
            <option value="Romania">Romania</option>
            <option value="Russian Federation">Russian Federation</option>
            <option value="Rwanda">Rwanda</option>
            <option value="Saint Helena">Saint Helena</option>
            <option value="Saint Kitts and Nevis">Saint Kitts and Nevis</option>
            <option value="Saint Lucia">Saint Lucia</option>
            <option value="Saint Pierre and Miquelon">Saint Pierre and Miquelon</option>
            <option value="Saint Vincent and The Grenadines">Saint Vincent and The Grenadines</option>
            <option value="Samoa">Samoa</option>
            <option value="San Marino">San Marino</option>
            <option value="Sao Tome and Principe">Sao Tome and Principe</option>
            <option value="Saudi Arabia">Saudi Arabia</option>
            <option value="Senegal">Senegal</option>
            <option value="Serbia">Serbia</option>
            <option value="Seychelles">Seychelles</option>
            <option value="Sierra Leone">Sierra Leone</option>
            <option value="Singapore">Singapore</option>
            <option value="Slovakia">Slovakia</option>
            <option value="Slovenia">Slovenia</option>
            <option value="Solomon Islands">Solomon Islands</option>
            <option value="Somalia">Somalia</option>
            <option value="South Africa">South Africa</option>
            <option value="South Georgia and The South Sandwich Islands">South Georgia and The South Sandwich Islands</option>
            <option value="Spain">Spain</option>
            <option value="Sri Lanka">Sri Lanka</option>
            <option value="Sudan">Sudan</option>
            <option value="Suriname">Suriname</option>
            <option value="Svalbard and Jan Mayen">Svalbard and Jan Mayen</option>
            <option value="Swaziland">Swaziland</option>
            <option value="Sweden">Sweden</option>
            <option value="Switzerland">Switzerland</option>
            <option value="Syrian Arab Republic">Syrian Arab Republic</option>
            <option value="Taiwan, Province of China">Taiwan, Province of China</option>
            <option value="Tajikistan">Tajikistan</option>
            <option value="Tanzania, United Republic of">Tanzania, United Republic of</option>
            <option value="Thailand">Thailand</option>
            <option value="Timor-leste">Timor-leste</option>
            <option value="Togo">Togo</option>
            <option value="Tokelau">Tokelau</option>
            <option value="Tonga">Tonga</option>
            <option value="Trinidad and Tobago">Trinidad and Tobago</option>
            <option value="Tunisia">Tunisia</option>
            <option value="Turkey">Turkey</option>
            <option value="Turkmenistan">Turkmenistan</option>
            <option value="Turks and Caicos Islands">Turks and Caicos Islands</option>
            <option value="Tuvalu">Tuvalu</option>
            <option value="Uganda">Uganda</option>
            <option value="Ukraine">Ukraine</option>
            <option value="United Arab Emirates">United Arab Emirates</option>
            <option value="United Kingdom">United Kingdom</option>
            <option value="United States">United States</option>
            <option value="United States Minor Outlying Islands">United States Minor Outlying Islands</option>
            <option value="Uruguay">Uruguay</option>
            <option value="Uzbekistan">Uzbekistan</option>
            <option value="Vanuatu">Vanuatu</option>
            <option value="Venezuela">Venezuela</option>
            <option value="Viet Nam">Viet Nam</option>
            <option value="Virgin Islands, British">Virgin Islands, British</option>
            <option value="Virgin Islands, U.S.">Virgin Islands, U.S.</option>
            <option value="Wallis and Futuna">Wallis and Futuna</option>
            <option value="Western Sahara">Western Sahara</option>
            <option value="Yemen">Yemen</option>
            <option value="Zambia">Zambia</option>
            <option value="Zimbabwe">Zimbabwe</option>
        </select>

</div>





<!-- Address Field -->
<div class="form-group col-sm-12 col-lg-12">
    {!! Form::label('address', 'Address:') !!}  <small id="Error_address"></small>
    <textarea class="form-control address" id="address" name="address"  cols="120" rows="2">
        {{$corpse->address}}
        </textarea>

</div>






<!-- Death Date Field -->
<div class="form-group col-sm-6">
        {!! Form::label('death_date', 'Death Date:') !!}<small id="Error_death_date"></small>
        {!! Form::date('death_date', $corpse->death_date, ['class' => 'form-control death_date','id'=>'death_date']) !!}

</div>
    @section('scripts')
    <script type="text/javascript">
        $('#death_date').datetimepicker({
            format: 'YYYY-MM-DD',
             useCurrent: true
        })
    </script>
@endsection







<div class="form-group  col-sm-6 {{$errors->has('corpse_stn_id') ? 'has-error' :''}}">
        {{Form::label('corpse_stn_id', 'Police Station :')}}       <small id="Error_corpse_stn_id">&nbsp;</small>
        <select name="corpse_stn_id" value="{{Request::old('corpse_stn_id')}}" onchange="corpse_stn()" class="form-control corpse_stn_id" >
            <option value="{{$corpse->station->id}}">{{$corpse->station->station}}</option> 
            @foreach($stations as $station)

              @if (auth()->user()->hasRole('SuperAdmin'))
                    @if ( $station->id == $corpse->station_id)
                    @else
                        <option value='{{ $station->id }}'>{{ $station->station}}</option>
                    @endif
              @else
                   @if(auth()->user()->station->division->id ==  $station->division_id )
                        @if ( $station->id == $corpse->station_id)
                        @else
                            <option value='{{ $station->id }}'>{{ $station->station}}</option>
                        @endif
                    @endif
              @endif

     @endforeach
        </select>

    </div>













    <div class="form-group  col-sm-12 ">

            <button id="CoprseSection"  class="btn btn-primary"> Next <i class="fa fa-arrow-circle-right" aria-hidden="true"></i></button>
        </div>






</div>

</div>
</span>































<span class="CoprseSection2">



<div class="well" style="background:white">
    <h4>  Corpse Section</h4>
    <div    class=" row blueBox">
            <br><br> <br>
<!-- Pickup Date Field -->
<div class="form-group col-sm-3">
    {!! Form::label('pickup_date', 'Pickup Date:') !!} <small id="Error_pickup_date"></small>
    {!! Form::date('pickup_date', $corpse->pickup_date, ['class' => 'form-control pickup_date','id'=>'pickup_date']) !!}
</div>

@section('scripts')
    <script type="text/javascript">
        $('#pickup_date').datetimepicker({
            format: 'YYYY-MM-DD',
             useCurrent: true
        })
    </script>
@endsection

<!-- Condition Field -->
<div class="form-group col-sm-3">
        {!! Form::label('condition', 'Condition:') !!} <small id="Error_condition"></small>             
            <select name="condition" value="{{Request::old('condition')}}" onchange="CorpseCondition()" class="form-control condition"  id="condition"> <small id="Error_condition"></small>
                <option value="{{$corpse->condition_id}}">{{$corpse->condition->condition}}</option>
                
                    @foreach($conditions as $condition)
                    @if ($corpse->condition_id!= $condition->id)
                    <option value='{{ $condition->id }}'>{{ $condition->condition}}</option>
                    @endif                         
                    @endforeach
           </select>

    </div>



<!-- Type Death Field -->
<div class="form-group col-sm-3">
    {!! Form::label('type_death', 'Type Death:') !!}<small id="Error_type_death"></small>
    <select name="type_death" class="form-control type_death"  onchange="typeDeath()" id="type_death">
        <option value="{{$corpse->type_death}}">{{$corpse->type_death}}</option>
            

        @if ($corpse->type_death=="Natural") 
        <option value="Unnatural">Unnatural</option>
        <option value="Unknown">Unknown</option>
        @elseif($corpse->type_death=="Unnatural") 
        <option value="Natural">Natural</option> 
        <option value="Unknown">Unknown</option>    
        @else
        <option value="Natural">Natural</option>
        <option value="Unnatural">Unnatural</option>  
        @endif 
        </select>
</div>

<!-- Manner Death Field -->
<div class="form-group col-sm-3">
    {!! Form::label('manner_death', 'Manner Death:') !!}<small id="Error_manner_death"></small>
        <select name="manner_death" class="form-control manner_death"  onchange="mannerDeath()" id="manner_death"  value="{{Request::old('manner_death')}}">  
            <option value="{{$corpse->manner_id}}">{{$corpse->manner->manner}}</option>            
             @foreach($manners as $manner_death)
                @if ($corpse->manner_id != $manner_death->id)
                <option value='{{ $manner_death->id }}'>{{ $manner_death->manner}}</option>
                @endif                   
             @endforeach
    </select>
</div>

<!-- Anatomy Field -->
<div class="form-group col-sm-3">
    {!! Form::label('anatomy', 'Anatomy:') !!}<small id="Error_anatomy"></small> 
        <select name="anatomy" class="form-control anatomy"  onchange="anotomMethod()" id="anatomy"  value="{{Request::old('anatomy')}}">  
            <option value="{{$corpse->anatomy_id}}">{{$corpse->anatomy->anatomy}}</option>            
             @foreach($anatomies as $anatomy)
                @if ($corpse->anatomy_id != $anatomy->id)
                <option value='{{ $anatomy->id }}'>{{ $anatomy->anatomy}}</option>
                @endif                    
             @endforeach
         </select>   
</div>

   <!-- Pickup Location Field -->
   <div class="form-group col-sm-9">
        {!! Form::label('pickup_location', 'Pickup Location:') !!}<small id="Error_pickup_location"></small>
        {!! Form::text('pickup_location', $corpse->pickup_location, ['class' => 'pickup_location  form-control']) !!}
    </div>







<div class="form-group col-sm-6">
    {!! Form::label('next_of_kin', 'Next of kin:') !!}<small id="Error_next_of_kin"></small>
    {!! Form::text('next_of_kin', $corpse->next_of_kin, ['class' => 'next_of_kin  form-control']) !!}
</div>


<div class="form-group col-sm-3">
    {!! Form::label('next_of_kin_contact', 'Next of kin Contact:') !!} <small id="Error_next_of_kin_contact"></small>
    <input type="text" value="{!! $corpse->next_of_kin_contact !!}" name="next_of_kin_contact" id="next_of_kin_contact" class="form-control next_of_kin_contact" onkeypress="return nextOfKinContact(event)">
</div>


<div class="form-group col-sm-3">
    {!! Form::label('next_of_kin_email', 'Next of kin Email:') !!}<small id="Error_next_of_kin_email"></small>
    {!! Form::text('next_of_kin_email', $corpse->next_of_kin_email, ['class' => 'next_of_kin_email  form-control']) !!}
</div>

<div class="form-group col-sm-12" style="background:lavender">
    <br>
    {!! Form::label('corpse_image', 'Browse unidentified Corpse\'s Image:') !!}
    {!! Form::file('corpse_image') !!} <br>
</div>
    {{-- {!! Form::file('corpse_image') !!} --}}





    <br><br>

    <div class="form-group col-sm-12">
            <button id="CoprseSectionPre"  class="btn btn-default"><i class="fa fa-arrow-circle-left" aria-hidden="true"></i> Previous</button>&emsp;<button id="io"  class="btn btn-primary"> Next <i class="fa fa-arrow-circle-right" aria-hidden="true"></i></button>
    </div>

</div>


</div><br><br><br><br><br><br>
</span>














<span class="io">

<div class="well" style="background:white">
        <h4> Investigator Section</h4>

        <div    class=" row blueBoxInvestigator">
<br><br> 

<div id="deletOutPut">
</div>
<div class="form-group col-sm-12 col-md-offet-2">
    <button class="btn btn-default btn-sm  "  id="btngetReassign" type="submit"><i class="fa fa-plus-circle" aria-hidden="true"></i> Assign new I.O</button>
     <br><br> 
       <div id="getInvest">
    
       </div>
<hr> 
    <div class="form-group col-sm-12" >
        
        <label for="exampleFormControlTextarea1">Case Summary <small class="mb-4px">Here you are required to enter the summary of the case.</small></label><span id="Error_summary"></span>
      
        <textarea   name="summary" class="form-control summary" id="summary" rows="7">{{$corpse->occurrence->summary }}</textarea> 
      
    </div>


</div>




              <div class="form-group col-sm-12">
                <button id="goback_prseSection2" class="btn btn-default"><i class="fa fa-arrow-circle-left" aria-hidden="true"></i> Previous</button>&emsp;<button  class="btn btn-primary" id="MorgueSection">Next <i class="fa fa-arrow-circle-right" aria-hidden="true"></i> </button>
             </div>
           <br>
           </div>
        </div>
           </span>




































<span class="MorgueSection">


<div class="well" style="background:white">
    <h4>  Morgue Section</h4>
     <div    class=" row blueBox"><br><br> <br>

<!-- Postmortem Status Field -->
<div class="form-group col-sm-3">
        {!! Form::label('postmortem_status', 'Postmortem Status:') !!}<small id="Error_postmortem_status"></small>
        <select name="postmortem_status" class="form-control postmortem_status" id="postmortem_status"  onchange="postmortemStatus()">
            <option value="{{$corpse->postmortem_status}}">{{$corpse->postmortem_status}}</option>  
            @if ($corpse->postmortem_status=="Not Required")
                <option value="Pending">Pending</option>
                <option value="Completed">Completed</option>
            @elseif ($corpse->postmortem_status=="Pending")    
                <option value="Not Required">Not Required</option> 
                <option value="Completed">Completed</option>
            @else
            <option value="Pending">Pending</option>
            <option value="Not Required">Not Required</option>            
            @endif                  
         </select>
    </div>

    <!-- Postmortem Date Field -->
    <div class="form-group col-sm-3">
        {!! Form::label('postmortem_date', 'Postmortem Date:') !!}<small id="Error_postmortem_date"></small>
        {!! Form::date('postmortem_date', $corpse->postmortem_date, ['class' => 'form-control postmortem_date','id'=>'postmortem_date']) !!}
    </div>

    @section('scripts')
        <script type="text/javascript">
            $('#postmortem_date').datetimepicker({
                format: 'YYYY-MM-DD',
                 useCurrent: true
            })
        </script>
    @endsection

    <!-- Funeral Home Field -->

    <div class="form-group  col-sm-3">
            {!! Form::label('body_status', ' Body Status:') !!}<small id="Error_body_status"></small>
            <select name="body_status" class="form-control body_status" id="body_status"  onchange="deadBodyStatus()">
                <option value="{{$corpse->body_status}}">{{$corpse->body_status}}</option> 
                  @if ($corpse->body_status=="Claimed")                      
                    <option value="Unclaimed">Unclaimed</option>
                  @else
                  <option value="Claimed">Claimed</option>
                  @endif              
                </select>
    </div>


    <!-- Pathlogist Field -->
    <div class="form-group col-sm-3">
        {!! Form::label('pathlogist', 'Pathlogist:') !!}<small id="Error_pathlogist"></small>
        {!! Form::text('pathlogist', $corpse->pathlogist, ['class' => 'form-control pathlogist']) !!}
    </div>
    <hr>


   <div class="form-group col-sm-3 "  >
    {!! Form::label('dr_name', 'Dr. Name:') !!}<small id="Error_dr_name"></small>
    {!! Form::text('dr_name', $corpse->dr_name, ['class' => 'dr_name  form-control']) !!}
</div>

 

<div class="form-group col-sm-3">
    {!! Form::label('dr_contact', 'Dr Contact:') !!} <small id="Error_dr_contact"></small>
    <input type="text" class=" form-control dr_contact" id="dr_contact"  value="{!! $corpse->dr_contact!!}" name="dr_contact"   onkeypress="return docContact(event)">

</div>
<hr>

    <div class="form-group  col-sm-6 {{$errors->has('funeralhome_id') ? 'has-error' :''}}">
            {!! Form::label('funeral_home', 'Funeral Home:') !!}<small id="Error_funeralhome_id"></small>
            <select name="funeralhome_id" value="{{Request::old('funeralhome_id')}}" class="form-control funeralhome_id" onchange="funeralHome()" >
                <option value="{{$corpse->funeralhome_id}}">{{$corpse->funeralhome->funeralhome}}</option> 
                          @foreach($funeralhomes as $funeralhome)
                          @if ($corpse->funeralhome_id != $funeralhome->id)
                          <option value='{{$funeralhome->id }}'>{{ $funeralhome->funeralhome}}</option> 
                          @endif  
                              
                          @endforeach
            </select>
        </div>



    <!-- Cause Of Death Field -->
    <div class="form-group col-sm-12 col-lg-12">
        {!! Form::label('cause_of_Death', 'Cause Of Death:') !!}<small id="Error_cause_of_Death"></small>
        <textarea class="form-control cause_of_Death" id="cause_of_Death" name="cause_of_Death"  cols="120" rows="4">{{$corpse->cause_of_Death}}
         </textarea>
    </div>


    <div class="form-group col-sm-12 col-lg-12">
            <button id="CoprseSection2Pre" class="btn btn-default"> <i class="fa fa-arrow-circle-left" aria-hidden="true"></i> Previous</button>&emsp;<button  class="btn btn-primary" id="adminSection">Next <i class="fa fa-arrow-circle-right" aria-hidden="true"></i> </button>
    </div>

    </div>
</div>
<br><br><br><br><br>
</span>


















<span class="adminSection">


<div class="well" style="background:white">
    <h4>  Administration Section</h4>
     <div    class=" row blueBox"><br><br>
<!-- Finger Print Field -->
<div class="form-group col-sm-3">
    {!! Form::label('finger_print', 'Finger Print:') !!} <small id="Error_finger_print"></small>
    <select name="finger_print" class="form-control finger_print" id="finger_print" onchange="fingerPrint()">
        <option value="{{$corpse->finger_print}}">{{$corpse->finger_print}}</option> 
            @if ($corpse->finger_print=="Yes")
            <option value="No">No</option>
            @else
            <option value="Yes">Yes</option>
            @endif            
        </select>
</div>

<!-- Finger Print Date Field -->
<div class="form-group col-sm-3">
    {!! Form::label('finger_print_date', 'Finger Print Date:') !!}<small id="Error_finger_print_date"></small>
    {!! Form::date('finger_print_date', $corpse->finger_print_date, ['class' => 'form-control finger_print_date','id'=>'finger_print_date']) !!}
</div>

@section('scripts')
    <script type="text/javascript">
        $('#finger_print_date').datetimepicker({
            format: 'YYYY-MM-DD',
             useCurrent: true
        })
    </script>
@endsection








<!-- Gazetted Field -->
<div class="form-group col-sm-3">
    {!! Form::label('gazetted', 'Gazetted:') !!}<small id="Error_gazetted"></small>
    <select name="gazetted" class="form-control gazetted " id="gazetted" onchange="isGazetted()">
        <option value="{{$corpse->gazetted}}">{{$corpse->gazetted}}</option>
        @if ($corpse->gazetted=="Yes")
        <option value="No">No</option>
        @else
        <option value="Yes">Yes</option>
        @endif 
    </select>
</div>

<!-- Gazetted Date Field -->
<div class="form-group col-sm-3">
    {!! Form::label('gazetted_date', 'Gazetted Date:') !!}<small id="Error_gazetted_date"></small>
    {!! Form::date('gazetted_date', $corpse->gazetted_date, ['class' => 'form-control gazetted_date','id'=>'gazetted_date']) !!}
</div>

@section('scripts')
    <script type="text/javascript">
        $('#gazetted_date').datetimepicker({
            format: 'YYYY-MM-DD',
             useCurrent: true
        })
    </script>
@endsection
<!-- Gazetted Date Field -->
<div class="form-group col-sm-3">
    {!! Form::label('volume_no', 'Volume #:') !!}<small id="Error_volume_no"></small>
    {!! Form::text('volume_no', $corpse->volume_no, [ 'placeholder'=>"132:19",'class' => 'form-control volume_no','id'=>'volume_no']) !!}
</div>

 


<div class="form-group col-sm-3">
    {!! Form::label('dna', 'DNA:') !!} <small id="Error_dna"></small>
    <select name="dna" class="form-control dna" id="dna" onchange="is_dna()">
        <option value="{{$corpse->getDna->dna}}">{{$corpse->getDna->dna}}</option>
        @if ($corpse->getDna->dna=="Yes")
        <option value="No">No</option>
        @else
        <option value="Yes">Yes</option>
        @endif 
        </select>
</div>
 
<div class="form-group col-sm-3">
    {!! Form::label('dna_date', 'DNA Request Date:') !!}<small id="Error_dna_date"></small>
    {!! Form::date('dna_date', $corpse->getDna->dna_request_date, ['class' => 'form-control dna_date','id'=>'dna_date']) !!}
</div>

@section('scripts')
    <script type="text/javascript">
        $('#dna_date').datetimepicker({
            format: 'YYYY-MM-DD',
             useCurrent: true
        })
    </script>
@endsection


 
<!-- dna_result_date Field -->
<div class="form-group col-sm-3">
    {!! Form::label('dna_result_date', 'DNA Result Date:') !!}<small id="Error_dna_result_date"></small>
    {!! Form::date('dna_result_date', $corpse->getDna->dna_result_date, [ 'class' => 'form-control dna_result_date','id'=>'dna_result_date']) !!}
</div>

@section('scripts')
    <script type="text/javascript">
        $('#dna_result_date').datetimepicker({
            format: 'YYYY-MM-DD',
             useCurrent: true
        })
    </script>
@endsection


<div class="form-group col-sm-12">
    {!! Form::label('dna_result', 'DNA Result:') !!}<small id="Error_dna_result"></small>
    {!! Form::textarea('dna_result', $corpse->getDna->dna_result,  [ 'rows'=> 4, 'class' => 'form-control dna_result','id'=>'dna_result']) !!}
  
</div>








<!-- Buried Field -->
<div class="form-group col-sm-6">
    {!! Form::label('buried', 'Buried:') !!}<small id="Error_buried"></small>
    <select name="buried" class="form-control buried"  id="buried" onchange="isBuried()">
        <option value="{{$corpse->buried}}">{{$corpse->buried}}</option>
        @if ($corpse->buried=="Yes")
        <option value="No">No</option>
        @else
        <option value="Yes">Yes</option>
        @endif 
        </select>
</div>

<!-- Burial Date Field -->
<div class="form-group col-sm-6">
    {!! Form::label('burial_date', 'Burial Date:') !!}<small id="Error_burial_date"></small>
    {!! Form::date('burial_date', $corpse->burial_date, ['class' => 'form-control burial_date','id'=>'burial_date']) !!}
</div>

@section('scripts')
    <script type="text/javascript">
        $('#burial_date').datetimepicker({
            format: 'YYYY-MM-DD',
             useCurrent: true
        })
    </script>
@endsection



    <!-- Submit Field -->
    <div class="form-group col-sm-12">
            <button id="prev_MorgueSection"  class="btn btn-default"><i class="fa fa-arrow-circle-left" aria-hidden="true"></i> Previous</button>&emsp;
            <button id="confirm"  class="btn btn-success">Confirm <i class="fa fa-check-circle-o" aria-hidden="true"></i></button>&emsp;


            <a href="{!! route('corpses.index') !!}" class="btn btn-danger">Cancel <i class="fa fa-ban" aria-hidden="true"></i></a>&emsp;
            {{-- {!! Form::submit('Save', ['class' => 'btn btn-primary']) !!} --}}
        </div>

     </div>

</div>
</span>



 <span class="confirm">
        <div class="well container" style="background: ">
             <div    class=" row blueBox ">
            <div class="styl">
                <br><br>
                <div class=" col-sm-offset-2">
                        <h2 style="color:green">You have successfully completed editing the form</h2>
                        <h3 style="color:green">Press Update to commit this entry !</h3>
                        <br><br>
                        <div class="form-group col-sm-12">
                                <button id="goBackToAdmin"  class="btn btn-lg  btn-default"> <i class="fa fa-arrow-circle-left" aria-hidden="true"></i> Previous</button>&emsp;
 
                                   <button id="editForm"   type="submit" class=" editForm editUpdate btn btn-lg btn-primary  small-box-footer   small-box-footer    btnLoaderUpdateCorpse">
                                    <i class="loading-icon fa fa-spinner fa-spin hide"></i>
                                    <span class="btn-txt"><i class="fa fa-save" aria-hidden="true"></i> Update </span>
                                   </button>
                            </div>
                </div>
        </div>
           </div>
        </div>
</span>







<input type="hidden" name="xx" id="getCorpseID" value="{{$corpse->id}}">
<input type="hidden" name="id" id="id" value="{{$corpse->id}}">










</div>
</div>


{!! Form::close() !!}
<br><br> 
</div>


























<div class="my_Modal_InvestEdit">
    <div class="Modal_InvestEdit-content">
     <div class="modal_InvestEdit-header">
       <span class="modal_InvestEdit_close">&times;</span>
       </div>
            <div class="my_Modal_InvestEdit-body">
              <div id = "Confirm_contentInvestEdit">


<div id="output">

</div>
                <div class="row" >
                    {!! Form::open(['id'=>'postEdit']) !!}
                       {{csrf_field()}}

                       <div class="form-group col-sm-12">
                        <div class="form-group col-sm-3">
                            {!! Form::label('regNum', 'Reg #:') !!}<small id="Error_regNum"></small>
                            {!! Form::number('regNum', null, ['class' => ' regNum form-control']) !!}
                        </div>


                        <!-- Rank Id Field -->
                       <div class="form-group  col-sm-3 {{$errors->has('rank_id') ? 'has-error' :''}}">
                                    {{Form::label('rank_id', 'Rank')}}<small id="Error_rank_id"></small>
                                    <select name="rank_id" value="{{Request::old('rank_id')}}" onchange="investigatorRank()" class=" rank_id form-control" >
                                            <option value="">Select a Rank</option>
                                                  @foreach($ranks as $rank)
                                                         <option value='{{$rank->id }}'>{{ $rank->rank}}</option>
                                                  @endforeach
                                    </select>
                                </div>


                     <!-- Investigator First Name Field -->
                    <div class="form-group col-sm-3">
                            {!! Form::label('investigator_first_name', 'I.O First Name:') !!}<small id="Error_investigator_first_name"></small>
                            {!! Form::text('investigator_first_name', null, ['class' => ' investigator_first_name form-control']) !!}
                        </div>

                        <!-- Investigator Last Name Field -->
                        <div class="form-group col-sm-3">
                            {!! Form::label('investigator_last_name', 'I.O Last Name:') !!} <small id="Error_investigator_last_name"></small>
                            {!! Form::text('investigator_last_name', null, ['class' => 'investigator_last_name form-control']) !!}
                        </div>


                        <!-- Assign Date Field -->
                        <div class="form-group col-sm-3">
                            {!! Form::label('assign_date', 'Assign Date:') !!}<small id="Error_assign_date"></small>
                            {!! Form::date('assign_date', null, ['class' => 'form-control assign_date','id'=>'assign_date']) !!}
                        </div>


                        @section('scripts')
                            <script type="text/javascript">
                                $('#assign_date').datetimepicker({
                                    format: 'YYYY-MM-DD',
                                     useCurrent: true
                                })
                            </script>
                        @endsection

                        <!-- Contact No Field -->
                        <div class="form-group col-sm-3">
                            {!! Form::label('contact_no', 'Contact No:') !!}<small id="Error_contact_no"></small>
                            <input type="text" name="contact_no" id="contact_no" class="contact_no form-control" onkeypress="return investigatorContact(event)" >
                        </div>



                      <div class="form-group  col-sm-6 {{$errors->has('station_id') ? 'has-error' :''}}">
                                {{Form::label('station_id', 'Station')}}<small id="Error_station_id"></small>
                                <select name="station_id" value="{{Request::old('station_id')}}" onchange="investigator_stn()" class=" station_id form-control" >
                                        <option value="">Select a Station</option>
                                              @foreach($stations as $station)
                                                     <option value='{{ $station->id }}'>{{ $station->station}}</option>
                                              @endforeach
                                </select>
                            </div>

                      </div>
                   {!! Form::close() !!}
                </div>
              <div class="form-group">
                <div class ="messageEditInvest">
               </div>

               <hr>
           <button id="btnConfirmInvestEdit" class="update" type="submit" >Update</button>  &emsp;
           <button id="btnreassign" class="btnreassign" type="submit" >Saved</button>  &emsp;
           <button id="cancelInvestEdit" onclick=" myFunction()" class = "cancelTask yes">Cancel</button> &emsp;
           {!! Form::close() !!}
      </div>

     </div>
   </div>
 </div>

<input type="hidden" name="" value="" id="updateThisInvest">


 



 
<script src="{{ asset('corpse/validation_compress.js')}}"></script>
{{-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script> --}}

<script>
$('.trigger, .slider').click(function( e) {
e.preventDefault();
$('.slider').toggleClass('close');
});
</script>

<script>

 

$('.editForm').on('click', function() {
    var $this = $(this);
  $this.button('loading');
    setTimeout(function() {
       $this.button('reset');
   }, 9000);
});



    $(document).ready(function(){

//PRE CALL METHODS
                            gender(); // REQUIRED
                            corpse_stn();

                            dateCheck("death_date");
                            middle_name=middleName("middle_name","middle_name");
                            date_of_birth("death_date","dob");

                                // IDENTIFY
                            first_name= name("first_name","first_name");
                            last_name=  name("last_name","last_name");
                            address= corpseAddress("address","address");
                            country();
                            // UN-IDENTIFY YES
                            suspected_name = suspectedName("suspected_name","suspected_name");

                            checkPickUpdate("death_date","pickup_date");
                            CorpseCondition();
                            typeDeath() ;
                            mannerDeath();
                            anotomMethod();
                            pickupLocation("pickup_location");



                            postmortemStatus(); // must come first before postmortem date esle if=t will reset the value
                            cause_of_Death= causeOfDeath("cause_of_Death");
                            postMortemDate();
                            pathlogist= pathlogistName("pathlogist");
                            funeralHome();
                            deadBodyStatus() ;
                            fingerPrint();
                            fingerPrintDate();
                            is_dna();
                            dnaDate();
                            dnaResult();
                            dnaResultDate();
                            isGazetted();
                            gazettedDate();

                            pauperBurialRequestedDate();

                            isBuried();
                            burialDate();




        /////////////////////////////////////////

                  // START

                $(".CoprseSection").slideDown();
         

 


                $("#CoprseSection").click(function(e){
                e.preventDefault();
               // HERE IS WHERE I CALL THE VALIDATION METHODS FROM THE VALIDATION FILE

                 SetUnidentifiNation("corpseCountry");//this method set the nationality of the corpse









                if ( $("#unidentified").val()=='') {
                    $(".unidentified").css("border","2px solid red");
                    $("#Error_unidentified").html("<small style='color:red'>Choose an option..</small>");
                    $("#Error_unidentified").show();
                } else {
                            gender(); // REQUIRED
                            corpse_stn();

                            dateCheck("death_date");
                            middleName("middle_name","middle_name");
                            date_of_birth("death_date","dob");

                                // IDENTIFY
                            name("first_name","first_name");
                            name("last_name","last_name");
                            corpseAddress("address","address");
                            country();

                    if (is_unidentiied()) {
                        // UN-IDENTIFY YES
                        suspected_name = suspectedName("suspected_name","suspected_name");



                    if(first_name  == false && middle_name  == false && last_name  == false && sex == true  &&
                        address==false   && corpse_stn_id ==true && dob==true && death_date ==true  ){




                            $(".CoprseSection").slideUp();
                            $(".CoprseSection2").slideDown();
                            $("#one").addClass("completed");
                        }
                    } else {

                            // // IDENTIFY
                            // name("first_name","first_name");
                            // name("middle_name","middle_name");
                            // name("last_name","last_name");
                            // corpseAddress("address","address");
                            // country();

                    if(first_name  == true && middle_name  == true && last_name  == true && sex == true && address==true &&
                         corpse_stn_id ==true && dob==true && death_date ==true ){


                        $(".CoprseSection").slideUp();
                        $(".CoprseSection2").slideDown();
                        $("#one").addClass("completed");
                        }
                    }
                }
      });




      $("#io").click(function(e){
        e.preventDefault();
            checkPickUpdate("death_date","pickup_date");
            CorpseCondition();
            typeDeath() ;
            mannerDeath();
            anotomMethod(); 
            pickup_location = pickupLocation("pickup_location");

             if ( pickup_date== true  &&  condition== true && type_death== true && manner_death== true && anatomy== true && pickup_location== true) {
                         $(".CoprseSection2").slideUp();
                         $(".io").slideDown();
                         $("#two").addClass("completed");
                 }

      });









//////// THIS MOVOVES FROM I.O SECTION TO MORGUE SECTION
      $("#goback_prseSection2").click(function(e)
      {
            e.preventDefault();
            $(".io").slideUp();
            $(".CoprseSection2").slideDown();
            $("#two").removeClass("completed");

       });



      $("#CoprseSectionPre").click(function(e){
        e.preventDefault();
        $(".CoprseSection2").slideUp();
        $(".CoprseSection").slideDown();
        $("#one").removeClass("completed");

      });


      $("#MorgueSection").click(function(e){/// MOVE TO MORGUE SECTION
         e.preventDefault();
         case_summary();
            if (summary == true) {
                    $(".io").slideUp();
                    $(".MorgueSection").slideDown();
                    $("#three").addClass("completed");
                }      


      });



      $("#CoprseSection2Pre").click(function(e){
         e.preventDefault();
         $(".MorgueSection").slideUp();
         $(".io").slideDown();
         $("#three").removeClass("completed");
      });




      $("#adminSection").click(function(e){
         e.preventDefault();
           postmortemStatus(); // must come first before postmortem date esle if=t will reset the value
           cause_of_Death= causeOfDeath("cause_of_Death");
           postMortemDate();
           pathlogist= pathlogistName("pathlogist");

           funeralHome();
           deadBodyStatus() ;

      if ( postmortem_status== true && pathlogist==true && cause_of_Death==true && postmortem_date==true && funeralhome_id==true && body_status ==true) {
        // console.log(finger_print_date  +"  "+ finger_print  +"  "+gazetted  +"  "+ gazetted_date  +"  "+pauper_burial_requested   +"  "+
        //         pauper_burial_requested_date  +"  "+
        //     "  "+buried  +"  "+burial_date);
            $(".MorgueSection").slideUp();
            $(".adminSection").slideDown();
            $("#four").addClass("completed");
      }

      });



      $("#prev_MorgueSection").click(function(e){
         e.preventDefault();
         $(".MorgueSection").slideDown();
         $(".adminSection").slideUp();
         $("#four").removeClass("completed");
      });








      $("#confirm").click(function(e){
         e.preventDefault();
            fingerPrint();
            fingerPrintDate();
            is_dna();
            dnaResultDate();
            dnaResult();
            dnaDate();
            isGazetted();
            gazettedDate();
            volumeNo();
            pauperBurialRequestedDate();

            isBuried();
            burialDate();
            //  console.log( dna_date +
            //  '  '+finger_print +"  "+finger_print_date     +"  "+gazetted  +"  "+ gazetted_date  +"  "+pauper_burial_requested   +"  "+
            //  pauper_burial_requested_date  +"  "+  buried  +"  "+burial_date);
            if ( finger_print_date == true && dna_result==true && dna_result_date==true && volume_no ==true && dna== true && dna_date==true && finger_print == true &&gazetted == true && gazetted_date == true &&   buried == true &&burial_date ==true) {

            $(".adminSection").slideUp();
            $(".confirm").slideDown();
            $("#five").addClass("completed");
         }

      });





      $("#goBackToAdmin").click(function(e){
         e.preventDefault();
         $(".adminSection").slideDown();
         $(".confirm").slideUp();
         $("#five").removeClass("completed");
      });



$('#postForm').on('submit', function(event){
        event.preventDefault();

        $(".loading-icon").removeClass("hide");
        $(".btnLoaderUpdateCorpse").attr("disabled", true);
        $(".btn-txt").text("Updating Please wait...");

        SetUnidentify("first_name");
        SetUnidentify("last_name");
        SetUnKnown("address");
        SetCauseOfDeath("cause_of_Death");
        SetPathologist("pathlogist");


        // SetRequestStatus("pauper_burial_requested");
       // SetApprovalStatus("pauper_burial_approved");
        SetBuried("buried") ;
        setDobDisable();

    var form_data =  $(this).serialize();
    $.ajax({

        url:"{{ route('corpses.editCorpse') }}",
        method:"POST",
        data:  new FormData(this),
contentType: false,
cache: false,
processData:false,
        dataType:"json",
        success:function(data)
        {
            if(data.error.length > 0)
            {

                var error_html = '';
                for(var count = 0; count < data.error.length; count++)
                {
                    error_html += '<div class="alert alert-danger">'+data.error[count]+'</div>';
                }
                
                $(".loading-icon").addClass("hide");
                $("#editForm").attr("disabled", true);
                $(".btn-txt").text("Update");
                $('#form_output').html(error_html);
                $('#postForm').attr("disabled", true);
                setTimeout(function(){
                        $('#form_output').html(''); 
                        window.location.reload();
                    }, 5000);
            }
            else
            {
                
                $(".loading-icon").addClass("hide");
                $(".btnLoaderUpdateCorpse").attr("disabled", false);
                $(".btn-txt").text("Update");

                $('#form_output').html(data.success); 

                $(".CoprseSection").slideDown();
                $(".CoprseSection2").slideUp();
                $(".MorgueSection").slideUp();
                $(".adminSection").slideUp();
                $(".io").slideUp();
                $(".confirm").slideUp();
                $(".adminSection").slideUp();

                $("#one").removeClass("completed");
                $("#two").removeClass("completed");
                $("#three").removeClass("completed");
                $("#four").removeClass("completed");
                $("#five").removeClass("completed");

               // $('# ').DataTable().ajax.reload();
            }
        }
    })
});

















    });






    </script>

   </div>


























   <script src="{{ asset('bower_components/jquery/dist/jquery-1.11.1.min.js')}}"></script>
   <script>
      $(document).ready(function() {
          var updateThisInvest=0;
          $(".task").val('');
           $("#btnreassign").hide();
           $(".update").hide();
          $(".my_Modal_InvestEdit").hide();
          getInvestigators($("#getCorpseID").val());
      //  $("#requestTimeAgo").html(timeAgo($("#pauper_burial_requested_date").val()));









      $(".update").click(function(){
         event.preventDefault();
         $("#btnreassign").hide();
           $(".update").show();
            station_id=  requireDropDown("station_id");
            investigatorRank();
            investFirstName("investigator_first_name");
            investLastName("investigator_last_name");
            contact_no=contactNum();
            regNum=regulationNum();
            
            assign_date=isfirstDateGreaterThanSecondDate("pickup_date","assign_date");
            rank_id=requireDropDown("rank_id");
           // console.log  ( rank_id ,station_id,contact_no,assign_date,investigator_last_name,investigator_first_name,regNum);
            if( station_id == true  && contact_no == true &&  assign_date == true &&
            investigator_last_name == true && investigator_first_name == true &&
            rank_id == true &&  regNum == true)
            {




               var regNum=$(".regNum").val();
               var rank_id=$(".rank_id").val();
               var investFirstNam=  $(".investigator_first_name").val();
               var investLastNam=$(".investigator_last_name").val();
               var assign_date=$(".assign_date").val();
               var contact_no=$(".contact_no").val();
               var station_id=$(".station_id").val();
               var id = $("#updateThisInvest").val();

        $.ajax({
            type: "post",
           url:"{{ route('updateInvest') }}",
            data: {
                'regNum':regNum,
                'rank_id':rank_id,
                'investigator_first_name':investFirstNam,
                'investigator_last_name':investLastNam,
                'assign_date':assign_date,
                'station_id':station_id,
                'contact_no':contact_no,
                'id':id,
                "_token": "{{ csrf_token() }}",
            },

            dataType:"json",
            success:function(data)
            {
                if(data.error.length > 0)
                {
                    var error_html = '';
                    for(var count = 0; count < data.error.length; count++)
                    {
                        error_html += '<div class="alert alert-danger">'+data.error[count]+'</div>';
                    }
                    $('#output').html(error_html);
                }
                else
                {
                        $('#output').html(data.success);
                         getInvestigators($("#getCorpseID").val());
                         $('#postEdit')[0].reset();
                        setTimeout(function(){
                        $('#output').html('');
                        $(".my_Modal_InvestEdit").hide();
                    }, 3000);


                }
            }
        })

    }


    });

















    $("#btngetReassign").click(function(){
         event.preventDefault();
         $('#postEdit')[0].reset();
         $(".my_Modal_InvestEdit").show();
         $("#btnreassign").show();
           $(".update").hide();
    });


    $("#btnreassign").click(function(){
         event.preventDefault();
            station_id=  requireDropDown("station_id");
            investigatorRank();
            investFirstName("investigator_first_name");
            investLastName("investigator_last_name");
            contact_no=contactNum();
            regNum=regulationNum();
            assign_date=isfirstDateGreaterThanSecondDate("pickup_date","assign_date");
            rank_id=requireDropDown("rank_id");
           // console.log  ( rank_id ,station_id,contact_no,assign_date,investigator_last_name,investigator_first_name,regNum);
            if( station_id == true && contact_no == true &&  assign_date == true &&
            investigator_last_name == true && investigator_first_name == true &&
            rank_id == true &&  regNum == true)
            {
               var getCorpseID=$("#getCorpseID").val();
               var regNum=$(".regNum").val();
               var rank_id=$(".rank_id").val();
               var investFirstNam=  $(".investigator_first_name").val();
               var investLastNam=$(".investigator_last_name").val();
               var assign_date=$(".assign_date").val();
               var contact_no=$(".contact_no").val();
               var station_id=$(".station_id").val();
               var id = $("#updateThisInvest").val();

        $.ajax({
            type: "post",
             url:"{{ route('reassign') }}",
            data: {
                'regNum':regNum,
                'rank_id':rank_id,
                'investigator_first_name':investFirstNam,
                'investigator_last_name':investLastNam,
                'assign_date':assign_date,
                'station_id':station_id,
                'contact_no':contact_no,
                'corpse_id':getCorpseID,
                "_token": "{{ csrf_token() }}",
            },

            dataType:"json",
            success:function(data)
            {
                if(data.error.length > 0)
                {
                    var error_html = '';
                    for(var count = 0; count < data.error.length; count++)
                    {
                        error_html += '<div class="alert alert-danger">'+data.error[count]+'</div>';
                    }
                    $('#output').html(error_html);
                    setTimeout(function(){
                        $('#output').html('');
                        $("#btnreassign").hide();                       
                        $(".my_Modal_InvestEdit").hide();
                        
                    }, 5000);
                }
                else
                {

                        $('#output').html(data.success);
                         getInvestigators($("#getCorpseID").val());
                         $('#postEdit')[0].reset();                        
                        setTimeout(function(){
                        $('#output').html('');
                        $("#btnreassign").hide();                      
                        $(".my_Modal_InvestEdit").hide();
                    
                    }, 3000);
                }
            }
        })

    }


    });












 $(".modal_InvestEdit_close").click(function()
       {
           $("#btnreassign").hide();
           $(".update").hide();
           $(".my_Modal_InvestEdit").hide();
           $('#postEdit')[0].reset();
      });





});







      function myFunction()
          {
            $("#btnreassign").hide();
           $(".update").hide();
          var r = confirm(" Are you Sure ?");
          if (r == true) {
            $('#postEdit')[0].reset();
            $(".my_Modal_InvestEdit").hide();
            $('#btnreassign')[0].reset();
              if($(".investigator_first_name").val() !=''&&  $(".investigator_last_name").val() !='')
                {
                  alert("Your action did not Commit!");
                }

          }
          }



       function  getEditInvest_id(getEdit_id){

                    $.ajax({
                        type: "post",
                        url:"{{ route('getEditInvest_id') }}",
                        data: {
                        'corpse_id':getEdit_id,
                        "_token": "{{ csrf_token() }}",
                        },
                        dataType: "json",
                        success:function(data){
                            $.each(data, function(i, item) {
                            $(".update").show();
                            $("#updateThisInvest").val(item.id );
                            $(".regNum").val(item.regNum );
                            $(".rank_id").val(item.rank_id );
                            $(".investigator_first_name").val(item.investigator_first_name);
                            $(".investigator_last_name").val(item.investigator_last_name);
                            $(".assign_date").val(item.assign_date);
                            $(".contact_no").val(item.contact_no);
                            $(".station_id").val(item.station_id);
                            $(".my_Modal_InvestEdit").show();
                        });

                        }

                });
        }












function getInvestigators(corpse_id) {
var container= $("#getInvestigator");
  $.ajax({
  type: "post",
  url:"{{ route('getInvestigator') }}",
  data: {
  'corpse_id':corpse_id,
  "_token": "{{ csrf_token() }}",
  },
  dataType: "json",
  success:function(data){


    $("#getInvest").html(data);
            //   $.each(data, function(i, item) {
            //       $("#getInvest").append('<h5> No.'+item.regNum+' '+item.rank+' '+item.regNum+' '+item.investigator_first_name+' '+item.investigator_last_name+' stationed at '+item.station+' '+item.regNum+'</a>  </h5>');
            //   });
            //    $("#getInvestigator").append('<br>');

     }

     });   // $("#getInvestigator").html(data);///.delay(3000).fadeOut();
  }




  function deleteInvestigator(id) {

  $.ajax({
  type: "post",
  url:"{{ route('deleteInvestigator') }}",
  data: {
  'id': id,
  "_token": "{{ csrf_token() }}",
  },
  dataType: "json",
  success:function(data){

    if(data.error.length > 0)
                {
                    var error_html = '';
                    for(var count = 0; count < data.error.length; count++)
                    {
                        error_html += '<div class="alert alert-danger">'+data.error[count]+'</div>';
                    }
                    $('#deletOutPut').html(error_html);
                }
                else
                {
                        $('#deletOutPut').html(data.success);
                         getInvestigators($("#getCorpseID").val());

                        setTimeout(function(){
                        $('#deletOutPut').html('');

                    }, 3000);
                }


       }

     });
  }













     </script>

@endsection
