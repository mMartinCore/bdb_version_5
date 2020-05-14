var unidentified = false;
var first_name  = false;
var middle_name = false;
var last_name  = false;
var sex = false;
var corpseCountry = false;
var death_date = true; //set true to accept no date

var address = false;
var summary = false;
var parish = false;
var corpse_stn_id=false;
var dob = true;  //set true to accept no date


var diary_type =false;
var diary_no =false;
var entry_date =false;

var pickup_date =false;
var condition =false;
var type_death =false;
var manner_death =false;
var anatomy = false;
var pickup_location =false;



// SECTION THREE
var station_id = false;
var  contact_no = false;
var  assign_date = false;
var  investigator_last_name = false;
var  investigator_first_name = false;
var  rank_id = false;
var  regNum = false;


var body_status=false;
var postmortem_status =false;
var postmortem_date=true;
var funeralhome_id=false;
var pathlogist=false;

var cause_of_Death =false;

//DISABLE  postmortem_date FIELD

var finger_print_date =true;
var finger_print =false;
var gazetted =false;
var gazetted_date =true;
var volume_no = true;  //set true to accept no date

var pauper_burial_requested  =false;
var pauper_burial_requested_date =true;

var buried= false;
var burial_date= true;
var dna =false;
var dna_date=true;
var dna_result_date=true;
var dna_result =true;

var isCrNoUnique=false;





// IF A BODY HAS BEEN GAZETTED IT SLIDEDOWN


$("#pauper_burial_requested_show").slideUp();
$(".cause_of_Death").attr("disabled", true);
$(".pathlogist").attr("disabled", true);

$(".address").val('');
$(".pauper_burial_approved").val('');

$(".volume_no").attr("disabled", true);

$(".dna_result_date").attr("disabled", true);
$(".dna_result").attr("disabled", true);

if ( $(".suspected_name").val() !='') {
    $(".suspected_name").attr("disabled", false);
} else {
    $(".suspected_name").attr("disabled", true);
}




function deadBodyStatus() {
    bodyStatus =  $(".body_status").val();
    if (bodyStatus.length < 1) {
        $(".body_status").css("border","2px solid red");
        $("#Error_body_status").html("<small style='color:red'>Choose an option..</small>");
        $("#Error_body_status").show();
        return   body_status =false;
    } else {
        $(".body_status").css("border","2px solid green");
        $("#Error_body_status").hide();
        console.log(bodyStatus);
        return   body_status =true;


    }
}







function is_dna() {

    if (requireDropDown("dna")){
                     if ($(".dna").val()==="Yes")
                      {
                         $("#Error_dna_date").hide();
                         $(".dna_date").css({"border":""});
                         $(".dna_date").attr("disabled", false);
                         dna =true;
                         } else  if ($(".dna").val()==="No")
                                     {     dna =true;
                                        dna_date= true;
                                        resetDateErorrBorder("dna");
                                        $(".dna_date").val("");
                                        $("#Error_dna_date").hide();
                                        $(".dna_date").css({"border":""});
                                        $(".dna_date").attr("disabled", true);

                                        $(".dna_result_date").val("");
                                        $("#Error_dna_result_date").hide();
                                        $(".dna_result_date").css({"border":""});
                                        $(".dna_result_date").attr("disabled", true);
                                        dna_result_date= true;

                                        $(".dna_result").val("");
                                        $("#Error_dna_result").hide();
                                        $(".dna_result").css({"border":""});
                                        $(".dna_result").attr("disabled", true);
                                        dna_result= true;

                                     }  else
                                             {
                                                 $(".dna_date").val("");
                                                 $("#Error_dna_date").hide();
                                                 $(".dna_date").css({"border":""});
                                                 $(".dna_date").attr("disabled", true);
                                                 dna_date= false;
                                             }
                         } else
                                 {
                                    dna = false;
                                 }

 }






function dnaDate()
{
    if (!$(".dna_date").prop("disabled") )
    {
         //  isfirstDateGreaterThanSecondDateNotReq("dna_date","postmortem_date")== true
            if (isfirstDateGreaterThanSecondDate("pickup_date","dna_date")== true )  {       // TESTIG FOR TRUE
                      dna_date =true;
                      
                      $(".dna_result_date").attr("disabled", false);


              } else {
                      dna_date =false;  
                      resetDateErorrBorderDna();
                     }
     }
  }



 
  function dnaResultDate()
  {
      if (!$(".dna_result_date").prop("disabled") )
      { 
            if ($(".dna_result_date").val()!='') {

                        if (isfirstDateGreaterThanSecondDate("dna_date","dna_result_date")== true )  {  
                         dna_result_date=true;
                          $(".dna_result").attr("disabled", false);
                         } else { 
                          dna_result_date=false;
                          resetErorrBorderDnaResult();
                        }
              
            } else {
              dna_result_date=true;
               resetErorrBorderDnaResult();              
              
            }
       } else{ dna_result_date=true;}
    }
  












function fingerPrint() {

   if (requireDropDown("finger_print")){

                    if ($(".finger_print").val()==="Yes")
                     {
                        $("#Error_finger_print_date").hide();
                        $(".finger_print_date").css({"border":""});
                        $(".finger_print_date").attr("disabled", false);
                        finger_print =true;

                        } else  if ($(".finger_print").val()==="No")
                                    {     finger_print =true;
                                          finger_print_date= true;
                                          resetDateErorrBorder("finger_print");
                                    }  else
                                            {
                                                $(".finger_print_date").val("");
                                                $("#Error_finger_print_date").hide();
                                                $(".finger_print_date").css({"border":""});
                                                $(".finger_print_date").attr("disabled", true);
                                                finger_print_date= false;

                                            }
                        } else
                                {
                                    finger_print = false;
                                }

}









function deathDropDown() {
        death = isTrueCheckRequireDrop('death',death_date);
}



function isGazetted() {
 
    if (requireDropDown("gazetted"))
    {
             if ($(".gazetted").val()==="Yes")
              {
                 $("#Error_gazetted_date").hide();
                 $(".gazetted_date").css({"border":""});
                 $(".gazetted_date").attr("disabled", false);
                 $(".volume_no").attr("disabled", false);
                 gazetted =true; 
                 $(".volume_no").css({"border":""});
                 $(".volume_no").attr("disabled", false);

                 } else  if ($(".gazetted").val()==="No")
                             {     gazetted =true;
                                   gazetted_date= true;
                                   volume_no=true;
                                   $("#Error_volume_no").hide();
                                   $(".volume_no").css({"border":""});
                                   $(".volume_no").attr("disabled", true);
                                   resetDateErorrBorder("gazetted");
                             }  else
                                     {
                                         $(".gazetted_date").val("");
                                         $("#Error_gazetted_date").hide();
                                         $(".gazetted_date").css({"border":""});
                                         $(".gazetted_date").attr("disabled", true);
                                         gazetted_date= false;
                                         volume_no=true;

                                     }
                 } else
                         {
                            gazetted = false;
                         }

}



function volumeNo() {
  var name ="volume_no";
  if (!$("."+name).prop("disabled")) { 
      volume_no=false;          
      var my_val= $.trim($("."+name).val().length);
         
      if (my_val<=0) {
            $("#Error_"+name).html("<small style='color:red'>*Required</small>");
            $("#Error_"+name).show();
            $("."+name).css("border","2px solid red");
            volume_no  = false; 
          }else if(my_val > 0 && my_val < 2 || my_val > 15) {
                    $("#Error_"+name).html("<small style='color:red'>Should be between 2-15 characters</small>");
                    $("#Error_"+name).show();
                    $("."+name).css("border","2px solid red");
                    volume_no  = false;
                }else{
                  $("."+name).css("border","2px solid green");
                  $("#Error_"+name).hide(); 
                  volume_no = true;
                } 
      }
}








