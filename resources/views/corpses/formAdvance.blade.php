











<div class="box-body ">

    {!! Form::open([ 'class'=>'opendForm2']) !!}
    {{csrf_field()}}
    <div class="row">

        <div class="col col-sm-12">
            <div class="col col-sm-2">
                    <small> <Label>Is Unidentified</Label></small>
                    <select name="unidentified" class="form-control unidentified"  id="unidentified">
                            <option value="">Is unidentified</option>
                            <option value="Yes">Yes</option>
                            <option value="No">No</option>
                         </select>
                    </div>
            <div class="col col-sm-2">
                    <small> <Label>Gender</Label></small>
                        <select name="sex" class="form-control sex"   id="sex">
                                <option value="">Select a Gender</option>
                                <option value="Male">Male</option>
                                <option value="Female">Female</option>
                                <option value="Unknown">Unknown</option>
                            </select>

              </div>
              <div class="col col-sm-2">
                    <small> <Label>First Name</Label></small>
                <input class="form-control input-sm" name="first_name" type="text" placeholder="First Name">
              </div>
              <div class="col col-sm-2">
                    <small> <Label>Middle Name</Label></small>
                <input class="form-control input-sm" name="middle_name"  type="text" placeholder="Middle Name">
              </div>
              <div class="col col-sm-2">
                <small> <Label>Last Name</Label></small>
            <input class="form-control input-sm" name="last_name"  type="text" placeholder="Last Name">
          </div>
          <div class="col col-sm-2">
            <small> <Label>Account Alias:</Label></small>
        <input class="form-control input-sm" name="suspected_name"  type="text" placeholder="Account Alias:">
      </div>
          </div>
      </div>
      <br>
      <div class="row">
        <div class="col col-sm-12">
            <div class=" col col-sm-2">
                    <small> <Label>Pick Up Date</Label></small>
               <div class='input-group' >
                <input class="form-control input-sm" type="date" name="pickup_date" id="pickup_date" placeholder="Pick-up Date">
                <span class="input-group-addon">
                    <span class="fa fa-calendar">
                    </span>
                </span>
               </div>
                @section('scripts')
                <script type="text/javascript">
                    $('#pickup_date').datetimepicker({
                        format: 'YYYY-MM-DD',
                        useCurrent: false
                    })
                </script>
            @endsection
            </div>
              <div class="col col-sm-2">
                    <small> <Label>Date Of Death</Label></small>
                    <div class='input-group' >
                        <input class="form-control input-sm" type="date" name="death_date" id="death_date" placeholder="Date of Death">
                        <span class="input-group-addon">
                    <span class="fa fa-calendar">
                    </span>
                </span>
                    </div>
                @section('scripts')
                <script type="text/javascript">
                    $('#death_date').datetimepicker({
                        format: 'YYYY-MM-DD',
                        useCurrent: false
                    })
                </script>
            @endsection
              </div>
              <div class="col col-sm-2">
                    <small> <Label>Postmortem Date</Label></small>
             <div class='input-group' >
                <input class="form-control input-sm" type="date" name="postmortem_date" id="postmortem_date" placeholder="Postmortem Date">
                <span class="input-group-addon">
                    <span class="fa fa-calendar">
                    </span>
                </span>
             </div>
                @section('scripts')
                <script type="text/javascript">
                    $('#postmortem_date').datetimepicker({
                        format: 'YYYY-MM-DD',
                        useCurrent: false
                    })
                </script>
            @endsection
              </div>
              <div class="col col-sm-2">
                    <small> <Label>Burial Date</Label></small>
             <div class='input-group' >
                <input class="form-control input-sm" type="date" name="burial_date" id="burial_date" placeholder="Burial Date">
                <span class="input-group-addon">
                    <span class="fa fa-calendar">
                    </span>
                </span>
             </div>
                @section('scripts')
                <script type="text/javascript">
                    $('#burial_date').datetimepicker({
                        format: 'YYYY-MM-DD',
                        useCurrent: false
                    })
                </script>
            @endsection
              </div>


              <div class="form-group col-sm-2">
                <small> <Label>Buried</Label></small>

                <select name="buried" class="form-control buried"  id="buried"  >
                        <option value="">Select an Option</option>
                        <option value="Yes">Yes</option>
                        <option value="No">No</option>
                    </select>
            </div>


              <div class="col col-sm-2">
                    <small> <Label>Parish</Label></small>
                    <select name="parish"   class="form-control parish"  >
                        <option value="">Select a Funeral Home </option>
                              @foreach($parishes as $parish)
                                     <option value='{{$parish->id }}'>{{ $parish->parish}}</option>
                              @endforeach
                </select>

              </div>


          </div>
      </div>

      <br>

      <div class="row">
            <div class="col col-sm-12">
                <div class="col col-sm-2">
                        <small> <Label>Furneral Home</Label></small>
                                <select name="funeralhome_id"   class="form-control funeralhome_id"  >
                                        <option value="">Select a Funeral Home </option>
                                              @foreach($funeralhomes as $funeralhome)
                                                     <option value='{{$funeralhome->id }}'>{{ $funeralhome->funeralhome}}</option>
                                              @endforeach
                                </select>
                            </div>


                            <div class="form-group col-sm-2">

                                <small> <Label>Request Status</Label></small>
                                <select name="pauper_burial_approved" class="form-control pauper_burial_approved"   >
                                    <option value="">Select an Option</option>
                                    <option value="Approved">Approved</option>
                                    <option value="Processing">Processing</option>
                                    <option value="No-Request">No-Request</option>
                                </select>

                            </div>




 

                    <div class="col col-sm-2">
                        <small> <Label>Anatomy</Label></small>
                        <select name="anatomy_id" class="form-control anatomy" id="anatomy_id">
                            <option value="">Select an Option</option>
                            @foreach($anatomies as $anatomy)
                            <option value='{{ $anatomy->id }}'>{{ $anatomy->anatomy}}</option>
                           @endforeach
                        </select>
                  </div>

                  <div class="col col-sm-2">
                        <small> <Label>Pauper's Burial Request Date</Label></small>
                        <div class='input-group' >
                        <input class="form-control input-sm" name="pauper_burial_requested_date" id="pauper_burial_requested_date" type="date" placeholder="Pauper's Burial Request Date">
                        <span class="input-group-addon">
                            <span class="fa fa-calendar">
                            </span>
                        </span>
                        </div>
                        @section('scripts')
                        <script type="text/javascript">
                            $('#pauper_burial_requested_date').datetimepicker({
                                format: 'YYYY-MM-DD',
                                useCurrent: false
                            })
                        </script>
                    @endsection
                   </div>
                  <div class="col col-sm-4">
                        <small> <Label>Pick-up Location</Label></small>
                    <input class="form-control input-sm" type="text" name="pickup_location" placeholder="Pick-up Location">
                   </div>
                </div>
          </div>

          <br>
      <div class="row">
        <div class="col col-sm-12">
                <div class="col col-sm-3">
                        <small> <Label>Division/Formation</Label></small>
                        <select name="division_id"  class="form-control" >
                            <option value="">Select a Division</option>
                                  @foreach($divisions as $division)
                                         <option value='{{ $division->id }}'>{{ $division->division}}</option>
                                  @endforeach
                    </select>
                  </div>





                  <div class="col col-sm-3">
                    <small> <Label>Police Station</Label></small>

                    <select name="station_id"    class="form-control station_id" >
                            <option value="">Select a Station</option>
                                  @foreach($stations as $station)
                                         <option value='{{ $station->id }}'>{{ $station->station}}</option>
                                  @endforeach
                    </select>

                </div>



              <div class="col col-sm-2">
                    <small> <Label>Regulation Number</Label></small>
                    <input class="form-control input-sm" type="text" name="regNum" placeholder="Regulation Number">
              </div>


              <div class="col col-sm-3">
             {{-- <a class="btn btn-primary pull-right" style="margin-top: -10px;margin-bottom: 5px" href="{!! route('corpses.create') !!}">Add New</a> --}}
  <br>

                <button class="btn btn-danger btn-xs resetAdvanceForm" ><i class="fa fa-refresh" aria-hidden="true"></i> Reset</button>
                @hasrole('SuperAdmin|Admin|viewer|writer')

        <button id="loadFormAdvance"  class=" btn-primary small-box-footer  btn btn-xs  savedAdvance"><i class="load-icon fa fa-spinner fa-spin hide"></i>
        <span class="btnloadFormAdvancetxt"><i class="fa fa-search" aria-hidden="true"></i> Search</span>
        </button>



        <a href="{{ url('/export')}}"  id="exporting"  class=" btn-default small-box-footer  btn btn-xs  exporting"><i class="exporting-icon fa fa-spinner fa-spin hide"></i>
            <span class="btnexportingtxt"> <i class="fa fa-file-excel-o" aria-hidden="true"></i> Export</span>
        </a>

                @endrole
                {{-- {!! Form::submit('', ['class' => 'saved btn  btn-primary']) !!} --}}
              </div>
          </div>
      </div> 

      {{-- <input type="hidden" id="order_by_last_nameForm2"  value="desc" name="order_by_last_name"> --}}
      

      <input type="hidden" name="page" id="page"/>
      <input type="hidden" name="query" id="query"/>
      <input type="hidden" name="sort_by" id="sort_by"/>
      <input type="hidden" name="sort_type" id="sort_type"  />
   
      {!! Form::close() !!}

</div>
 