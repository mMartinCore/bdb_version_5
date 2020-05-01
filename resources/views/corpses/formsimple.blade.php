<div class="box-body ">
    {!! Form::open([ 'id'=>'postForm']) !!}
    {{csrf_field()}}
    <div class="row">
        <div class="col col-sm-12">

              <div class="col col-sm-2">
                    <small> <Label>First Name</Label></small>
                <input class="form-control input-sm" name="first_name" type="text" placeholder="First Name">
              </div>

              <div class="col col-sm-2">
                <small> <Label>Last Name</Label></small>
               <input class="form-control input-sm" name="last_name"  type="text" placeholder="Last Name">
          </div>
          <div class="col col-sm-2">
            <small> <Label>Account Alias:</Label></small>
        <input class="form-control input-sm" name="suspected_name"  type="text" placeholder="Account Alias:">
      </div>




      <div class="col col-sm-2">
        <small> <Label>Police Station</Label></small>

        <select name="station_id"    class="form-control station_id" >
                <option value="">Select a Station</option>
                      @foreach($stations as $station)
                             <option value='{{ $station->id }}'>{{ $station->station}}</option>
                      @endforeach
        </select>

    </div>



  <div class="col col-sm-4">
    <small> <Label>Furneral Home</Label></small>
            <select name="funeralhome_id"   class="form-control funeralhome_id"  >
                    <option value="">Select a Funeral Home </option>
                          @foreach($funeralhomes as $funeralhome)
                                 <option value='{{$funeralhome->id }}'>{{ $funeralhome->funeralhome}}</option>
                          @endforeach
            </select>
        </div>


          </div>

      </div>







        <div class="row">
            <div class="col col-sm-12"><br>
                  <div class="col col-sm-6 organizeBtn" >
                      <button class="btn  btn-xs btn-danger reset" ><i class="fa fa-refresh" aria-hidden="true"></i> Reset</button>
                    @hasrole('SuperAdmin|Admin|viewer|writer')

                    <button class="   btn-primary small-box-footer  btn btn-xs  btnLoaderSimpleSearch">
                        <i class="loading-icon fa fa-spinner fa-spin hide"></i>
                        <span class="btn-txt"><i class="fa fa-search" aria-hidden="true"></i> Search</span>
                      </button>



                     <a href="{{ url('/export')}}"  id="SimpleFormExporting"  class=" btn-default small-box-footer  btn btn-xs  SimpleFormExporting"><i class="SimpleFormExporting-icon fa fa-spinner fa-spin hide"></i>
                        <span class="btnSimpleFormExportingtxt"> <i class="fa fa-file-excel-o" aria-hidden="true"></i> Export</span>
                    </a>
                    @endrole
 




                  </div>

                </div>
          </div>

          <input type="hidden" name="page" id="SimpleForm_page"/>
          <input type="hidden" name="query" id="SimpleForm_query"/>
          <input type="hidden" name="sort_by" id="SimpleForm_sort_by"/>
          <input type="hidden" name="sort_type" id="SimpleForm_sort_type"  />

              {!! Form::close() !!}
          </div>