function pauperBurialRequested() { // GOOD CODING HERE
    if ( $(".postmortem_status").val()==="Pending" //||$(".postmortem_status").val()==="Not Requested"
     )
    {
         pauper_burial_requested = true;
         pauper_burial_requested_date=true;

   }else{

                if (requireDropDown("pauper_burial_requested"))
                   {
                     if ($(".pauper_burial_requested").val()==="Yes")
                      {
                         $("#Error_pauper_burial_requested").hide();
                         $(".pauper_burial_requested_date").css({"border":""});
                         $(".pauper_burial_requested_date").attr("disabled", false);
                         pauper_burial_requested =true;

                         } else  if ($(".pauper_burial_requested").val()==="No")
                                     {       pauper_burial_requested = true;
                                           pauper_burial_requested_date= true;
                                           resetDateErorrBorder("pauper_burial_requested");
                                     }  else
                                             {
                                                 $(".pauper_burial_requested_date").val("");
                                                 $("#Error_pauper_burial_requested").hide();
                                                 $(".pauper_burial_requested_date").css({"border":""});
                                                 $(".pauper_burial_requested_date").attr("disabled", true);
                                                 pauper_burial_requested_date= false;

                                             }
                         } else {
                                    pauper_burial_requested = false;
                                 }

        }
 }




 function   pauperBurialApprovedDropDown(myVa){
    var value= $("."+myVa).val();
    if ($("."+myVa).val().length < 1 || value ==''|| value ==null) {
        $("."+myVa).css("border","2px solid red");
        $("#Error_"+myVa).html("<small style='color:red'>Choose an option..</small>");
          $("#Error_"+myVa).show();
        return  false;
    } else {
        $("."+myVa).css("border","2px solid green");
        $("#Error_"+myVa).hide();
        return   true;

    }
}








function isBuried() {
    buried  = isTrueCheckRequireDropBurial("buried");


}










function gender()
{
  var  gender = $(".sex").val();
    if (gender.length < 1) {
        $(".sex").css("border","2px solid red");
        $("#Error_sex").html("<small style='color:red'>Choose an option..</small>");
        $("#Error_sex").show();
        return   sex =false;
    } else {
        $(".sex").css("border","2px solid green");
        $("#Error_sex").hide();
        return   sex =true;

    }
}




function country()
{
  var  national = $(".corpseCountry").val();
    if (national.length < 1) {
        $(".corpseCountry").css("border","2px solid red");
          $("#Error_corpseCountry").html("<small style='color:red'>Choose an option..</small>");
          $("#Error_corpseCountry").show();
          return   corpseCountry = false;
    } else {
        $(".corpseCountry").css("border","2px solid green");
        $("#Error_corpseCountry").hide();
        return  corpseCountry = true;
    }
}





// function parishFound()
// {
//   var  par = $(".parish").val();
//     if (par.length < 1) {
//         $(".parish").css("border","2px solid red");
//           $("#Error_parish").html("<small style='color:red'>Choose an option..</small>");
//           $("#Error_parish").show();
//         return  parish = false;
//     } else {
//         $(".parish").css("border","2px solid green");
//         $("#Error_parish").hide();
//        return parish = true;
//     }
// }







function resetValue() {
    first_name  = false;
    middle_name = false;
    last_name  = false;
    corpseCountry = false;
    address = false;
    dob = true;  //set true to accept no date
}





 function  is_unidentiied()
 {
     if ( $("#unidentified").val()=='Yes') {
        $(".first_name").val("");
        $(".middle_name").val("");
        $(".middle_name").val("");
        $(".last_name").val("");
        $(".dob").val("");
        $(".corpseCountry").val("");
        $(".suspected_name").attr("disabled", false);

        resetValue();


        $("#Error_first_name").html("");
        $("#Error_middle_name").html("");
        $("#Error_middle_name").html("");
        $("#Error_last_name").html("");
        $("#Error_dob").html("");
        $("#Error_corpseCountry").html("");
        $("#Error_address").html("");

        $(".first_name").css({"border":""});
        $(".middle_name").css({"border":""});
        $(".last_name").css({"border":""});
        $(".dob").css({"border":""});
        $(".corpseCountry").css({"border":""});


         $(".first_name").attr("disabled", true);
         $(".last_name").attr("disabled", true);
         $(".middle_name").attr("disabled", true);
         $(".dob").attr("disabled", true);
         $(".corpseCountry").attr("disabled", true);

         $(".unidentified").css("border","2px solid green");
         $("#Error_unidentified").hide();
         return  unidentified = true;
     } else if ( $("#unidentified").val()==="No") {
        enableSeciontOneTxt();
        $(".unidentified").css("border","2px solid green");
        $(".suspected_name").css("border","");
        $("#Error_suspected_name").html("");      
        $(".suspected_name").val("");
        $("#Error_unidentified").hide();
        $(".suspected_name").attr("disabled", true);
        suspected_name=true;
        return  unidentified = false;
     } else if ($("#unidentified").val()=="") {
        $(".unidentified").css("border","2px solid red");
        $("#Error_unidentified").html("<small style='color:red'>Choose an option..</small>");
        $("#Error_unidentified").show();
        enableSeciontOneTxt();
        return  unidentified = false;
     } else{
        enableSeciontOneTxt();
       return  unidentified = false;
     }
}


function enableSeciontOneTxt() {
    $(".first_name").attr("disabled", false);
    $(".middle_name").attr("disabled", false);
    $(".middle_name").attr("disabled", false);
    $(".last_name").attr("disabled", false);
    $(".dob").attr("disabled", false);
    $(".corpseCountry").attr("disabled", false);

}


function name(name,myClass)
{
    if (!$("."+name).prop("disabled")) {
        var letters = /^[A-Za-z]+$/;
        var nameValue=false;
    namex=$("."+name).val();
    var my_val= $.trim(namex.length);
   if (my_val!=0) {
    if(my_val < 3 || my_val > 15) {
        $("#Error_"+myClass).html("<small style='color:red'>Should be between 3-15 letters</small>");
        $("#Error_"+myClass).show();
        $("."+name).css("border","2px solid red");
        return nameValue  = false;
    }

    // else if( namex.indexOf(' ')>=0){
    //     $("#Error_"+myClass).html("<small style='color:red'>No spacing required... </small>");
    //     $("#Error_"+myClass).show();
    //     $("."+name).css("border","2px solid red");
    //      return nameValue  = false;
    // }



    else if(!letters.test(namex)){
        $("#Error_"+myClass).html("<small style='color:red'>Only letters allowed... </small>");
        $("#Error_"+myClass).show();
        $("."+name).css("border","2px solid red");
       return nameValue  = false;
    }

    else if(my_val <=0){
        $("#Error_"+myClass).hide();
        $("."+name).css({"border":""});
        return nameValue  = true;
    } else {
        $("."+name).css("border","2px solid green");
        $("#Error_"+myClass).hide();
        return nameValue = true;
    }
  }else {
        if ($("#unidentified").val()==="No") {
            $("#Error_"+myClass).html("<small style='color:red'> is allowed here... </small>");
            $("#Error_"+myClass).show();
            $("."+name).css("border","2px solid red");
            return nameValue  = false;
        } else {
            $("#Error_"+myClass).hide();
            $("."+name).css({"border":""});
            return nameValue=true;
        }



}
    }
}







function suspectedName(name,myClass)
{
    if (!$("."+name).prop("disabled")) {
        var letters = /^[A-Za-z]+$/;
        var nameValue=false;
    namex=$("."+name).val();
    var my_val= $.trim(namex.length);
   if (my_val!=0) {
    if(my_val < 3 || my_val > 15) {
        $("#Error_"+myClass).html("<small style='color:red'>Should be between 3-15 letters</small>");
        $("#Error_"+myClass).show();
        $("."+name).css("border","2px solid red");
        return nameValue  = false;
    }
    // else if( namex.indexOf(' ')>=0){
    //     $("#Error_"+myClass).html("<small style='color:red'>No spacing required... </small>");
    //     $("#Error_"+myClass).show();
    //     $("."+name).css("border","2px solid red");
    //      return nameValue  = false;
    // }

    // else if(!letters.test(namex)){
    //     $("#Error_"+myClass).html("<small style='color:red'>Only letters allowed... </small>");
    //     $("#Error_"+myClass).show();
    //     $("."+name).css("border","2px solid red");
    //    return nameValue  = false;
    // }

    else if(my_val <=0){
        $("#Error_"+myClass).hide();
        $("."+name).css({"border":""});
        return nameValue  = true;
    } else {
        $("."+name).css("border","2px solid green");
        $("#Error_"+myClass).hide();
        return nameValue = true;
    }
  }else {
        if ($("#unidentified").val()==="No") {
            $("#Error_"+myClass).hide();
            $("."+name).css({"border":""});
            return nameValue=true;
        } else {
            $("#Error_"+myClass).hide();
            $("."+name).css({"border":""});
            return nameValue=true;
        }



}
    }
}










