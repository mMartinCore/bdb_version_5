@extends('layouts.app')



@section('content')

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
 
 <script src="{{ asset('corpse/deny.js')}}"></script>

<link rel="stylesheet" href="{{asset('dist/task.css')}}">

<div class="container " style="min-height:700px;">

<div class="col-lg-10 col-lg-offset-1">

    <h2><i class="fa fa-list-ul" aria-hidden="true"></i>  Pauper's Burial {{$listType}} List </h2>
    <div id="outputTable"></div>

    <h1 style="color:#1E90FF">
        <div class=" large-box-footer    btn_deny_loader">
            <i class="btn_deny_loader-icon fa fa-spinner fa-spin hide"></i>
            <span class="btn_deny_loader-txt">   </span>
        </div>
    </h1>

    <h1 style="color:#1E90FF">
        <div class=" large-box-footer    btn_approve_loader">
            <i class="loading-icon fa fa-spinner fa-spin hide"></i>
            <span class="btn-txt">   </span>
        </div>
    </h1>
    <h1 style="color:#1E90FF">
        <div class=" large-box-footer    btn_makeRequest_loader">
            <i class="btn_makeRequest_loader-icon fa fa-spinner fa-spin hide"></i>
            <span class="btn_makeRequest_loader-txt">   </span>
        </div>
    </h1>
    


    <hr>

    <div  class="table-responsive">
        <table class="table table-bordered table-striped">

            <thead  style=" width:100%;border-collapse:collapse;background-color:#3c8dbc; font-size:small; color:white" >
                <tr  style="text-align:center; " >
                
                    <th>ID No.</th>
                    <th>Name</th>
                     <th>Division</th>
                     <th>Pickup Date</th>
                     <th>Status</th>
                     <th>Storage</th>
                    <Th>Excess</Th>
                    <th width="13%" >Actions</th>

                </tr>
            </thead>
            @if (!$corpses->isEmpty())
            <tbody style="font-size:small;" >
        
              @foreach ($corpses as $corpse)
              <tr class="col">
<?php
$name='';

if ($corpse->first_name == "Unidentified") {

if ($corpse->suspected_name != '')
  $name = '*' .ucfirst( $corpse->suspected_name) . '*';
else {
  $name = 'Unidentified';
}
} else {
$name = ucfirst($corpse->first_name) . ' ' .ucfirst( $corpse->middle_name) . ' ' . ucfirst($corpse->last_name);
}
// $corpse->created_at->format('F d, Y h:ia')




$storagedays = '';
$excess = 0;



          $storagedays = $corpse->storagedays();
          if ($storagedays >= 30) {

              $storagedays =  $storagedays;

              if ($storagedays > 30) {

                  $excess = $storagedays - 30;


                  if ($excess > 0) {

                  } else {
                      $excess = 0;
                  }
              } else {
                  $excess = 0;
              }

              // $overThirty=
          } elseif ($storagedays >= 20 &&  $storagedays < 30) {
              $excess = 0;
              $storagedays = $storagedays;
          }
               ?>

                   <td>
                      @hasrole('SuperAdmin|Admin|viewer|writer')
                          <a href="#" onclick="getViewId({!!$corpse->id!!});" class='btn btn-success btn-xs'>    {!!$corpse->id!!}</a>
                        @endrole
                     </td>
                    <td>{!! $name!!}</td>
                    <td>{!!$corpse->station->division->division!!}</td>
                    <td>{!! $corpse->pickup_date!!}</td> 
                    @if ($corpse->pauper_burial_approved =='No')
                    <td  class=" text-danger   " >
                        <h3 class="label label-danger"><i class="fa fa-clock-o"></i>    Denied </h3>
                    </td> 
                    @else
                    <td  class=" text-warning   " >
                        <h3 class="label label-warning"><i class="fa fa-clock-o"></i>    {!! $corpse->pauper_burial_approved!!}</h3>
                    </td>  
                    @endif                               
                    <td>{!!  $storagedays!!}</td>
                    <td>{!!   $excess!!}</td>
                 <td  >
                  <div class='btn-group'>                     
                              @if ( $listType=="Request Denied" ||  $listType=="No-Request" )
                              @hasrole('SuperAdmin|Admin|writer')
                              <a onclick="makeRequest({!!$corpse->id!!});"  class=" btn btn-success btn-xs  pull-right small-box-footer btn_makeRequest"><i class="fa fa-paper-plane-o" aria-hidden="true"></i>  Make Request </a>
                              @endrole
                             @elseif ( $listType=="Request")
                                @hasrole('SuperAdmin')
                                <a onclick="approved({!!$corpse->id!!});" class=" btn_approve btn btn-success btn-xs small-box-footer "> Approve  </a>
                                <a href="#" onclick="deny({!!$corpse->id!!});" class='btn   btn-danger btn-xs'> Deny </a>
                                @endrole
                           
                               @else 
                               <a href="#"   class='btn   btn-primary btn-xs'> No Action.. </a>
                           @endif                      
                  </div>
                 </td>
              </tr>
            
              @endforeach
           
            </tbody>
            @else
            <td colspan='8'><h4 style="color:dodgerblue">No Data Found</h4></td>
        @endif
        </table>

