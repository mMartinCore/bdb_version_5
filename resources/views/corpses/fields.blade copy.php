<div class="container"  >

        <div class="container" >



        <style>
     .blueBox {
  -webkit-box-sizing: content-box;
  -moz-box-sizing: content-box;
  box-sizing: content-box;
  margin: 10px;
  height: 400px;
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















<span class="CoprseSection">

        <div class="well col-sm-12" style="background:white">
        <h4>  Corpse Section</h4>
        <div    class=" row blueBox  ">
            <br><br>
         <!-- Unidentified Field -->
<div class="form-group col-sm-3">
        {!! Form::label('unidentified', 'Unidentified:') !!}<small id="Error_unidentified"></small>
        <select name="unidentified" class="form-control unidentified" onchange="is_unidentiied()" id="unidentified">
                <option value="">Select an Option</option>
                <option value="Yes">Yes</option>
                <option value="No">No</option>
            </select>

    </div>

    <!-- First Name Field -->
    <div class="form-group   col-sm-3">
        {!! Form::label('first_name', 'First Name:') !!} <small id="Error_first_name"></small>
        {!! Form::text('first_name', null, ['class' => 'form-control first_name']) !!}

    </div>



    <!-- Middle Name Field -->
    <div class="form-group col-sm-3">
        {!! Form::label('middle_name', 'Middle Name:') !!} <small id="Error_middle_name"></small>
        {!! Form::text('middle_name', null, ['class' => 'form-control middle_name']) !!}

    </div>

       <!-- Last Name Field -->
       <div class="form-group col-sm-3">
        {!! Form::label('last_name', 'Last Name:') !!} <small id="Error_last_name"></small>
        {!! Form::text('last_name', null, ['class' => 'form-control last_name ']) !!}

    </div>


    <div class="form-group col-sm-3">
        {!! Form::label('suspected_name', 'Account Alias:') !!} <small id="Error_suspected_name"></small>
        {!! Form::text('suspected_name', null, ['class' => 'form-control suspected_name']) !!}

    </div>

    <!-- Dob Field -->
    <div class="form-group col-sm-3">
        {!! Form::label('dob', 'Date of Birth:') !!}  <small id="Error_dob"></small>
        {!! Form::date('dob', null, ['class' => 'form-control dob','id'=>'dob']) !!}

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
                <option value="">Select a Gender</option>
                <option value="Male">Male</option>
                <option value="Female">Female</option>
                <option value="Unknown">Unknown</option>
            </select>

    </div>

    <!-- Nationality Field -->
    <input type="hidden" name="nationality" id="nationality">
    <div class="form-group col-sm-3">
        {!! Form::label('corpseCountry', 'Country of Nationality:') !!} <small id="Error_corpseCountry"></small>
        <select name="corpseCountry" class="form-control corpseCountry" onchange="country()" id="corpseCountry" >
                <option value="">Select a Country </option>
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
            </textarea>

    </div>









<input type="hidden"  id="cr_no">

                        <div class="form-group col-xs-2">
                            {!! Form::label('diary_no', 'Diary Entry No:') !!} <small id="Error_diary_no"></small>
                            <input type="text" name="diary_no" class='form-control diary_no' onkeypress="return isNumberKey(event)" >


                        </div>

                            <div class="form-group col-xs-2">
                                {!! Form::label('entry_date', 'Entry Date:') !!}<small id="Error_entry_date"></small>
                                {!! Form::date('entry_date', null, ['class' => 'form-control entry_date','id'=>'entry_date']) !!}

                           </div>
                            @section('scripts')
                            <script type="text/javascript">
                                $('#entry_date').datetimepicker({
                                    format: 'YYYY-MM-DD',
                                    useCurrent: true
                                })
                            </script>
                        @endsection

                        <div class="form-group col-xs-3">
                            {!! Form::label('diary_type', 'Diary Type :') !!}<small id="Error_diary_type"></small>
                            <select name="diary_type" class="form-control diary_type" id="diary_type" onchange="diaryType();">
                                    <option value="">Select an Option</option>
                                    <option value="SDR">Sudden Death Register</option>
                                    <option value="SD">Station Diary</option>
                                    <option value="CD">Crime Diary</option>
                                </select>
                        </div>

                        <div class="form-group  col-xs-3 {{$errors->has('corpse_stn_id') ? 'has-error' :''}}">
                                {{Form::label('corpse_stn_id', 'Police Station :')}}       <small id="Error_corpse_stn_id">&nbsp;</small>
                                <select name="corpse_stn_id" value="{{Request::old('corpse_stn_id')}}" onchange="corpse_stn()" class="form-control corpse_stn_id" >
                                        <option value="">Select a Station</option>
                                            @foreach($stations as $station)
                                                    <option value='{{ $station->id }}'>{{ $station->station}}</option>
                                            @endforeach
                                </select>

                            </div>










    <!-- Death Date Field -->
    <div class="form-group col-sm-2">
        {!! Form::label('death_date', 'Death Date:') !!}<small id="Error_death_date"></small>
        {!! Form::date('death_date', null, ['class' => 'form-control death_date','id'=>'death_date']) !!}

    </div>
    @section('scripts')
    <script type="text/javascript">
        $('#death_date').datetimepicker({
            format: 'YYYY-MM-DD',
            useCurrent: true
        })
    </script>
    @endsection

<br>

        <div class="form-group  col-sm-12 ">

                <button id="CoprseSection"  class="btn btn-primary">Next <i class="fa fa-arrow-circle-right" aria-hidden="true"></i> </button>

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
        {!! Form::date('pickup_date', null, ['class' => 'form-control pickup_date','id'=>'pickup_date']) !!}
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
                <option value="">Select a Option</option>
                    @foreach($conditions as $condition)
                            <option value='{{ $condition->id }}'>{{ $condition->condition}}</option>
                    @endforeach
           </select>
    </div>
   

    <!-- Type Death Field -->
    <div class="form-group col-sm-3">
        {!! Form::label('type_death', 'Type Death:') !!}<small id="Error_type_death"></small>
        <select name="type_death" class="form-control type_death"  onchange="typeDeath()" id="type_death">
                <option value="">Select an Option</option>
                <option value="Natural">Natural</option>
                <option value="Unnatural">Unnatural</option>
                <option value="Unknown">Unknown</option>
            </select>
    </div>

    <!-- Manner Death Field -->
 
    <div class="form-group col-sm-3">
        {!! Form::label('manner_death', 'Manner Death:') !!}<small id="Error_manner_death"></small>
        <select name="manner_death" class="form-control manner_death"  onchange="mannerDeath()" id="manner_death"  value="{{Request::old('manner_death')}}">  
               <option value="">Select a Option</option>
                @foreach($manners as $manner_death)
                        <option value='{{ $manner_death->id }}'>{{ $manner_death->manner}}</option>
                @endforeach
       </select>
</div>










    <!-- Anatomy Field -->
    <div class="form-group col-sm-3">
        {!! Form::label('anatomy', 'Anatomy:') !!}<small id="Error_anatomy"></small>
        <select name="anatomy" class="form-control anatomy"  onchange="anotomMethod()" id="anatomy"  value="{{Request::old('anatomy')}}">  
            <option value="">Select a Option</option>
             @foreach($anatomies as $anatomy)
                     <option value='{{ $anatomy->id }}'>{{ $anatomy->anatomy}}</option>
             @endforeach
         </select>        



    </div>

       <!-- Pickup Location Field -->
       <div class="form-group col-sm-9">
            {!! Form::label('pickup_location', 'Pickup Location:') !!}<small id="Error_pickup_location"></small>
            {!! Form::text('pickup_location', null, ['class' => 'pickup_location  form-control']) !!}
        </div>



        <div class="form-group col-sm-3">
            {!! Form::label('next_of_kin', 'Next of kin:') !!}<small id="Error_next_of_kin"></small>
            {!! Form::text('next_of_kin', null, ['class' => 'next_of_kin  form-control']) !!}
        </div>


        <div class="form-group col-sm-3">
            {!! Form::label('next_of_kin_contact', 'Next of kin Contact:') !!} <small id="Error_next_of_kin_contact"></small>
            <input type="text"  name="next_of_kin_contact" id="next_of_kin_contact" class="form-control next_of_kin_contact" onkeypress="return nextOfKinContact(event)">

        </div>


        <div class="form-group col-sm-3">
            {!! Form::label('next_of_kin_email', 'Next of kin Email:') !!}<small id="Error_next_of_kin_email"></small>
            {!! Form::text('next_of_kin_email', null, ['class' => 'next_of_kin_email  form-control']) !!}
        </div>

        <div class="form-group col-sm-12" style="background:lavender">
            <br>
            {!! Form::label('image', 'Browse unidentified Corpse\'s Image:') !!}
           <input type="file" name="corpse_image" id="corpse_image"> <br>
        </div>




        <br><br>

        <div class="form-group col-sm-12">
                <button id="CoprseSectionPre"  class="btn btn-default"> <i class="fa fa-arrow-circle-left" aria-hidden="true"></i> Previous</button>&emsp;<button id="io"  class="btn btn-primary">Next <i class="fa fa-arrow-circle-right" aria-hidden="true"></i></button>
        </div>

</div>


 </div><br><br><br><br><br><br>
</span>














<span class="io">

    <div class="well" style="background:white">
            <h4> Investigator Section</h4>

            <div    class=" row blueBox">
<br><br> <br>
                <!-- Regnum Field -->
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
                      <input type="text" name="contact_no" id="contact_no" class="contact_no form-control"  onkeypress="return investigatorContact(event)" >
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





                  <br><br>
                  <div class="form-group col-sm-12">
                    <button id="goback_prseSection2" class="btn btn-default"><i class="fa fa-arrow-circle-left" aria-hidden="true"></i> Previous</button>&emsp;<button  class="btn btn-primary" id="MorgueSection">Next <i class="fa fa-arrow-circle-right" aria-hidden="true"></i></button>
                 </div>
               <br><br>
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
                    <option value="">Select an Option</option>
                    <option value="Not Required">Not Required</option>
                    <option value="Pending">Pending</option>
                    <option value="Completed">Completed</option>
                </select>
        </div>

        <!-- Postmortem Date Field -->
        <div class="form-group col-sm-3">
            {!! Form::label('postmortem_date', 'Postmortem Date:') !!}<small id="Error_postmortem_date"></small>
            {!! Form::date('postmortem_date', null, ['class' => 'form-control postmortem_date','id'=>'postmortem_date']) !!}
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
                        <option value="">Select an Option</option>
                        <option value="Unclaimed">Claimed</option>
                        <option value="Unclaimed">Unclaimed</option>
                    </select>
        </div>


        <!-- Pathlogist Field -->
        <div class="form-group col-sm-3">
            {!! Form::label('pathlogist', 'Pathlogist:') !!}<small id="Error_pathlogist"></small>
            {!! Form::text('pathlogist', null, ['class' => 'form-control pathlogist']) !!}
        </div>


        <div class="form-group col-sm-3">
            {!! Form::label('dr_name', 'Dr. Name:') !!}<small id="Error_dr_name"></small>
            {!! Form::text('dr_name', null, ['class' => 'dr_name  form-control']) !!}
        </div>



        <div class="form-group col-sm-3">
            {!! Form::label('dr_contact', 'Dr Contact:') !!} <small id="Error_dr_contact"></small>
            <input type="text" class=" form-control dr_contact" id="dr_contact"  name="dr_contact"   onkeypress="return docContact(event)">
        </div>


        <div class="form-group  col-sm-12 {{$errors->has('funeralhome_id') ? 'has-error' :''}}">
                {!! Form::label('funeral_home', 'Funeral Home:') !!}<small id="Error_funeralhome_id"></small>
                <select name="funeralhome_id" value="{{Request::old('funeralhome_id')}}" class="form-control funeralhome_id" onchange="funeralHome()" >
                        <option value="">Select a Funeral Home </option>
                              @foreach($funeralhomes as $funeralhome)
                                     <option value='{{$funeralhome->id }}'>{{ $funeralhome->funeralhome}}</option>
                              @endforeach
                </select>
            </div>



        <!-- Cause Of Death Field -->
        <div class="form-group col-sm-12 col-lg-12">
            {!! Form::label('cause_of_Death', 'Cause Of Death:') !!}<small id="Error_cause_of_Death"></small>
            <textarea class="form-control cause_of_Death" id="cause_of_Death" name="cause_of_Death"  cols="120" rows="2">
             </textarea>
        </div>


        <div class="form-group col-sm-12 col-lg-12">
                <button id="CoprseSection2Pre" class="btn btn-default"><i class="fa fa-arrow-circle-left" aria-hidden="true"></i> Previous</button>&emsp;<button  class="btn btn-primary" id="adminSection">Next <i class="fa fa-arrow-circle-right" aria-hidden="true"></i> </button>
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
                <option value="">Select an Option</option>
                <option value="Yes">Yes</option>
                <option value="No">No</option>
            </select>
    </div>

    <!-- Finger Print Date Field -->
    <div class="form-group col-sm-3">
        {!! Form::label('finger_print_date', 'Finger Print Date:') !!}<small id="Error_finger_print_date"></small>
        {!! Form::date('finger_print_date', null, ['class' => 'form-control finger_print_date','id'=>'finger_print_date']) !!}
    </div>

    @section('scripts')
        <script type="text/javascript">
            $('#finger_print_date').datetimepicker({
                format: 'YYYY-MM-DD',
                useCurrent: true
            })
        </script>
    @endsection






    <div class="form-group col-sm-3">
        {!! Form::label('dna', 'DNA:') !!} <small id="Error_dna"></small>
        <select name="dna" class="form-control dna" id="dna" onchange="is_dna()">
                <option value="">Select an Option</option>
                <option value="Yes">Yes</option>
                <option value="No">No</option>
            </select>
    </div>

    <!-- Finger Print Date Field -->
    <div class="form-group col-sm-3">
        {!! Form::label('dna_date', 'DNA Date:') !!}<small id="Error_dna_date"></small>
        {!! Form::date('dna_date', null, ['class' => 'form-control dna_date','id'=>'dna_date']) !!}
    </div>

    @section('scripts')
        <script type="text/javascript">
            $('#dna_date').datetimepicker({
                format: 'YYYY-MM-DD',
                useCurrent: true
            })
        </script>
    @endsection

    <!-- Gazetted Field -->
    <div class="form-group col-sm-3">
        {!! Form::label('gazetted', 'Gazetted:') !!}<small id="Error_gazetted"></small>
        <select name="gazetted" class="form-control gazetted " id="gazetted" onchange="isGazetted()">
                <option value="">Select an Option</option>
                <option value="Yes">Yes</option>
                <option value="No">No</option>
        </select>
    </div>

    <!-- Gazetted Date Field -->
    <div class="form-group col-sm-3">
        {!! Form::label('gazetted_date', 'Gazetted Date:') !!}<small id="Error_gazetted_date"></small>
        {!! Form::date('gazetted_date', null, ['class' => 'form-control gazetted_date','id'=>'gazetted_date']) !!}
    </div>

    @section('scripts')
        <script type="text/javascript">
            $('#gazetted_date').datetimepicker({
                format: 'YYYY-MM-DD',
                useCurrent: true
            })
        </script>
    @endsection



            <!-- Pauper Burial Requested Field -->
            <div class="form-group col-sm-6">
                {!! Form::label('pauper_burial_requested', 'Pauper Burial Request:') !!}<small id="Error_pauper_burial_requested"></small>
                <select name="pauper_burial_requested" class="form-control pauper_burial_requested" id="pauper_burial_requested" onchange="pauperBurialRequested()">
                    <option value="">Select an Option</option>
                    <option value="Yes">Yes</option>
                    <option value="No">No</option>
                </select>

            </div>










    <!-- Buried Field -->
    <div class="form-group col-sm-3">
        {!! Form::label('buried', 'Buried:') !!}<small id="Error_buried"></small>
        <select name="buried" class="form-control buried"  id="buried" onchange="isBuried()">
                <option value="">Select an Option</option>
                <option value="Yes">Yes</option>
                <option value="No">No</option>
            </select>
    </div>

    <!-- Burial Date Field -->
    <div class="form-group col-sm-3">
        {!! Form::label('burial_date', 'Burial Date:') !!}<small id="Error_burial_date"></small>
        {!! Form::date('burial_date', null, ['class' => 'form-control burial_date','id'=>'burial_date']) !!}
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
                <button id="prev_MorgueSection"  class="btn btn-default">Previous</button>&emsp;
                <button id="confirm"  class="btn btn-success">Confirm <i class="fa fa-check-circle-o" aria-hidden="true"></i> </button>&emsp;
                <a href="{!! route('corpses.index') !!}" class="btn btn-danger">Cancel <i class="fa fa-ban" aria-hidden="true"></i></a>&emsp;
                {{-- {!! Form::submit('Save', ['class' => 'btn btn-primary']) !!} --}}
            </div>

         </div>

</div>
</span>














     <span class="confirm">
            <div class="well" style="background: ">
                 <div    class=" row blueBox ">
                <div class="styl">
                    <br><br>
                    <div class="container col-sm-offset-2">
                            <h2 style="color:green">You have successfully Completed the form</h2>
                            <h3 style="color:green">Press save to commit this entry !</h3>
                            <br><br>
                            <div class="form-group col-sm-12">
                                    <button id="goBackToAdmin"  class="btn btn-lg  btn-default"><i class="fa fa-arrow-circle-left" aria-hidden="true"></i>Previous</button>&emsp;

               
              <button id="postForm"   type="submit" class=" postForm btn btn-lg btn-primary  small-box-footer   small-box-footer    btn_save_loader">
                <i class="loading-icon fa fa-spinner fa-spin hide"></i>
                <span class="btn-txt"><i class="fa fa-save" aria-hidden="true"></i> Save </span>
               </button>

                                </div>
                    </div>
            </div>
               </div>
            </div>
    </span>


















</div>
</div>
<br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br>
</div>
<script src="{{ asset('corpse/sec2validation.js')}}"></script>
<script src="{{ asset('corpse/validation.js')}}"></script>

<script>
$('.trigger, .slider').click(function( e) {
    e.preventDefault();
    $('.slider').toggleClass('close');
  });
</script>

<script>










$('.postForm').on('click', function() {
    var $this = $(this);
  $this.button('loading');
    setTimeout(function() {
       $this.button('reset');
   }, 9000);
});



        $(document).ready(function(){



                      // START
                    $(".io").slideUp();
                    $(".CoprseSection").slideDown();
                    $(".CoprseSection2").slideUp();
                    $(".MorgueSection").slideUp();
                    $(".adminSection").slideUp();
                    $(".confirm").slideUp();
                    $(".adminSection").slideUp();
                    $(".cause_of_Death").val('');



                    ////////////////////////////////


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


                            middle_name =  middleName("middle_name","middle_name");
                            dob=  date_of_birth("death_date","dob");
                            death_date  =    secondDateMustGrater("dob","death_date");

                                // IDENTIFY
                            name("first_name","first_name");
                            name("last_name","last_name");
                            address=    corpseAddress("address","address");
                            country();
                            diaryType();
                            diaryNo();

                            entryDate();
                            checkUniqueCrNo();
                        if (is_unidentiied()) {
                            // UN-IDENTIFY YES
                             suspected_name = suspectedName("suspected_name","suspected_name");
                              diaryType();
                              diaryNo();
                              death_date  =    secondDateMustGrater("dob","death_date");
                              entryDate();
                              checkUniqueCrNo();
                        if(   isCrNoUnique==true && first_name  == false && middle_name  == false && last_name  == false && sex == true  &&
                            address==false && corpse_stn_id ==true && dob==true && death_date ==true  && diary_type ==true && diary_no ==true && entry_date ==true ){




                                $(".CoprseSection").slideUp();
                                $(".CoprseSection2").slideDown();
                                address= corpseAddress("address","address");
                            }
                        } else {
                                address=    corpseAddress("address","address");

                        if( isCrNoUnique==true && first_name  == true && middle_name  == true && last_name  == true && sex == true && address==true &&
                             corpse_stn_id ==true && dob==true && death_date ==true   && diary_type ==true && diary_no ==true && entry_date ==true ){

                            $(".CoprseSection").slideUp();
                            $(".CoprseSection2").slideDown();
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
                pickupLocation("pickup_location");

                 if ( pickup_date== true && condition== true && type_death== true && manner_death== true && anatomy== true && pickup_location== true) {

                             $(".CoprseSection2").slideUp();
                             $(".io").slideDown();
                     }

          });









//////// THIS MOVOVES FROM I.O SECTION TO MORGUE SECTION
          $("#goback_prseSection2").click(function(e)
          {
                e.preventDefault();
                $(".io").slideUp();
                $(".CoprseSection2").slideDown();

           });



          $("#CoprseSectionPre").click(function(e){
            e.preventDefault();
            $(".CoprseSection2").slideUp();
            $(".CoprseSection").slideDown();

          });


          $("#MorgueSection").click(function(e){/// MOVE TO MORGUE SECTION
             e.preventDefault();

             investigator_stn();
                investigatorRank();
                investFirstName("investigator_first_name");
                investLastName("investigator_last_name");
                contactNum();
                regulationNum();
                isfirstDateGreaterThanSecondDate("pickup_date","assign_date");
                if( station_id == true && contact_no == true &&  assign_date == true &&
                investigator_last_name == true && investigator_first_name == true &&
                rank_id == true &&  regNum == true)
                {

                    $(".io").slideUp();
                    $(".MorgueSection").slideDown();

                }


          });



          $("#CoprseSection2Pre").click(function(e){
             e.preventDefault();
             $(".MorgueSection").slideUp();
             $(".io").slideDown();
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

                $(".MorgueSection").slideUp();
                $(".adminSection").slideDown();
          }

          });



          $("#prev_MorgueSection").click(function(e){
             e.preventDefault();
             $(".MorgueSection").slideDown();
             $(".adminSection").slideUp();
          });








          $("#confirm").click(function(e){
             e.preventDefault();
                fingerPrint();
                fingerPrintDate();
                is_dna();
                dnaDate();
                isGazetted();
                gazettedDate();
                pauperBurialRequested();

                isBuried();
                burialDate();

                if ( finger_print_date == true && dna== true && dna_date==true && finger_print == true &&gazetted == true && gazetted_date == true &&pauper_burial_requested  == true &&
                buried == true &&burial_date ) {

                $(".adminSection").slideUp();
                $(".confirm").slideDown();
             }

          });





          $("#goBackToAdmin").click(function(e){
             e.preventDefault();
             $(".adminSection").slideDown();
             $(".confirm").slideUp();
          });



  $('#postForm').on('submit', function(event){
         event.preventDefault();





        SetUnidentify("first_name");
        SetUnidentify("last_name");
        SetUnKnown("address");
        SetCauseOfDeath("cause_of_Death");
        SetPathologist("pathlogist");
        SetRequestStatus("pauper_burial_requested") ;
        SetApprovalStatus("pauper_burial_approved");
        SetBuried("buried") ;
        setDobDisable();
 
        $(".loading-icon").removeClass("hide");
        $(".btn_save_loader").attr("disabled", true);
        $(".btn-txt").text("Saving Please wait...");

        var form_data = $(this).serialize();
        $.ajax({
            url:"{{ route('corpses.postdata') }}",
            method:"POST",
            data:  new FormData(this),
            contentType: false,
            cache: false,
            processData:false,
            dataType:"json",
            success:function(data)
            {
                $(".loading-icon").addClass("hide");
                $(".btn_save_loader").attr("disabled", false);
                $(".btn-txt").text("Save"); 
                if(data.error.length > 0)
                { 
                    var error_html = '';
                    for(var count = 0; count < data.error.length; count++)
                    {
                        error_html += '<div class="alert alert-danger">'+data.error[count]+'</div>';
                    }
                    $('#form_output').html(error_html);
               
                }
                else
                {                         
                    $('#form_output').html(data.success);
                    $('#postForm')[0].reset();
                    $(".CoprseSection").slideDown();
                    $(".CoprseSection2").slideUp();
                    $(".MorgueSection").slideUp();
                    $(".adminSection").slideUp();
                    $(".io").slideUp();
                    $(".confirm").slideUp();
                    $(".adminSection").slideUp(); 

                   // $('# ').DataTable().ajax.reload();
                }
            }
        })
    });

















        });






function checkUniqueCrNo() {
    
        var diary_no=$(".diary_no").val();
        var entry_date=$(".entry_date").val();
        var diary_type=$(".diary_type").val();
        var stn_id=$('.corpse_stn_id').val();
        var urlx =window.location.protocol+"//"+window.location.hostname;
           if (diary_no !=''&& stn_id!=''&& entry_date !='' && diary_type!='' ) {

                        $.ajax({
                        url:"http://127.0.0.1:8000/checkUniqueCrNo",
                        method:"POST",
                        data: {
                            'diary_no':diary_no,
                            'entry_date':entry_date,
                            'diary_type':diary_type,
                            'stn_id':stn_id,
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
                                isCrNoUnique=false;
                                $('#output').html(error_html);
                                setTimeout(function(){
                                    $('#output').html('');
                                },7000);

                            }
                            else
                            {
                                    isCrNoUnique=true;
                                    $('#output').html(data.success);
                                    setTimeout(function(){
                                    $('#output').html('');
                                }, 7000);


                            }
                        }
                    })

           }

    }























        </script>