function middleName(name,myClass)
{
    if (!$("."+name).prop("disabled")) {
        var letters = /^[A-Za-z]+$/;
        var nameValue=false;
    namex=$("."+name).val();
    var my_val= $.trim(namex.length);
   if (my_val!=0) {
    if(my_val < 3 || my_val > 15) {
        $("#Error_"+myClass).html("<small style='color:red'>Should be between 3-15 letters</small>");
        $("#Error_"+myClass).show();
        $("."+name).css("border","2px solid red");
        return nameValue  = false;
    }else if( namex.indexOf(' ')>=0){
        $("#Error_"+myClass).html("<small style='color:red'>No spacing required... </small>");
        $("#Error_"+myClass).show();
        $("."+name).css("border","2px solid red");
         return nameValue  = false;
    }else if(!letters.test(namex)){
        $("#Error_"+myClass).html("<small style='color:red'>Only letters allowed... </small>");
        $("#Error_"+myClass).show();
        $("."+name).css("border","2px solid red");
       return nameValue  = false;
    }

    else if(my_val <=0){
        $("#Error_"+myClass).hide();
        $("."+name).css({"border":""});
        return nameValue  = true;
    } else {
        $("."+name).css("border","2px solid green");
        $("#Error_"+myClass).hide();
        return nameValue = true;
    }
  }else {
        if ($("#unidentified").val()==="No") {
            $("#Error_"+myClass).hide();
            $("."+name).css({"border":""});
            return nameValue=true;
        } else {
            $("#Error_"+myClass).hide();
            $("."+name).css({"border":""});
            return nameValue=true;
        }



}
    }
}




function case_summary()
{   
   var namex=$(".summary").val();
   var  myClass="summary";
    var my_val= $.trim(namex.length);

    // if ($("#unidentified").val()==="No" && my_val <=0 ) {
    //     $("#Error_"+myClass).html("<small style='color:red'> is allowed here... </small>");
    //     $("#Error_"+myClass).show();
    //     $("."+name).css("border","2px solid red");
    //     return addVal  = false;
    // }else  if ($("#unidentified").val()==="Yes" && my_val <=0 ) {
    //     $("."+name).css("border","2px solid green");
    //     $("#Error_"+myClass).hide();
    //     return  addVal =true;
    // }

   // else

    if (my_val >1 ) {
        if(my_val < 7 || my_val > 1000) {
            $("#Error_"+myClass).html("<small style='color:red'>Should be between 7-1000 letters</small>");
            $("#Error_"+myClass).show();
            $("."+myClass).css("border","2px solid red");
            return   summary =false;
        }
        else {
            $("."+myClass).css("border","2px solid green");
            $("#Error_"+myClass).hide();
            return  summary =true;
        }
    }else {
      $("#Error_"+myClass).html("<small style='color:red'> circumstances unknown would suffice !</small>");
      $("#Error_"+myClass).show();
      $("."+myClass).css("border","2px solid red");
      return   summary =false;
    }

}




function corpseAddress(name,myClass)
{  var addVal=false;
    namex=$("."+name).val();
    var my_val= $.trim(namex.length);

    // if ($("#unidentified").val()==="No" && my_val <=0 ) {
    //     $("#Error_"+myClass).html("<small style='color:red'> is allowed here... </small>");
    //     $("#Error_"+myClass).show();
    //     $("."+name).css("border","2px solid red");
    //     return addVal  = false;
    // }else  if ($("#unidentified").val()==="Yes" && my_val <=0 ) {
    //     $("."+name).css("border","2px solid green");
    //     $("#Error_"+myClass).hide();
    //     return  addVal =true;
    // }

   // else

    if (my_val >0 ) {
        if(my_val < 4 || my_val > 150) {
            $("#Error_"+myClass).html("<small style='color:red'>Should be between 4-150 letters</small>");
            $("#Error_"+myClass).show();
            $("."+name).css("border","2px solid red");
            return   addVal =false;
        }
        else if(my_val <=0){
            $("#Error_"+myClass).hide();
            $("."+name).css({"border":""});
            return  addVal =true;
        } else {
            $("."+name).css("border","2px solid green");
            $("#Error_"+myClass).hide();
            return  addVal =true;
        }
    }else {
        $("."+name).css("border","2px solid yellow");
        $("#Error_"+myClass).hide();
        return   true;
    }




}








function isDateGreaterNow(getDate) {
    var today = new Date();

    if (new Date(getDate) >= new Date(today)) {
      return   true;
    }else{
      return   false;
    }
}


function isFirstDateGreaterThanSecDate(firstDate,secDate) {// GOOD
    if (new Date(firstDate)== new Date(secDate)) {
        return   true;
      }else if(new Date(firstDate) > new Date(secDate)){
            return   false;
      }else
          {
          return  true;
          }
  }


function secDateNotGrater(firstDate,secDate) {// GOOD
    if (new Date(firstDate) == new Date(secDate)) {
        return   true;
      }else if(new Date(firstDate) > new Date(secDate)){
            return   true;
      }else if(new Date(firstDate) < new Date(secDate)){
            return   false;
  }
  }



function dateCheck(getDate)
{
     var ref=getDate;
     if ($("."+getDate).val()!='') {
        if (isDateGreaterNow( $("."+getDate).val())==true) {
            $("."+ref).css("border","2px solid red");
              $("#Error_"+ref).html("<small style='color:red'> Can't be prior today..</small>");
              $("#Error_"+ref).show();
            return   false;
        } else {
            $("."+ref).css("border","2px solid green");
            $("#Error_"+ref).hide();
            return    true;
        }
     } else {
        $("."+ref).css({"border":""});
        $("#Error_"+ref).hide();
        $("."+getDate).val(null);
        return       true;

     }


}

function resetDisable(field) {
    $("."+field).attr("disabled", true);
    $("#Error_"+field).hide();
    $("."+field).css({"border":""});
    $("."+field).val("");
    return field=true;
}


function resetDateErorrBorder(field) {
    $("."+field+"_date").attr("disabled", true);
    $("#Error_"+field+"_date").hide();
    $("."+field+"_date").css({"border":""});
    $("."+field+"_date").val("");
    return true;
}

function resetDateErorrBorderDna() {
  var field="dna_result_date";
  $("."+field).attr("disabled", true);
  $("#Error_"+field).hide();
  $("."+field).css({"border":""});
  $("."+field).val("");  
  dna_result_date=true;
}


function resetErorrBorderDnaResult() {
  var field="dna_result";
  $("."+field).attr("disabled", true);
  $("#Error_"+field).hide();
  $("."+field).css({"border":""});
  $("."+field).val("");  
  dna_result=true;
}


function postMortemDate()
{

    if ( $(".postmortem_status").val()==="Pending") {

        postmortem_date = isfirstDateGreaterThanSecondPendingDate("pickup_date","postmortem_date");
        if (postmortem_date) {//IF THE POSTMORTEM DATE IS PENDING THEN SET PAUPER DROPDOWN TO TRUE.THIS IS SO BECAUSE THE
            //                 REQUEST MUST BE MADE AFTER THE POSTMORTEM.
            pauper_burial_requested=true;

        }
    } else if( $(".postmortem_status").val()==="Completed"  ){


            if ( $(".postmortem_date").val()=='') {
                $(".postmortem_date").css("border","2px solid red");
                $("#Error_postmortem_date").html("<small style='color:red'> required..</small>");
                $("#Error_postmortem_date").show();
                  postmortem_date = false;
            } else {
                postmortem_date = isfirstDateGreaterThanSecondCompletedDate("pickup_date","postmortem_date");

            }





    } else if( $(".postmortem_status").val()==="Not Required"  ){
        postmortem_date = true;
        resetDisable("pathlogist");
      //  resetDisable("cause_of_Death");

    }

}





