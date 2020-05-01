

 
<style>

    .btn_makeRequest_loader {
    
    cursor: pointer;
    }
    .btn_makeRequest_loader:disabled {
    opacity: 0.5;
    }
    

    
        .btn_approve_loader {
    
          cursor: pointer;
        }
        .btn_approve_loader:disabled {
          opacity: 0.5;
        }
    
    


    
        .btn_deny_loader {
    
    cursor: pointer;
    }
    .btn_deny_loader:disabled {
    opacity: 0.5;
    }

    
    
        .hide {
          display: none;
        }
      </style>
       <head>
                  
        @livewireStyles
      </head>
        <section class="content-header">
    
            <h4>    View  {!! $corpse->cr_no !!}    Corpse Detail
    
        
    
     
        <div class="pull-right">
          
        






           
    


<!-- Button trigger modal -->
<button type="button" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#exampleModalCenter"><i class="fa fa-commenting" aria-hidden="true"></i> 
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





@hasrole('SuperAdmin|Admin')


                     <!-- Button trigger modal -->
<button type="button" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#exampleModal"><i class="fa fa-thumb-tack" aria-hidden="true"></i>  Add Task </button>

<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel"> <i class="fa fa-thumb-tack" aria-hidden="true"></i>  Task </h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div class="form-group">
         
          <label for="message-text" class="   col-form-label">Task:</label> <span style="color:red" class="task_error"></span><br>
          <textarea name="task" id="task"  class=" task form-control"  rows="7" id="message-text"></textarea>
          
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="button" class=" saved btn btn-primary">  <i class="fa fa-paper-plane-o" aria-hidden="true"></i> Send </button>
      </div>
    </div>
  </div>
</div>

            {{-- <button class="btn btn-default btn-sm" id="printbutton" onclick="window.print();" ><i class="fa fa-print" aria-hidden="true"></i> Print with task  </button>&ensp; --}}
            <button class="btn btn-success btn-sm"   onclick="print_div();" ><i class="fa fa-print" aria-hidden="true"></i>  Print </button>&ensp;
        @endrole
                @if ( $corpse->pauper_burial_approved == 'No-Request'||$corpse->pauper_burial_approved == 'No')
                    @hasrole('SuperAdmin|Admin|writer') 
                    <button  onclick="makeRequest();"  class=" btn btn-info btn-sm  pull-right    small-box-footer    btn_makeRequest_loader">
                        <i class="btn_makeRequest_loader-icon fa fa-spinner fa-spin hide"></i>
                        <span class="btn_makeRequest_loader-txt"><i class="fa fa-save" aria-hidden="true"></i> Make Request</span>
                      </button>
    
                    @endrole
               @endif
               @if ( $corpse->pauper_burial_approved == 'Processing')
               @hasrole('SuperAdmin') 
               <button   onclick="approved({!!$corpse->id!!});" class=" btn btn-info btn-sm    small-box-footer    btn_approve_loader">
                <i class="loading-icon fa fa-spinner fa-spin hide"></i>
                <span class="btn-txt"><i class="fa fa-save" aria-hidden="true"> </i>  Approve</span>
              </button>&ensp;
    
               <button href="#" onclick="deny({!!$corpse->id!!});" class='btn   btn-danger btn-sm pull-right'> Deny </button>
               @endrole
          @endif
    
        </div>
    
    
            </h4>
    
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
                        <hr>
                       
    
                  
                    </div>
    
    



                    <ul class="nav nav-tabs" id="myTab" role="tablist">
                      <li class="nav-item">
                        <a class="nav-link active" id="home-tab" data-toggle="tab" href="#home" role="tab" aria-controls="home" aria-selected="true">Case Summary</a>
                      </li>
                      <li class="nav-item">
                        <a class="nav-link" id="profile-tab" data-toggle="tab" href="#profile" role="tab" aria-controls="profile" aria-selected="false">Task</a>
                      </li>
                      <li class="nav-item">
                        <a class="nav-link" id="message-tab" data-toggle="tab" href="#message" role="tab" aria-controls="message" aria-selected="false">Message</a>
                      </li>

                      <li class="nav-item">
                        <a class="nav-link" id="action-tab" data-toggle="tab" href="#action" role="tab" aria-controls="action" aria-selected="false">Action</a>
                      </li>
                    </ul>



                    <div class="tab-content" id="myTabContent">
                      <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">
                        <h3>Case Summary</h3>
                          <div class="col px-4 "><br>
                            
                         <p id="getSummary">
                    
                         </p>
                          </div>
                      </div>





                      <div class="tab-pane fade" id="profile" role="tabpanel" aria-labelledby="profile-tab">                      
                        <ul class="list-group">
                          <li class="list-group-item active">All Tasks</li> 
                          <li class="list-group-item"  id="getTask"> </li>
                        </ul>                
                     </div>
                     
                     
                      <div class="tab-pane fade" id="message" role="tabpanel" aria-labelledby="message-tab">
                            <h3>Messages</h3>
                            <table class="table table-bordered">
                              <thead>
                                <tr>
                                  
                                  <th scope="col">Subject</th>
                                  <th scope="col">Message</th> 
                                  <th scope="col">Time</th>                                     
                                </tr>
                              </thead>
                              <tbody id="getAllMessages">
                                
                              </tbody>
                            </table>
                      </div>

                      <div class="tab-pane fade" id="action" role="tabpanel" aria-labelledby="action-tab">
                        <h3>Action</h3>
                            
 
                        <div class="form-group">
                          {{Form::label('created_at', 'Created at:') }}
                          {{ $corpse->created_at->diffForHumans() }} <br>

                          {{Form::label('user_id', 'Created by:') }}
                          {{$corpse->user->firstName." ".$corpse->user->lastName }} <br>

                          {{Form::label('modified_by', 'Modified by:') }}
                          <?php  $user = App\User::where('users.id',$corpse->modified_by)->get(); ?>
                            @foreach ($user as  $modifedby)
                            {{  $modifedby->firstName." ". $modifedby->lastName}}
                            @endforeach
                        </div>
                     </div>
                    </div>
                    

 








                </div>
    
            </div>
      
        </div>
       
    
    
    