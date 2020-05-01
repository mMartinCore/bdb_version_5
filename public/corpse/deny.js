

function SubmitTask(){
  checkTask();
}


function checkTask() {
  id=$("#getId").val();
  $(".taskMess").html('');
  var taskx = $(".task").val();
  if(taskx==''){
          $(".task_error").text("NO TASK ENTERED!");
          $(".task").css("border","2px solid red");

  }else  if(taskx.length > 500){
          $(".task").css("border","2px solid red");;
          $(".task_error").html("TASK  IS TOO WORDY!");
  }else if( taskx.length !=null && taskx.length < 7){
          $(".task").css("border","2px solid red");;
          $(".task_error").html("TASK NOT READABLE!");
  }else if (validatedId(id)) {
          addTaskMethod(id);
          $(".task").css("border","2px solid green");
          $(".task_error").html("");
          $(".task").val('');
      }  else {
              $(".task").css("border","2px solid red");;
              $(".task_error").html("SOMETHING WENT WRONG !");
              }
   
}



function deny( id){
  $(".hide_deny_task_btn").show();
  $(".hide_original_submitTask_btn").hide();
  $(".task_error").html("");
  $(".task").val('');
  $('#output').html('');
  
  $(".my_Modal_Vacation").show();
  $("#getId").val(id);
}




function addTaskMethod(id) {
  if (id!='') {
    $(".my_Modal_Vacation").hide();
    $(".btn_deny_loader-icon").removeClass("hide");
    $(".btn_deny_loader").attr("disabled", true);
    $(".btn_deny_loader-txt").text("Denying request please wait...");

      var taskName = $(".task").val();
      $.ajax({
        headers: {
          'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
      url:"/deny",  
     // url:"{{ route('corpses.deny') }}",
      method:"post",
      data: {
      'corpse_id':id,
      'task' : taskName,
      
      },
      dataType:"json",
      success:function(data)
      {


        $(".btn_deny_loader-icon").addClass("hide");
        $(".btn_deny_loader").attr("disabled", false);
        $(".btn_deny_loader-txt").text("Done ! Auto re-load in 5 seconds for changes");

          if(data.error.length > 0)
          {
              var error_html = '';
              for(var count = 0; count < data.error.length; count++)
              {
                  error_html += '<div class="alert alert-danger">'+data.error[count]+'</div>';
              }
              $('#outputTable').html(error_html);
              $('#output').html(error_html);
              $(".taskMess").html(error_html);
              setTimeout(function(){
              $(".taskMess").html('');
              $('#outputTable').html('');
               window.location.reload();
              }, 5000);
        
          }
          else
          {
              $('#output').html(data.success);
              $('#outputTable').html(data.success);
              $(".taskMess").html(data.success);
              setTimeout(function(){
              $('#outputTable').html('');
              window.location.reload();
              }, 5000);
          }
      }
})

} else {
      alert("No Id");
    }
}







function validatedId(params) {
if (params==null || params==""){
   $(".task_error").text("ID CAN BE BLANK!");
   $(".task").css("border","2px solid red");
  return false;
}else if(params.length>6){
   $(".task_error").text("ID FOR USER OR CORPSE IN VALID!");
   $(".task").css("border","2px solid red");
   return false;
}else{
   $(".task").css("border","2px solid green");
   $(".task_error").html("");
   return true;
}

}