function fingerPrintDate()
{
    if (!$(".finger_print_date").prop("disabled"))
    {
            if (isfirstDateGreaterThanSecondDate("pickup_date","finger_print_date")== true &&
             isfirstDateGreaterThanSecondDateNotReq("finger_print_date","postmortem_date")== true )
            {     // TESTIG FOR TRUE
                    finger_print_date =true;
            } else {
                    finger_print_date =false;
                    }
     }
  }






  function  gazettedDate()
{
    // && isfirstDateGreaterThanSecondDate("postmortem_date","gazetted_date")== true
    if (!$(".gazetted_date").prop("disabled"))
    {
                if (isfirstDateGreaterThanSecondDate("pickup_date","gazetted_date")== true &&
                 isfirstDateGreaterThanSecondDateNotReq("gazetted_date","pauper_burial_requested_date")== true  )
                {
                        gazetted_date =true;
                }else{
                    gazetted_date =false;
                }
     }

  }





  function  pauperBurialRequestedDate()
{
    if (!$(".pauper_burial_requested_date").prop("disabled"))
    {
         if (
             //isfirstDateGreaterThanSecondDate( "gazetted_date","pauper_burial_requested_date")== true &&
             isfirstDateGreaterThanSecondDate("pickup_date","pauper_burial_requested_date" )== true  &&
                    isfirstDateGreaterThanSecondDate("postmortem_date","pauper_burial_requested_date" )== true
                    )
                {     // TESTIG FOR TRUE
                        pauper_burial_requested_date =true;
                } else {
                         pauper_burial_requested_date =false;

                        }
    }

  }











  function  burialDate()
{
    if (!$(".burial_date").prop("disabled"))
    {

            if (isfirstDateGreaterThanSecondDate( "pickup_date","burial_date")== true &&
                isfirstDateGreaterThanSecondDate( "finger_print_date","burial_date")== true &&
                isfirstDateGreaterThanSecondDate( "gazetted_date","burial_date")== true &&
                isfirstDateGreaterThanSecondDate("pauper_burial_requested_date","burial_date")== true &&
                isfirstDateGreaterThanSecondDate("postmortem_date","burial_date")== true
                )
            {     // TESTIG FOR TRUE
                burial_date =true;

            } else {
                burial_date =false;
                    }
    }

  }













function checkDob(getDeath,getDob)
 {
    var dobResult=false;
    var ref=getDob;
    var deadDate= $("."+getDeath).val();
    var dobDate= $("."+getDob).val();
    if ( $("#unidentified").val()=='No') {
        if (dobDate!='' )
        {
                 if (dateCheck(getDob)==true)
                 {
                        if (deadDate!='') {
                             if ( isFirstDateGreaterThanSecDate(deadDate,dobDate) ==false)
                             {
                                 $("."+ref).css("border","2px solid green");
                                 $("#Error_"+ref).hide();
                                 return true;
                             }
                                 else {
                                         $("."+ref).css("border","2px solid red");
                                         $("#Error_"+ref).html("<small style='color:red'>Inconcievable D.O.B post death..</small>");
                                         $("#Error_"+ref).show();
                                         return false;
                                     }
                        }
                        else
                           {

                             $("."+ref).css("border","2px solid green");
                             $("#Error_"+ref).hide();
                             return true;
                           }
                 }else{
                       return false;
                      }
      }
       else
         {
             $("."+ref).css("border","2px solid red");
             $("#Error_"+ref).html("<small style='color:red'>Inconcievable D.O.B post death..</small>");
             $("#Error_"+ref).show();
             return false;
         }
    }

}





function secondDateMustGrater(firstDate,secondDate)
 {


    var first_Date= $("."+firstDate).val();
    var second_Date= $("."+secondDate).val();
        if (second_Date!='' )
        {
                 if (dateCheck(secondDate)==true)
                 {
                        if (first_Date!='') {
                             if ( isFirstDateGreaterThanSecDate(first_Date,second_Date) ==true)
                             {
                                 $("."+secondDate).css("border","2px solid green");
                                 $("#Error_"+secondDate).hide();
                                 return true;
                             }
                                 else {
                                         $("."+secondDate).css("border","2px solid red");
                                         $("#Error_"+secondDate).html("<small style='color:red'>Inconcievable date..</small>");
                                         $("#Error_"+secondDate).show();
                                         return false;
                                     }
                        }
                        else
                           {

                             $("."+secondDate).css("border","2px solid green");
                             $("#Error_"+secondDate).hide();
                             return true;
                           }
                 }else{
                       return false;
                      }
      }
       else
         {
            $("."+secondDate).css("border","2px solid yellow");
            $("#Error_"+secondDate).hide();
            return true;
         }


}






















function date_of_birth(getDeath,getDob)
 {
    var dobResult=false;
    var ref=getDob;
    var deadDate= $("."+getDeath).val();
    var dobDate= $("."+getDob).val();
        if (dobDate!='' )
        {
                 if (dateCheck(getDob)==true)
                 {
                        if (deadDate!='') {
                             if ( secDateNotGrater(deadDate,dobDate) ==true)
                             {
                                 $("."+ref).css("border","2px solid green");
                                 $("#Error_"+ref).hide();
                                 return true;
                             }  else     if ( secDateNotGrater(deadDate,dobDate) ==false) {
                                         $("."+ref).css("border","2px solid red");
                                         $("#Error_"+ref).html("<small style='color:red'>Inconcievable D.O.B post death..</small>");
                                         $("#Error_"+ref).show();
                                         return false;
                                     }  else
                                     {

                                       $("."+ref).css("border","2px solid green");
                                       $("#Error_"+ref).hide();
                                       return true;
                                     }
                        }
                        else
                           {

                             $("."+ref).css("border","2px solid green");
                             $("#Error_"+ref).hide();
                             return true;
                           }
                 }else{
                       return false;
                      }
      }
       else
         {
            $("."+ref).css("border","2px solid green");
            $("#Error_"+ref).hide();
            return true;
         }


}













  //////////////////SECTION TWO











function corpse_stn()
{
  var  stn = $(".corpse_stn_id").val();
    if (stn.length < 1) {
        $(".corpse_stn_id").css("border","2px solid red");
          $("#Error_corpse_stn_id").html("<small style='color:red'>Required..</small>");
          $("#Error_corpse_stn_id").show();
        return   corpse_stn_id=false;
    } else {
        $(".corpse_stn_id").css("border","2px solid green");
        $("#Error_corpse_stn_id").hide();
        return   corpse_stn_id=true;
    }
}


function getRequiredField(require)
{ 
    if ($("."+require).val().length < 1) {
        $("."+require).css("border","2px solid red");
          $("#Error_"+require).html("<small style='color:red'>Choose an option..</small>");
          $("#Error_"+require).show();
        return  false;
    } else {
        $("."+require).css("border","2px solid green");
        $("#Error_"+require).hide();
        return   true;
    }
}




function CorpseCondition() {
    condition=  getRequiredField("condition");
}


function typeDeath() {
    type_death=  getRequiredField("type_death");
}


function mannerDeath() {
    manner_death= getRequiredField("manner_death");
}


function anotomMethod() {
 anatomy = getRequiredField("anatomy");
}








function pickupLocation(name)
{
    myClass=name;
    namex=$("."+name).val();
    var my_val= $.trim(namex.length);
   if (my_val!=0) {
            if(my_val < 12 || my_val > 190)
              {
                $("#Error_"+myClass).html("<small style='color:red'>Should be between 12-190 letters</small>");
                $("#Error_"+myClass).show();
                $("."+myClass).css("border","2px solid red");
                return   false;
              }else {
                    $("."+myClass).css("border","2px solid green");
                    $("#Error_"+myClass).hide();
                    return  true;
                  }
    }else {
        $("#Error_"+myClass).html("<small style='color:red'> is mandatory... </small>");
        $("#Error_"+myClass).show();
        $("."+myClass).css("border","2px solid red");
        return  false;
}
}







