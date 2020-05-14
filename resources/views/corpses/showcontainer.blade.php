
     <section class="content-header">    
         {!! $corpse->cr_no !!}    
          <div class="pull-right">
        
                <!-- Button trigger modal -->
                <button type="button" class="btn btn-primary btn-xs" data-toggle="modal" data-target="#exampleModalCenter"><i class="fa fa-commenting" aria-hidden="true"></i> 
                Message Admin
                </button>
                  <!-- Modal -->
                  <div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered" role="document">
                      <div class="modal-content">
                        <div class="modal-header">
                          <h5 class="modal-title" id="exampleModalCenterTitle">Message to SuperAdmin</h5>
                          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                          </button>
                        </div>
                        <div class="modal-body">
                          <p>Message must be related to this corpse only !</p> <hr>
                          <div>
                            <h3><span id="outputx"></span></h3>
                          </div>
                          <div  class="form-group ">
                            {!! Form::label('subject', 'Subject:') !!}
                            <input   name="subject" type="text" class=" subject form-control"> 
                          </div>
                          <div  class="form-group  "> 
                            {!! Form::label('message', 'Message:') !!}
                            <textarea  name="message" type="text" class=" message form-control" cols="30" rows="8"></textarea>
                          </div>
                        </div>
                        <div class="modal-footer">
                          <button type="button" id="close_message_model" class="btn btn-secondary" data-dismiss="modal"> <i class="fa fa-times-circle" aria-hidden="true"></i> Close</button>
                          <button type="button" onclick=" getMessage();" class="btn btn-primary"> <i class="fa fa-paper-plane-o" aria-hidden="true"></i> Send</button>
                        </div>
                      </div>
                    </div>
                  </div>
             
                @hasrole('SuperAdmin')
                  <button class="btn btn-primary btn-xs ShowModal"> <i class="fa fa-thumb-tack" aria-hidden="true"></i>  Add Task</button> 
                  {{-- <button class="btn btn-default btn-sm" id="printbutton" onclick="window.print();" ><i class="fa fa-print" aria-hidden="true"></i> Print with task  </button>&ensp; --}}
                  <button class="btn btn-info btn-xs"   onclick="print_div();" ><i class="fa fa-print" aria-hidden="true"></i>  Print </button> 
                @endrole
                      @if ( $corpse->pauper_burial_approved == 'No-Request'||$corpse->pauper_burial_approved == 'No')
                          @hasrole('SuperAdmin|Admin|writer') 
                              &ensp; <button  onclick="makeRequest();"  class=" btn btn-success btn-xs  pull-right    small-box-footer    btn_makeRequest_loader">
                                  <i class="btn_makeRequest_loader-icon fa fa-spinner fa-spin hide"></i>
                                  <span class="btn_makeRequest_loader-txt"> <i class="fa fa-paper-plane-o" aria-hidden="true"></i>  Make Request</span>
                                </button>    
                          @endrole
                    @endif
                    @if ( $corpse->pauper_burial_approved == 'Processing')
                    @hasrole('SuperAdmin') 
                    <button   onclick="approved({!!$corpse->id!!});" class=" btn btn-success btn-xs    small-box-footer    btn_approve_loader">
                      <i class="loading-icon fa fa-spinner fa-spin hide"></i>
                      <span class="btn-txt"><i class="fa fa-thumbs-up" aria-hidden="true"></i>   Approve</span>
                    </button>&ensp;    
                    <button href="#" onclick="deny({!!$corpse->id!!});" class='btn   btn-danger btn-xs pull-right'><i class="fa fa-thumbs-down" aria-hidden="true"></i> Deny </button>
                    @endrole
                @endif    
              </div>
              
    </section>


    <div class="content">
        <div class="box box-primary">
            <div class="box-body">
                <span class='approveSuccess'> </span>
                <div class="output"></div>

             <h1 style="color:#1E90FF">
                <div class=" large-box-footer    btn_deny_loader">
                    <i class="btn_deny_loader-icon fa fa-spinner fa-spin hide"></i>
                    <span class="btn_deny_loader-txt">   </span>
                </div>
            </h1>


            <h1 style="color:#1E90FF">
              <div class=" large-box-footer    btn_makeRequest_loader">
                  <i class="btn_makeRequest_loader-icon fa fa-spinner fa-spin hide"></i>
                  <span class="btn_makeRequest_loader-txt">   </span>
              </div>
          </h1>
          

            <h1 style="color:#1E90FF">
              <div class=" large-box-footer    btn_approve_loader">
                  <i class="loading-icon fa fa-spinner fa-spin hide"></i>
                  <span class="btn-txt">   </span>
              </div>
          </h1>           

          
                <div class="row" style="padding-left: 20px">

                    @include('corpses.show_fields')

                    <div class="output"></div>
                             

              
                </div>
