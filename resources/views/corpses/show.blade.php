

 
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
 
 





 <div class="row">
  <div class="col-xs-12">
    <div class="nav-tabs-custom">
      <ul class="nav nav-tabs">
        <li class="active"><a href="#Detail" data-toggle="tab"><i class="fa fa-folder-open" aria-hidden="true"></i> Corpse Detail </a></li>       
        <li><a href="#summmary" data-toggle="tab"><i class="fa fa-book" aria-hidden="true"></i> Case Summmary</a></li>
        <li><a href="#causeofdeath" data-toggle="tab"><i class="fa fa-hourglass-end" aria-hidden="true"></i> Cause of Death</a></li>
        <li><a href="#getAllTask" data-toggle="tab"><i class="fa fa-thumb-tack" aria-hidden="true"></i> Task</a></li>
        <li><a href="#message" data-toggle="tab"><i class="fa fa-envelope-o" aria-hidden="true"></i> Message</a></li>
        <li><a href="#dna_" data-toggle="tab"> <i class="fa fa-flask" aria-hidden="true"></i> DNA</a></li>
        <li><a href="#gazette" data-toggle="tab"> <i class="fa fa-television" aria-hidden="true"></i> Gazette</a></li>
        <li><a href="#created" data-toggle="tab"><i class="fa fa-clock-o" aria-hidden="true"></i> Action</a></li>
      </ul>            
      
      <div class="tab-content">           
            <div class="tab-pane active" id="Detail">                
                    <section id="new">
                           @include('corpses/showcontainer')
                    </section> 
          </div>
          
          <div class="tab-pane" id="summmary">
                  <div class="content">
                    <h3>Case Summary</h3>
                    <div class="col px-4 "><br>                      
                  <p id="getSummary">              
                  </p>
                    </div>
                  </div>
          </div> 

          <div class="tab-pane" id="causeofdeath">
            <div class="content">
            <h3>CAUSE OF DEATH</h3>
            <div class="col px-4 "><br>
              {{Form::label('death_date', 'Death Date:') }} 
              {{$corpse->dateConverter($corpse->death_date )}}
              <br>
              {{Form::label('cause_of_Death', 'Cause Of Death:') }} <br>
              {{$corpse->cause_of_Death }}<br>
            </div>
            </div>
         </div> 
       
           <div class="tab-pane" id="getAllTask">
            <div class="content">
              <table class="table table-bordered">
                <thead>
                  <tr> 
                    <th scope="col">TASK IN RELATION TO THIS CORPSE</th> 
                    <th scope="col">Time</th>                                     
                  </tr>
                </thead>
                <tbody id="getTask">
                  
                </tbody>
              </table>
            </div>
           </div> 
           
           <div class="tab-pane" id="message">
            <div class="content">
              <h3>Messages</h3>
              <table class="table table-bordered">
                <thead>
                  <th scope="col">Subject</th>
                    <th scope="col">Message</th> 
                    <th scope="col">Time</th>                                     
                  </tr>
                </thead>
                <tbody id="getAllMessages">
                </tbody>
              </table>
            </div>
            </div> 

            <div class="tab-pane" id="dna_">
              <div class="content">
              <h3>Deoxyribonucleic Acid (DNA) of Corpse</h3><br>
              <div class="col px-4 ">                          
                <div class="form-group">                                
                    {{Form::label('dna_date', 'DNA DATE REQUESTED :') }}
                      <b> {{$corpse->dateRequestConverter($corpse->getDna->dna_request_date) }}  </b>
                        @if ($corpse->getDna->dna_result_date=='')
                            <br>
                            {{Form::label('dnaRequestTimePeriod', 'TIME SINCE REQUESTED MADE :') }}
                            <b> {{$corpse->dnaRequestTimePeriod()}}</b>
                        @endif
                   
                      <br>
                    
                      @if ($corpse->getDna->dna_result_date!='')
                      {{Form::label('dna_result_date', 'DNA RESULT DATE :') }}  
                        <b>{{ $corpse->dateResultConverter($corpse->getDna->dna_result_date) }} </b>
                      <br>
                      {{Form::label('dnaResultProcessTime', 'DNA PROCESSING TIME :') }} 
                    <b>  {{$corpse->dnaResultProcessTime()}}  </b>                      
                      <br>
                      {{Form::label('dna_result', 'DNA Findings:') }} <br>
                     <b> {{$corpse->getDna->dna_result}}</b>
                      @endif                             
                 
                  </tbody>
                </table> 
              </div>
            </div>
              </div>
          </div> 
        
          <div class="tab-pane" id="gazette">
            <div class="content">
                <h3>Case Gazetted Information</h3>
                <div class="col px-4 "><br>                            
                          {{Form::label('gazetted_date', 'Gazetted Date:') }}
                          <b>{{ $corpse->dateConverter($corpse->gazetted_date ) }} </b>
                        <br>
                        <br>
                        {{Form::label('volume_no', 'Volume #:') }}
                        {{$corpse->volume_no }}                        
                </div>
            </div>
          </div> 

          <div class="tab-pane" id="created">
            <div class="content">
                   <h3>Action</h3>
                <div class="form-group">
                {{Form::label('created_at', 'Created at:') }}
                {{ $corpse->created_at->diffForHumans() }} <br>
                {{Form::label('updated_at', 'Updated at:') }}
                {{ $corpse->updated_at->diffForHumans() }} <br>
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
</div> 




































    
    
 