function causeOfDeath(name)
{
    myClass=name;
    namex=$("."+name).val();
    var my_val= $.trim(namex.length);
   if ( my_val > 0 ) {
            if(my_val < 7 || my_val > 1000)
              {
                $("#Error_"+myClass).html("<small style='color:red'>Should be between 7-1000 letters</small>");
                $("#Error_"+myClass).show();
                $("."+myClass).css("border","2px solid red");
                return   false;
              }else {
                    $("."+myClass).css("border","2px solid green");
                    $("#Error_"+myClass).hide();
                    return  true;
                  }
      } else if ( my_val <= 0 && !$(".cause_of_Death").prop("disabled"))
            {
                $("#Error_"+myClass).html("<small style='color:red'> is now *mandatory...If not sure \'UNKNOWN' suffice </small>");
                $("#Error_"+myClass).show();
                $("."+myClass).css("border","2px solid red");
                return  false;
          }else {
                    $("."+myClass).css("border","2px solid green");
                    $("#Error_"+myClass).hide();
                    return  true;
                }
}




function dnaResult()
{
    myClass='dna_result';
    namex=$(".dna_result").val();
    var my_val= $.trim(namex.length);
   if ( my_val > 0 ) {
            if(my_val < 7 || my_val > 500)
              {
                $("#Error_"+myClass).html("<small style='color:red'>Should be between 7-500 letters</small>");
                $("#Error_"+myClass).show();
                $("."+myClass).css("border","2px solid red");
                dna_result=   false;
              }else {
                    $("."+myClass).css("border","2px solid green");
                    $("#Error_"+myClass).hide();
                    dna_result = true;
                  }
      } else if ( my_val <= 0 && !$(".dna_result").prop("disabled"))
            {
                $("#Error_"+myClass).html("<span style='color:red'> is now *mandatory...If not sure \'Negative Or Positive' suffice </span>");
                $("#Error_"+myClass).show();
                $("."+myClass).css("border","2px solid red");
                dna_result= false;
          }else {
                    $("."+myClass).css("border","2px solid green");
                    $("#Error_"+myClass).hide();
                    dna_result =  true;
                }
}






  function dateCheckRequired(getDate)
  {
       var ref=getDate;
       if ($("."+getDate).val()!='') {
          if (isDateGreaterNow($("."+getDate).val())==true) {
              $("."+ref).css("border","2px solid red");
                $("#Error_"+ref).html("<small style='color:red'> Can't be prior today..</small>");
                $("#Error_"+ref).show();
              return   false;
          } else {
              $("."+ref).css("border","2px solid green");
              $("#Error_"+ref).hide();
              return    true;
          }
       } else {
          $("."+ref).css("border","2px solid red");
          $("#Error_"+ref).html("<small style='color:red'> Is Mandatory *..</small>");
          $("#Error_"+ref).show();
        return   false;

       }

  }








  function checkPickUpdate(getDeath,pickup_dateValue)
   {

      var ref=pickup_dateValue;
      var pickUpDate= $("."+pickup_dateValue).val();
      if (pickUpDate!='')
         {
                  if (dateCheckRequired(pickup_dateValue)==true)
                  {
                         if ($("."+getDeath).val()!='') {
                              if ( isFirstDateGreaterThanSecDate($("."+getDeath).val(),pickUpDate) ==false)
                              {    // THE DEATH DATE IS GREATER WHICH IS WRONG
                                    $("."+ref).css("border","2px solid red");
                                    $("#Error_"+ref).html("<small style='color:red'>Inconcievable date..</small>");
                                    $("#Error_"+ref).show();
                                    return  pickup_date = false;
                              }
                                  else {
                                        $("."+ref).css("border","2px solid green");
                                        $("#Error_"+ref).hide();
                                        return  pickup_date = true;
                                        }
                         }
                         else
                            {

                              $("."+ref).css("border","2px solid green");
                              $("#Error_"+ref).hide();
                              return  pickup_date = true;
                            }
                  }else{
                        return  pickup_date = false;
                       }
       }
        else
          {
            $("."+ref).css("border","2px solid red");
            $("#Error_"+ref).html("<small style='color:red'>Date is mandatory..</small>");
            $("#Error_"+ref).show();
            return  pickup_date = false;
          }
  }



  function isfirstDateGreaterThanSecondDateNotReq(firstDate,SecondDate)// first date not required
  {   //   TESTING FOR TRUE
    var ref=firstDate;
    var sec_Date= $("."+SecondDate).val();
    if (sec_Date!='')
       {
                if ( $(".postmortem_status").val()==="Pending") {

                    if ($("."+firstDate).val()!='') {
                        console.log(27);
                          if ( isFirstDateGreaterThanSecDate($("."+firstDate).val(),sec_Date) ==false)
                          {    console.log(37);
                              // THIS WILL RUN HERE ONLY IF THE FIRST IS BIGGER
                                $("."+ref).css("border","2px solid red");
                                $("#Error_"+ref).html("<small style='color:red'>Inconcievable date..</small>");
                                $("#Error_"+ref).show();
                                return false;
                          }
                              else {
                                console.log(47);
                                  //SECOND DATE MUST BE BIGGER
                                    $("."+ref).css("border","2px solid green");
                                    $("#Error_"+ref).hide();
                                    return true;
                                    }
                     }
                     else
                        { console.log(57);

                          $("."+ref).css("border","2px solid green");
                          $("#Error_"+ref).hide();
                          return true;
                        }






                  } else {

                    if (dateCheckRequired(SecondDate)==true) //CHECK IF THE DATE IS VALID OR not GREATER THAN NOW
                    {    console.log(17);
                           if ($("."+firstDate).val()!='') {
                              console.log(27);
                                if ( isFirstDateGreaterThanSecDate($("."+firstDate).val(),sec_Date) ==false)
                                {    console.log(37);
                                    // THIS WILL RUN HERE ONLY IF THE FIRST IS BIGGER
                                      $("."+ref).css("border","2px solid red");
                                      $("#Error_"+ref).html("<small style='color:red'>Inconcievable date..</small>");
                                      $("#Error_"+ref).show();
                                      return false;
                                }
                                    else {
                                      console.log(47);
                                        //SECOND DATE MUST BE BIGGER
                                          $("."+ref).css("border","2px solid green");
                                          $("#Error_"+ref).hide();
                                          return true;
                                          }
                           }
                           else
                              { console.log(57);

                                $("."+ref).css("border","2px solid green");
                                $("#Error_"+ref).hide();
                                return true;
                              }
                    }else{
                        console.log(67);
                          return false;// THE DATE IS BIGGER THAN NOW
                        }

                        }





     }
      else
        {
            //$("."+ref).css("border","2px solid green");
            $("#Error_"+ref).hide();
            return true;
        }
 }




  function isfirstDateGreaterThanSecondDate(firstDate,SecondDate)
   {   //   TESTING FOR TRUE

      var ref=SecondDate;
      var pickUpDate= $("."+SecondDate).val();
      if (pickUpDate!='')
         {
                  if (dateCheckRequired(SecondDate)==true) //CHECK IF THE DATE IS VALID OR not GREATER THAN NOW
                  {    console.log("a");
                         if ($("."+firstDate).val()!='') {
                            console.log("b");
                              if ( isFirstDateGreaterThanSecDate($("."+firstDate).val(),pickUpDate) ==false)
                              {    console.log("ab");
                                  // THIS WILL RUN HERE ONLY IF THE FIRST IS BIGGER
                                    $("."+ref).css("border","2px solid red");
                                    $("#Error_"+ref).html("<small style='color:red'>Inconcievable date..</small>");
                                    $("#Error_"+ref).show();
                                    return false;
                              }
                                  else {
                                    console.log("c");
                                      //SECOND DATE MUST BE BIGGER
                                        $("."+ref).css("border","2px solid green");
                                        $("#Error_"+ref).hide();
                                        return true;
                                        }
                         }
                         else
                            { console.log("d");

                              $("."+ref).css("border","2px solid green");
                              $("#Error_"+ref).hide();
                              return true;
                            }
                  }else{ console.log("e");
                        return false;// THE DATE IS BIGGER THAN NOW
                       }
       }
        else
          {
            $("."+ref).css("border","2px solid red");
            $("#Error_"+ref).html("<small style='color:red'>Date is mandatory..</small>");
            $("#Error_"+ref).show();
            return false;
          }
  }





  function isfirstDateGreaterThanSecondPendingDate(firstDate,SecondDate)
  {   //   TESTING FOR TRUE

     var ref=SecondDate;
     var sec_Date= $("."+SecondDate).val();
     if (sec_Date!='')
        {


            var today = new Date();

                 if (new Date(sec_Date) >= new Date(today)) //CHECK IF THE DATE IS VALID
                 {    console.log("a");
                        if ($("."+firstDate).val()!='') {
                           console.log("b");
                             if ( isFirstDateGreaterThanSecDate($("."+firstDate).val(),sec_Date) ==false)
                             {    console.log("ab");
                                 // THIS WILL RUN HERE ONLY IF THE FIRST IS BIGGER
                                   $("."+ref).css("border","2px solid red");
                                   $("#Error_"+ref).html("<small style='color:red'>Inconcievable date..</small>");
                                   $("#Error_"+ref).show();
                                   return false;
                             }
                                 else
                                      {
                                        console.log("c");
                                        //SECOND DATE MUST BE BIGGER
                                        $("."+ref).css("border","2px solid green");
                                        $("#Error_"+ref).hide();
                                        return true;
                                       }
                        }
                        else
                           {
                            console.log("d");
                             $("."+ref).css("border","2px solid green");
                             $("#Error_"+ref).hide();
                             return true;
                           }
                 }else{
                        console.log("e");
                        $("."+ref).css("border","2px solid red");
                        $("#Error_"+ref).html("<small style='color:red'>Inconcievable date..</small>");
                        $("#Error_"+ref).show();
                        return false;

                      }
      }else if (!$(".postmortem_date").prop("disabled") && sec_Date=='') {
            $("."+ref).css("border","2px solid red");
            $("#Error_"+ref).html("<small style='color:red'>Inconcievable date..</small>");
            $("#Error_"+ref).show();
            return false;
      }
       else
         {
            $("."+ref).css("border","2px solid green");
            $("#Error_"+ref).hide();
            return true;
         }
 }




 function isfirstDateGreaterThanSecondCompletedDate(firstDate,SecondDate)
 {   //   TESTING FOR TRUE

    var ref=SecondDate;
    var pickUpDate= $("."+SecondDate).val();
    if (pickUpDate!='')
       {
                if (dateCheckRequired(SecondDate)==true) //CHECK IF THE DATE IS VALID OR not GREATER THAN NOW
                {    console.log("a");
                       if ($("."+firstDate).val()!='') {
                          console.log("b");
                            if ( isFirstDateGreaterThanSecDate($("."+firstDate).val(),pickUpDate) ==false)
                            {    console.log("ab");
                                // THIS WILL RUN HERE ONLY IF THE FIRST IS BIGGER
                                  $("."+ref).css("border","2px solid red");
                                  $("#Error_"+ref).html("<small style='color:red'>Inconcievable date..</small>");
                                  $("#Error_"+ref).show();
                                  return false;
                            }
                                else {
                                  console.log("c");
                                    //SECOND DATE MUST BE BIGGER
                                      $("."+ref).css("border","2px solid green");
                                      $("#Error_"+ref).hide();
                                      return true;
                                      }
                       }
                       else
                          { console.log("d");

                            $("."+ref).css("border","2px solid green");
                            $("#Error_"+ref).hide();
                            return true;
                          }
                }else{ console.log("e");
                      return false;// THE DATE IS BIGGER THAN NOW
                     }
     }
      else
        {
            $("."+ref).css("border","2px solid green");
            $("#Error_"+ref).hide();
            return true;
        }
}