{{-- {!! $corpses->links()  !!} --}}
    </div>

{{--
    <a href="{{ route('corpses.create') !!}" class="btn btn-success">Add corpse</a> --}}

</div>


</div>




    <!-- The Modal  _Vacation -->
    <div class="my_Modal_Vacation">
        <div class="Modal_Vacation-content">
         <div class="modal_Vacation-header">
           <span class="modal_Vacation_close" onclick="closeModal();">&times;</span>
           </div>
                <div class="my_Modal_Vacation-body">
                  <div id = "Confirm_contentVacation">
                   <div class="form-group"> </div>
                    <div class ="messageVacation">
                      <div id="vacationStatusUpdate"  style="color:green;">  </div>
                      <span class="taskMess"></span>
                      <h4 id="vacationStatusTxt" > Enter a Task</h4> <span style="color:red" class="task_error"></span>
                  
                      <textarea name="task" id="task"  class=" task form-control"  rows="7" id="message-text"></textarea>
                      </div>
                   <hr>
                   <button id="btnConfirmVacation" class="saved hide_original_submitTask_btn" >Submit</button>  &emsp;
                   <button id="btnConfirmVacation" class=" hide_deny_task_btn " onclick="SubmitTask();" >  Deny  <i class="fa fa-thumbs-down" aria-hidden="true"></i></button>  &emsp;
               <button id="cancelVacation" onclick=" myFunction();" class = "cancelTask yes">Cancel <i class="fa fa-ban" aria-hidden="true"></i></button> &emsp;
          </div>
           <div>
           </div>
         </div>
       </div>
     </div>

<input type="hidden" id="getId">
<br><br><br><br><br><br><br><br><br><br><br><br>
@endsection 






<script>






function closeModal(){
    var Stdate = $(".task").val();
    if (Stdate!="") {
        var r = confirm(" Are you Sure ?");
        if (r == true) {
            $(".my_Modal_Vacation").hide();
            $(".task").val('');
                alert("TASK DID SAVED !");
                $(".task").css("border","2px solid green");
            $(".task_error").html("");
            }
        }else{
            $(".my_Modal_Vacation").hide();
            $(".task").val('');

                $(".task").css("border","2px solid green");
            $(".task_error").html("");
        }
}