/// IO


function requireDropDown(myVa){ 
    if ($("."+myVa).val()=='') {
        $("."+myVa).css("border","2px solid red");
        $("#Error_"+myVa).html("<small style='color:red'>Required..</small>");
          $("#Error_"+myVa).show();
        return  false;
    } else {
        $("."+myVa).css("border","2px solid green");
        $("#Error_"+myVa).hide();
        return   true;
    }
}
//////////////////////

//Morgue Section





$(".postmortem_date").attr("disabled", true);
$(".finger_print_date").attr("disabled", true);
$(".pauper_burial_requested_date").attr("disabled", true);

$(".burial_date").attr("disabled", true);
$(".gazetted_date").attr("disabled", true);











// var cr_no =

function diaryType() {
 
    if ($(".diary_type").val().length < 1) {
        $(".diary_type").css("border","2px solid red");
        $("#Error_diary_type").html("<small style='color:red'>Required..</small>");
          $("#Error_diary_type").show();
          diary_type= false;
    } else {
        $(".diary_type").css("border","2px solid green");
        $("#Error_diary_type").hide();
        diary_type=   true;
    }

}

function  contactNumberValidate(num) {
    var phoneNumber =$("."+num).val();
        if ( phoneNumber!="") {
                if (phoneNumber.length ==9)
                                {
                                    $("."+num).css("border","2px solid green");
                                    $("#Error_"+num).hide();
                                    num=  true;
                                } else {

                                        $("#Error_"+num).html("<small style='color:red'> *only 10 digits... </small>");
                                        $("#Error_"+num).show();
                                        $("."+num).css("border","2px solid red");
                                        num=  false;
                                        }
     } else{
        $("."+num).css("border","2px solid green");
        $("#Error_"+num).hide();
        num=  true;
           }

}



function investigatorContact(evt)
{
   var charCode = (evt.which) ? evt.which : evt.keyCode;
   if (charCode != 46 && charCode > 31   && (charCode < 48 || charCode > 57))
       {
          return false;
        }else{
            contactNum();
     }
}


function docContact(evt)
{
   var charCode = (evt.which) ? evt.which : evt.keyCode;
   if (charCode != 46 && charCode > 31   && (charCode < 48 || charCode > 57))
       {
          return false;
        }else{
            contactNumberValidate('dr_contact');
     }
}

function nextOfKinContact(evt)
{
   var charCode = (evt.which) ? evt.which : evt.keyCode;
   if (charCode != 46 && charCode > 31   && (charCode < 48 || charCode > 57))
       {
          return false;
        }else{
            contactNumberValidate('next_of_kin_contact');
     }
}



function isNumberKey(evt)
{
   var charCode = (evt.which) ? evt.which : evt.keyCode;
   if (charCode != 46 && charCode > 31   && (charCode < 48 || charCode > 57))
       {
          return false;
        }else{
            diaryNo();
     }
}

function diaryNo() {

    var value= $(".diary_no").val();
    if ($(".diary_no").val().length < 1) {
        $(".diary_no").css("border","2px solid red");
        $("#Error_diary_no").html("<small style='color:red'>Required.</small>");
          $("#Error_diary_no").show();
          diary_no=  false;
    } else {
        $(".diary_no").css("border","2px solid green");
        $("#Error_diary_no").hide();
        diary_no=   true;
    }

}






 function entryDate()
 {
    if ( secondDateMustGrater("dob","entry_date") ==true && secondDateMustGrater("death_date","entry_date")  ==true  ) {
        entry_date =true;
     } else {
         entry_date =false;
     }


}
























function postmortemStatus(){
    if (requireDropDown("postmortem_status"))
       {   var post_status= $(".postmortem_status").val();
                 //   if (post_status==="Completed"|| post_status==="Pending") {

                        if (post_status==="Completed") {
                            $(".postmortem_date").attr("disabled", false);
                            postmortem_date=false
                            buried=false;
                            $(".buried").attr("disabled", false);
                            $(".pathlogist").attr("disabled", false);
                            $(".cause_of_Death").attr("disabled", false);
                            return postmortem_status=true;

                        }else if (post_status==="Pending") {
                            postmortem_date=false;
                            if ($(".buried").val()==="Yes") {
                              $(".buried").val("No");
                              $(".burial_date").val("");
                              $(".burial_date").attr("disabled", true);
                            }
                            resetDisable("pathlogist");
                            resetDisable("cause_of_Death");

                            $(".buried").attr("disabled", true);
                            $(".postmortem_date").attr("disabled", false);
                            return postmortem_status=true;
                        }


                     else if ( post_status==="Not Required") {
                             buried=false;
                             $(".buried").attr("disabled", false);
                             $(".postmortem_date").attr("disabled", true);
                             $(".cause_of_Death").attr("disabled", false);
                             resetDisable("postmortem_date");
                             resetDisable("pathlogist");
                             return postmortem_status=true;

                        }


       } else {
                postmortem_date=true;
                resetDisable("postmortem_date");
                return postmortem_status=false;
             }

}




function setDobDisable(){
if ($(".dob").val()!='') {

} else {
    $(".dob").attr("disabled", true);
}



}

function isTrueCheckRequireDrop(status, dateField)
{
    if (requireDropDown(status))
       {
                if ($("."+status).val()==="Yes")
                 {

                     $("#Error_"+status+"_date").hide();
                    $("."+status+"_date").css({"border":""});
                     $("."+status+"_date").attr("disabled", false);
                    return true;

                    } else  if ($("."+status).val()==="No")
                                {
                                      resetDateErorrBorder(status);
                                      return true;

                                }
                                    else
                                        {
                                            $("."+status+"_date").val("");
                                            $("#Error_"+status+"_date").hide();
                                            $("."+status+"_date").css({"border":""});
                                            $("."+status+"_date").attr("disabled", true);
                                            return  false;
                                        }
       } else
             {

               return  false;
             }
}






function isTrueCheckRequireDropBurial(status)
{

    if ($(".postmortem_status").val()==="Pending") {
        return true;
    } else {

        if (requireDropDown(status))
       {
                if ($("."+status).val()==="Yes")
                 {

                    $("#Error_burial_date").hide();
                    $(".burial_date").css({"border":""});
                    $(".burial_date").attr("disabled", false);;
                    return true;

                    } else  if ($("."+status).val()==="No")
                                {   burial_date=true;
                                    $(".burial_date").val("");
                                    $("#Error_burial_date").hide();
                                    $(".burial_date").css({"border":""});
                                    $(".burial_date").attr("disabled", true);
                                     return true;
                                }
                                    else
                                        {
                                            $(".burial_date").val("");
                                            $("#Error_burial_date").hide();
                                            $(".burial_date").css({"border":""});
                                            $(".burial_date").attr("disabled", true);
                                            return  false;
                                        }
       } else
             {
                 $(".burial_date").val("");
                 $(".burial_date").attr("disabled", true);
                 $("#Error_burial_date").hide();
                 $(".burial_date").css({"border":""});
               return  false;
             }
    }
    }













// function SetDateNull(className) {
//     checkValue= $("."+className).val();
//     if ( checkValue =='' || checkValue.length < 3 || checkValue == null) {
//         var dd=null;
//        $("."+className).val(dd);
//        checkValue= $("."+className).val();
//     }

// }



function SetUnidentify(className) {
     checkValue= $("."+className).val();
     if ( checkValue =='' || checkValue.length < 3 || checkValue == null) {
        $("."+className).val("Unidentified");
        $("."+className).attr("disabled",false);
     }

}




function SetUnKnown(className) {
    checkValue= $("."+className).val();
    if ( checkValue =='' || checkValue.length < 3 || checkValue == null) {
       $("."+className).val("UNKNOWN");
       $("."+className).attr("disabled",false);
    }

}



function SetPathologist(className) {
    checkValue= $("."+className).val();
    if ( checkValue =='' || checkValue.length < 3 || checkValue == null) {
       $("."+className).val("No Post-Mortem");
       $("."+className).attr("disabled",false);

    }

}


function SetRequestStatus(className) {
    checkValue= $("."+className).val();
    if ( checkValue ==''   || checkValue == null) {
       $("."+className).val("No");
       $("."+className).attr("disabled",false);

    }

}





function SetBuried() {
    checkValue= $(".buried").val();
    if ( checkValue =='' || checkValue == null) {
        $(".buried").val("No");
        $(".buried").attr("disabled",false);
    }

}




function SetApprovalStatus(className) {
    checkValue= $("."+className).val();
    if ( checkValue =='' ||  checkValue == null) {
       $("."+className).val("No Request");

       $("."+className).attr("disabled",false);


    }

}




function SetUnidentifiNation(className) {
    checkValue= $("."+className).val();
    if (checkValue =="" || checkValue.length < 3 || checkValue == null) {
       $("#nationality").val("Default Jamaica");

    }else{
        $("#nationality").val(checkValue);

    }

}

function SetCauseOfDeath(className) {
    checkValue= $("."+className).val();
    if (checkValue=='') {
       $("."+className).val("NO POSTMORTEM INFO..");
       $("."+className).attr("disabled",false);
    }

}







function funeralHome() {
    funeralhome_id= requireDropDown("funeralhome_id");

}

//////////////////////////

function investigator_stn()
{
       station_id=  requireDropDown("station_id");
}


function investigatorRank(){
      rank_id=  requireDropDown("rank_id");

}



function investigator(myClass)
{      var letters = /^[a-zA-Z_ ]*$/;

    namex=$("."+myClass).val();
    var my_val= $.trim(namex.length);
   if (my_val!=0)
       {
         if(my_val < 3 || my_val > 15) {
            $("#Error_"+myClass).html("<small style='color:red'>Should be between 3-15 letters</small>");
            $("#Error_"+myClass).show();
            $("."+myClass).css("border","2px solid red");
            return false;
          }
        //   else if( namex.indexOf(' ')>=0)
        //     {
        //         $("#Error_"+myClass).html("<small style='color:red'>No spacing required... </small>");
        //         $("#Error_"+myClass).show();
        //         $("."+myClass).css("border","2px solid red");
        //         return false;

        //     }
            else if(!letters.test(namex)){
                    $("#Error_"+myClass).html("<small style='color:red'>Only letters allowed... </small>");
                    $("#Error_"+myClass).show();
                    $("."+myClass).css("border","2px solid red");
                   return false;
                }else{
                    $("."+myClass).css("border","2px solid green");
                    $("#Error_"+myClass).hide();
                    return   true;
                }

    }  else
          {
            $("#Error_"+myClass).html("<small style='color:red'> is allowed here... </small>");
            $("#Error_"+myClass).show();
            $("."+myClass).css("border","2px solid red");
            return  false;
           }

}



function investFirstName(myClass) {
    investigator_first_name= investigator(myClass) ;
}
function investLastName(myClass) {
    investigator_last_name= investigator(myClass) ;
}



function validatePhone(phoneNumber){
    var phoneNumberPattern = /(\d{1,2}[-\s]?)?(\d{3}[-]?){2}\d{4}/ ;
    return phoneNumberPattern.test(phoneNumber);

 }


 function validateRegNum(validateRegNum){
    var validateRegNumPattern = /^(\(?\+?[0-9]*\)?)?[0-9_\- \(\)]*$/ ;
    return validateRegNumPattern.test(validateRegNum);

 }



function contactNum() {
    var phoneNumber =$(".contact_no").val();
        if ( phoneNumber!="") {

                    //  if (validatePhone(phoneNumber)) {
                                if (phoneNumber.length==10)
                                {
                                    $(".contact_no").css("border","2px solid green");
                                    $("#Error_contact_no").hide();
                                   return  contact_no=  true;
                                } else {

                                        $("#Error_contact_no").html("<small style='color:red'> *only 10 digits... </small>");
                                        $("#Error_contact_no").show();
                                        $(".contact_no").css("border","2px solid red");
                                        return   contact_no=  false;
                                        }

                       // }
                        // else{
                        //     $("#Error_contact_no").html("<small style='color:red'> Invalid format... </small>");
                        //     $("#Error_contact_no").show();
                        //     $(".contact_no").css("border","2px solid red");
                        //     return  false;
                        //     }

     } else{
            $("#Error_contact_no").html("<small style='color:red'> Required... </small>");
            $("#Error_contact_no").show();
            $(".contact_no").css("border","2px solid red");
            return  contact_no=  false;
           }

}






