function myFunction()
    {

        var Stdate = $(".task").val();
        if (Stdate!="") {
            var r = confirm(" Are you Sure ?");
            if (r == true) {
                $(".my_Modal_Vacation").hide();
                $(".task").val('');
                    alert("TASK DID SAVED !");
                    $(".task").css("border","2px solid green");
                $(".task_error").html("");
                }
            }else{
                $(".my_Modal_Vacation").hide();
                $(".task").val('');

                    $(".task").css("border","2px solid green");
                $(".task_error").html("");
            }


    }


    function getViewId(id) {
  $("#load_show_view").load("corpses/"+id, function(responseTxt, statusTxt, xhr){
      if(statusTxt == "success")
       {    document.getElementById('demo02').click(); // Works!
           return false;
    }
      if(statusTxt == "error"){
        alert("Error: " + xhr.status + ": " + xhr.statusText);
      }
      return false;

    });
     }














     function makeRequest(id){
    
       if (id!='') {


           $(".btn_makeRequest").attr("disabled", true);
         $(".btn_makeRequest_loader-icon").removeClass("hide");
          $(".btn_makeRequest_loader").attr("disabled", true);
          $(".btn_makeRequest_loader-txt").text("Making Request Please wait...");


        $.ajax({
            url:"{{ route('corpses.makeRequest') }}",
            method:"POST",
            data: {
                'corpse_id':id,
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
                    $('#outputTable').html(error_html);

                    $(".btn_makeRequest_loader-icon").addClass("hide");
                    $(".btn_makeRequest_loader").attr("disabled", false);
                    $(".btn_makeRequest_loader-txt").text("Done !");

                    setTimeout(function(){                 
                     window.location.reload();
                    },5000);


                }
                else
                {
                    $('#outputTable').html(error_html);
                    $(".btn_makeRequest_loader-icon").addClass("hide");
                    $(".btn_approve_loader").attr("disabled", false);
                    $(".btn_makeRequest_loader-txt").text("Done !"); 
                    $('.approveSuccess').html( '<div class="alert alert-success"> Request made Sucessfully. Auto re-load in 5 sec for changes ! </div>');
                   
                    setTimeout(function(){ 
                     window.location.reload();
                    }, 5000);
                }
            }
        })

       } else {
            alert("No Id");
       }

      }














     

function approved(id){
       if (id!='') {
          $(".btn_approve").attr("disabled", true);
          $(".loading-icon").removeClass("hide");
          $(".btn_approve_loader").attr("disabled", true);
          $(".btn-txt").text("Approving Request please wait...");

        $.ajax({
            url:"{{ route('corpses.approved') }}",
            method:"POST",
            data: {
                'corpse_id':id,
                "_token": "{{ csrf_token() }}",
            },

            dataType:"json",
            success:function(data)
            {
                $(".loading-icon").addClass("hide");
                    $(".btn_approve_loader").attr("disabled", false);
                    $(".btn-txt").text("Approved !"); 
                   
                    
                if(data.error.length > 0)
                {
                    var error_html = '';
                    for(var count = 0; count < data.error.length; count++)
                    {
                        error_html += '<div class="alert alert-danger">'+data.error[count]+'</div>';
                    }
                    $('#outputTable').html(error_html);
                   
                    setTimeout(function(){ 
                     window.location.reload();
                    },5000);
                }
                else
                {
              
                    $('#outputTable').html( '<div class="alert alert-success"> Approved Successfully, re-open to view changes </div>');
                   
                    setTimeout(function(){         
                     window.location.reload();
                    }, 5000);
                }
            }
        })

       } else {
            alert("No Id");
       }

      }








function addTask(taskName,addresTo_id,corpse_id) {
    $.ajax({
    type: "POST",
    url:"{{ route('corpses.task') }}",  
    data: {
    'task' : taskName,
    'address_to_id':addresTo_id,
    'corpse_id':corpse_id,
    "_token": "{{ csrf_token() }}",
    },
    dataType: "json",
    success:function(data){
        $("#getTask").html('');
        getTasks(corpse_id);
        $(".taskMess").html(data);
        $(".taskMess").css("color","solid green");


        setTimeout(function(){
            var element = document.getElementById("getTask");
            $(".my_Modal_Vacation").hide();
            $(".task_error").html("");
            $(".task").val('');
            element.scrollIntoView();
                    }, 1000);
        }
    });
}






    </script>

 