function regulationNum() {
    var regNo =$(".regNum").val();
        if ( regNo!="") {


                     if (regNo >0) {

                                  if (validateRegNum(regNo)) {
                                    if (regNo.length <=6 && regNo.length >=3)
                                    {
                                        $(".regNum").css("border","2px solid green");
                                        $("#Error_regNum").hide();
                                        return   true;
                                    } else {

                                            $("#Error_regNum").html("<small style='color:red'> Invalid number... </small>");
                                            $("#Error_regNum").show();
                                            $(".regNum").css("border","2px solid red");
                                            return  false;
                                            }

                            }
                            else{
                                $("#Error_regNum").html("<small style='color:red'> Invalid number... </small>");
                                $("#Error_regNum").show();
                                $(".regNum").css("border","2px solid red");
                                return  false;
                                }
                                  
                     } else {
                            $("#Error_regNum").html("<small style='color:red'> Invalid number... </small>");
                            $("#Error_regNum").show();
                            $(".regNum").css("border","2px solid red");
                            return  false;
                       
                     }

                  

     } else{
            $("#Error_regNum").html("<small style='color:red'> is allowed here... </small>");
            $("#Error_regNum").show();
            $(".regNum").css("border","2px solid red");
            return  false;
           }

}






function pathlogistName(myClass)
{
    var letters =/^([\w-]+) *(?!(Jr|Sr|III))(\w+)?$|^([\w-]+)( \w+)? (Jr|Sr|III)$/;

    namex=$("."+myClass).val();
    var my_val= $.trim(namex.length);
   if (my_val!=0)
       {
         if(my_val < 3 || my_val > 25) {
            $("#Error_"+myClass).html("<small style='color:red'>Should be between 3-25 letters</small>");
            $("#Error_"+myClass).show();
            $("."+myClass).css("border","2px solid red");
            return false;
          }
        //   else if( namex.indexOf(' ')>=0)
        //     {
        //         $("#Error_"+myClass).html("<small style='color:red'>No spacing required... </small>");
        //         $("#Error_"+myClass).show();
        //         $("."+myCFlass).css("border","2px solid red");
        //         return false;

        //     }

            // else if(!letters.test(namex)){
            //         $("#Error_"+myClass).html("<small style='color:red'>Only letters allowed... </small>");
            //         $("#Error_"+myClass).show();
            //         $("."+myClass).css("border","2px solid red");
            //        return false;
            //     }

                else{
                    $("."+myClass).css("border","2px solid green");
                    $("#Error_"+myClass).hide();

                    return   true;

                }

    }else   if (my_val <= 0 && !$(".pathlogist").prop("disabled"))
             {
                $("#Error_"+myClass).html("<small style='color:red'> Now *required</small>");
                $("#Error_"+myClass).show();
                $("."+myClass).css("border","2px solid red");
                return false;
             }

    else
          {

            $("#Error_"+myClass).hide();
            return   true;
           }

}







$(function() {

	$("#username_error_message").hide();
	$("#password_error_message").hide();
	$("#retype_password_error_message").hide();
    $("#email_error_message").hide();





	var error_username = false;
	var error_password = false;
	var error_retype_password = false;
	var error_email = false;

	$(".first_name").focusout(function() {
    first_name  =  name("first_name","first_name");
    });

	$(".first_name").keyup(function() {
     first_name  =  name("first_name","first_name");
     });


     $(".middle_name").focusout(function() {
        middle_name =  middleName("middle_name","middle_name");
     });

     $(".middle_name").keyup(function() {
        middle_name =  middleName("middle_name","middle_name");
      });



      $(".suspected_name").focusout(function() {
        suspected_name = suspectedName("suspected_name","suspected_name");
     });

     $(".suspected_name").keyup(function() {
        suspected_name =  suspectedName("suspected_name","suspected_name");
      });





      $(".last_name").focusout(function() {
        last_name  = name("last_name","last_name");
     });


     $(".last_name").keyup(function() {
        last_name  = name("last_name","last_name");
      });



           ////////  ADDRESS
      $(".address").focusout(function() {
        address = corpseAddress("address","address");
     });


     $(".address").keyup(function() {
        address =  corpseAddress("address","address");
      });


        ////////  ADDRESS
        $(".summary").focusout(function() {
          case_summary();
      });


      $(".summary").keyup(function() {
         case_summary();
      });
        

     



      $(".death_date").focusout(function() {
        death_date  =    secondDateMustGrater("dob","death_date");
     });


     $(".death_date").mouseleave(function() {
        death_date  =  secondDateMustGrater("dob","death_date");
      });


      $(".dob").focusout(function() {
        dob =    date_of_birth("death_date","dob");

     });


     $(".dob").mouseleave(function() {
        dob  =  date_of_birth("death_date","dob");

      });










      $(".volume_no").focusout(function() {
        volumeNo();
     });

     $(".volume_no").mouseleave(function() {
      volumeNo();
      });


  



      $(".entry_date").focusout(function() {
        entryDate();

     });


     $(".entry_date").mouseleave(function() {
        entryDate();

      });


      $(".diary_no").focusout(function() {

        diaryNo();

     });


     $(".diary_no").mouseleave(function() {

        diaryNo();

      });












/////SECTION TWO





$(".pickup_date").focusout(function() {
     checkPickUpdate("death_date","pickup_date");
 });


 $(".pickup_date").mouseleave(function() {
     checkPickUpdate("death_date","pickup_date");

  });



  $(".pickup_location").focusout(function() {
    pickup_location = pickupLocation("pickup_location");
 });


 $(".pickup_location").keyup(function() {
    pickup_location = pickupLocation("pickup_location");

  });



///I.O



  $(".investigator_first_name").focusout(function() {

    investFirstName("investigator_first_name");
 });


 $(".investigator_first_name").keyup(function() {

    investFirstName("investigator_first_name");
  });




  $(".investigator_last_name").focusout(function() {
    investLastName("investigator_last_name");
   });


 $(".investigator_last_name").keyup(function() {
    investLastName("investigator_last_name");
  });




  $(".contact_no").focusout(function() {
     contactNum();
   });


 $(".contact_no").keyup(function() {
    contactNum();
  });



  $(".regNum").focusout(function() {
    regNum=   regulationNum();
   });


 $(".regNum").keyup(function() {
    regNum=  regulationNum();
  });



  $(".assign_date").focusout(function() {
    assign_date =    isfirstDateGreaterThanSecondDate("pickup_date","assign_date");
 });


 $(".assign_date").mouseleave(function() {
    assign_date  =  isfirstDateGreaterThanSecondDate("pickup_date","assign_date");

  });




//// MORGUE SECTION













$(".pathlogist").focusout(function() {
    pathlogist =  pathlogistName("pathlogist");
 });


 $(".pathlogist").keyup(function() {
     pathlogist =  pathlogistName("pathlogist");

  });



  $(".cause_of_Death").focusout(function() {
    cause_of_Death =   causeOfDeath("cause_of_Death");
 });


 $(".cause_of_Death").keyup(function() {
    cause_of_Death =   causeOfDeath("cause_of_Death");

  });

////////////////////////

  $(".postmortem_date").focusout(function() {
    postmortem_date =   postMortemDate();
 });


 $(".cause_of_Death").keyup(function() {
    postmortem_date =   postMortemDate();

  });


  $(".dna_result").focusout(function() {
    dnaResult();
 });


 $(".dna_result").keyup(function() {
  dnaResult();

  });



////////////////////////

$(".finger_print_date").focusout(function() {
      fingerPrintDate();
});


$(".finger_print_date").mouseleave(function() {
      fingerPrintDate();

});





$(".dna_date").focusout(function() {
    dnaDate();
});


$(".dna_date").mouseleave(function() {
    dnaDate();

});





$(".dna_result_date").focusout(function() {
  dnaResultDate();
});


$(".dna_result_date").mouseleave(function() {
  dnaResultDate();

});




$(".gazetted_date").focusout(function() {
    gazettedDate();

});


$(".gazetted_date").mouseleave(function() {
    gazettedDate();

});






$(".pauper_burial_requested_date").focusout(function() {
    pauperBurialRequestedDate();

});


$(".pauper_burial_requested_date").mouseleave(function() {
    pauperBurialRequestedDate();

});










$(".burial_date").focusout(function() {
    burialDate();

});

$(".burial_date").mouseleave(function() {
    burialDate();

});




    });//END





