var unidentified=!1,first_name=!1,middle_name=!1,last_name=!1,sex=!1,corpseCountry=!1,death_date=!0,address=!1,summary=!1,parish=!1,corpse_stn_id=!1,dob=!0,diary_type=!1,diary_no=!1,entry_date=!1,pickup_date=!1,condition=!1,type_death=!1,manner_death=!1,anatomy=!1,pickup_location=!1,station_id=!1,contact_no=!1,assign_date=!1,investigator_last_name=!1,investigator_first_name=!1,rank_id=!1,regNum=!1,body_status=!1,postmortem_status=!1,postmortem_date=!0,funeralhome_id=!1,pathlogist=!1,cause_of_Death=!1,finger_print_date=!0,finger_print=!1,gazetted=!1,gazetted_date=!0,volume_no=!0,pauper_burial_requested=!1,pauper_burial_requested_date=!0,buried=!1,burial_date=!0,dna=!1,dna_date=!0,dna_result_date=!0,dna_result=!0,isCrNoUnique=!1;function deadBodyStatus(){return bodyStatus=$(".body_status").val(),body_status=bodyStatus.length<1?($(".body_status").css("border","2px solid red"),$("#Error_body_status").html("<small style='color:red'>Choose an option..</small>"),$("#Error_body_status").show(),!1):($(".body_status").css("border","2px solid green"),$("#Error_body_status").hide(),console.log(bodyStatus),!0)}function is_dna(){requireDropDown("dna")?"Yes"===$(".dna").val()?($("#Error_dna_date").hide(),$(".dna_date").css({border:""}),$(".dna_date").attr("disabled",!1),dna=!0):"No"===$(".dna").val()?(dna_date=dna=!0,resetDateErorrBorder("dna"),$(".dna_date").val(""),$("#Error_dna_date").hide(),$(".dna_date").css({border:""}),$(".dna_date").attr("disabled",!0),$(".dna_result_date").val(""),$("#Error_dna_result_date").hide(),$(".dna_result_date").css({border:""}),$(".dna_result_date").attr("disabled",!0),dna_result_date=!0,$(".dna_result").val(""),$("#Error_dna_result").hide(),$(".dna_result").css({border:""}),$(".dna_result").attr("disabled",!0),dna_result=!0):($(".dna_date").val(""),$("#Error_dna_date").hide(),$(".dna_date").css({border:""}),$(".dna_date").attr("disabled",!0),dna_date=!1):dna=!1}function dnaDate(){$(".dna_date").prop("disabled")||(1==isfirstDateGreaterThanSecondDate("pickup_date","dna_date")?(dna_date=!0,$(".dna_result_date").attr("disabled",!1)):(dna_date=!1,resetDateErorrBorderDna()))}function dnaResultDate(){$(".dna_result_date").prop("disabled")?dna_result_date=!0:""!=$(".dna_result_date").val()?1==isfirstDateGreaterThanSecondDate("dna_date","dna_result_date")?(dna_result_date=!0,$(".dna_result").attr("disabled",!1)):(dna_result_date=!1,resetErorrBorderDnaResult()):(dna_result_date=!0,resetErorrBorderDnaResult())}function fingerPrint(){requireDropDown("finger_print")?"Yes"===$(".finger_print").val()?($("#Error_finger_print_date").hide(),$(".finger_print_date").css({border:""}),$(".finger_print_date").attr("disabled",!1),finger_print=!0):"No"===$(".finger_print").val()?(finger_print_date=finger_print=!0,resetDateErorrBorder("finger_print")):($(".finger_print_date").val(""),$("#Error_finger_print_date").hide(),$(".finger_print_date").css({border:""}),$(".finger_print_date").attr("disabled",!0),finger_print_date=!1):finger_print=!1}function deathDropDown(){death=isTrueCheckRequireDrop("death",death_date)}function isGazetted(){requireDropDown("gazetted")?"Yes"===$(".gazetted").val()?($("#Error_gazetted_date").hide(),$(".gazetted_date").css({border:""}),$(".gazetted_date").attr("disabled",!1),$(".volume_no").attr("disabled",!1),gazetted=!0,$(".volume_no").css({border:""}),$(".volume_no").attr("disabled",!1)):"No"===$(".gazetted").val()?(volume_no=gazetted_date=gazetted=!0,$("#Error_volume_no").hide(),$(".volume_no").css({border:""}),$(".volume_no").attr("disabled",!0),resetDateErorrBorder("gazetted")):($(".gazetted_date").val(""),$("#Error_gazetted_date").hide(),$(".gazetted_date").css({border:""}),$(".gazetted_date").attr("disabled",!0),volume_no=!(gazetted_date=!1)):gazetted=!1}function volumeNo(){var e="volume_no";if(!$("."+e).prop("disabled")){volume_no=!1;var r=$.trim($("."+e).val().length);volume_no=r<=0?($("#Error_"+e).html("<small style='color:red'>*Required</small>"),$("#Error_"+e).show(),$("."+e).css("border","2px solid red"),!1):0<r&&r<2||15<r?($("#Error_"+e).html("<small style='color:red'>Should be between 2-15 characters</small>"),$("#Error_"+e).show(),$("."+e).css("border","2px solid red"),!1):($("."+e).css("border","2px solid green"),$("#Error_"+e).hide(),!0)}}function pauperBurialRequested(){"Pending"===$(".postmortem_status").val()?pauper_burial_requested_date=pauper_burial_requested=!0:requireDropDown("pauper_burial_requested")?"Yes"===$(".pauper_burial_requested").val()?($("#Error_pauper_burial_requested").hide(),$(".pauper_burial_requested_date").css({border:""}),$(".pauper_burial_requested_date").attr("disabled",!1),pauper_burial_requested=!0):"No"===$(".pauper_burial_requested").val()?(pauper_burial_requested_date=pauper_burial_requested=!0,resetDateErorrBorder("pauper_burial_requested")):($(".pauper_burial_requested_date").val(""),$("#Error_pauper_burial_requested").hide(),$(".pauper_burial_requested_date").css({border:""}),$(".pauper_burial_requested_date").attr("disabled",!0),pauper_burial_requested_date=!1):pauper_burial_requested=!1}function pauperBurialApprovedDropDown(e){var r=$("."+e).val();return $("."+e).val().length<1||""==r||null==r?($("."+e).css("border","2px solid red"),$("#Error_"+e).html("<small style='color:red'>Choose an option..</small>"),$("#Error_"+e).show(),!1):($("."+e).css("border","2px solid green"),$("#Error_"+e).hide(),!0)}function isBuried(){buried=isTrueCheckRequireDropBurial("buried")}function gender(){var e=$(".sex").val();return sex=e.length<1?($(".sex").css("border","2px solid red"),$("#Error_sex").html("<small style='color:red'>Choose an option..</small>"),$("#Error_sex").show(),!1):($(".sex").css("border","2px solid green"),$("#Error_sex").hide(),!0)}function country(){var e=$(".corpseCountry").val();return corpseCountry=e.length<1?($(".corpseCountry").css("border","2px solid red"),$("#Error_corpseCountry").html("<small style='color:red'>Choose an option..</small>"),$("#Error_corpseCountry").show(),!1):($(".corpseCountry").css("border","2px solid green"),$("#Error_corpseCountry").hide(),!0)}function resetValue(){dob=!(address=corpseCountry=last_name=middle_name=first_name=!1)}function is_unidentiied(){return unidentified="Yes"==$("#unidentified").val()?($(".first_name").val(""),$(".middle_name").val(""),$(".middle_name").val(""),$(".last_name").val(""),$(".dob").val(""),$(".corpseCountry").val(""),$(".suspected_name").attr("disabled",!1),resetValue(),$("#Error_first_name").html(""),$("#Error_middle_name").html(""),$("#Error_middle_name").html(""),$("#Error_last_name").html(""),$("#Error_dob").html(""),$("#Error_corpseCountry").html(""),$("#Error_address").html(""),$(".first_name").css({border:""}),$(".middle_name").css({border:""}),$(".last_name").css({border:""}),$(".dob").css({border:""}),$(".corpseCountry").css({border:""}),$(".first_name").attr("disabled",!0),$(".last_name").attr("disabled",!0),$(".middle_name").attr("disabled",!0),$(".dob").attr("disabled",!0),$(".corpseCountry").attr("disabled",!0),$(".unidentified").css("border","2px solid green"),$("#Error_unidentified").hide(),!0):("No"===$("#unidentified").val()?(enableSeciontOneTxt(),$(".unidentified").css("border","2px solid green"),$(".suspected_name").css("border",""),$("#Error_suspected_name").html(""),$(".suspected_name").val(""),$("#Error_unidentified").hide(),$(".suspected_name").attr("disabled",!0),suspected_name=!0):(""==$("#unidentified").val()&&($(".unidentified").css("border","2px solid red"),$("#Error_unidentified").html("<small style='color:red'>Choose an option..</small>"),$("#Error_unidentified").show()),enableSeciontOneTxt()),!1)}function enableSeciontOneTxt(){$(".first_name").attr("disabled",!1),$(".middle_name").attr("disabled",!1),$(".middle_name").attr("disabled",!1),$(".last_name").attr("disabled",!1),$(".dob").attr("disabled",!1),$(".corpseCountry").attr("disabled",!1)}function name(e,r){if(!$("."+e).prop("disabled")){namex=$("."+e).val();var t=$.trim(namex.length);return 0!=t?t<3||15<t?($("#Error_"+r).html("<small style='color:red'>Should be between 3-15 letters</small>"),$("#Error_"+r).show(),$("."+e).css("border","2px solid red"),!1):/^[A-Za-z]+$/.test(namex)?(t<=0?($("#Error_"+r).hide(),$("."+e).css({border:""})):($("."+e).css("border","2px solid green"),$("#Error_"+r).hide()),!0):($("#Error_"+r).html("<small style='color:red'>Only letters allowed... </small>"),$("#Error_"+r).show(),$("."+e).css("border","2px solid red"),!1):"No"===$("#unidentified").val()?($("#Error_"+r).html("<small style='color:red'> is allowed here... </small>"),$("#Error_"+r).show(),$("."+e).css("border","2px solid red"),!1):($("#Error_"+r).hide(),$("."+e).css({border:""}),!0)}}function suspectedName(e,r){if(!$("."+e).prop("disabled")){namex=$("."+e).val();var t=$.trim(namex.length);return 0!=t?t<3||15<t?($("#Error_"+r).html("<small style='color:red'>Should be between 3-15 letters</small>"),$("#Error_"+r).show(),$("."+e).css("border","2px solid red"),!1):(t<=0?($("#Error_"+r).hide(),$("."+e).css({border:""})):($("."+e).css("border","2px solid green"),$("#Error_"+r).hide()),!0):($("#unidentified").val(),$("#Error_"+r).hide(),$("."+e).css({border:""}),!0)}}function middleName(e,r){if(!$("."+e).prop("disabled")){namex=$("."+e).val();var t=$.trim(namex.length);return 0!=t?t<3||15<t?($("#Error_"+r).html("<small style='color:red'>Should be between 3-15 letters</small>"),$("#Error_"+r).show(),$("."+e).css("border","2px solid red"),!1):0<=namex.indexOf(" ")?($("#Error_"+r).html("<small style='color:red'>No spacing required... </small>"),$("#Error_"+r).show(),$("."+e).css("border","2px solid red"),!1):/^[A-Za-z]+$/.test(namex)?(t<=0?($("#Error_"+r).hide(),$("."+e).css({border:""})):($("."+e).css("border","2px solid green"),$("#Error_"+r).hide()),!0):($("#Error_"+r).html("<small style='color:red'>Only letters allowed... </small>"),$("#Error_"+r).show(),$("."+e).css("border","2px solid red"),!1):($("#unidentified").val(),$("#Error_"+r).hide(),$("."+e).css({border:""}),!0)}}function case_summary(){var e=$(".summary").val(),r="summary",t=$.trim(e.length);return summary=1<t?t<7||1e3<t?($("#Error_"+r).html("<small style='color:red'>Should be between 7-1000 letters</small>"),$("#Error_"+r).show(),$("."+r).css("border","2px solid red"),!1):($("."+r).css("border","2px solid green"),$("#Error_"+r).hide(),!0):($("#Error_"+r).html("<small style='color:red'> circumstances unknown would suffice !</small>"),$("#Error_"+r).show(),$("."+r).css("border","2px solid red"),!1)}function corpseAddress(e,r){namex=$("."+e).val();var t=$.trim(namex.length);return 0<t?t<4||150<t?($("#Error_"+r).html("<small style='color:red'>Should be between 4-150 letters</small>"),$("#Error_"+r).show(),$("."+e).css("border","2px solid red"),!1):(t<=0?($("#Error_"+r).hide(),$("."+e).css({border:""})):($("."+e).css("border","2px solid green"),$("#Error_"+r).hide()),!0):($("."+e).css("border","2px solid yellow"),$("#Error_"+r).hide(),!0)}function isDateGreaterNow(e){var r=new Date;return new Date(e)>=new Date(r)}function isFirstDateGreaterThanSecDate(e,r){return new Date(e)==new Date(r)||!(new Date(e)>new Date(r))}function secDateNotGrater(e,r){return new Date(e)==new Date(r)||(new Date(e)>new Date(r)||!(new Date(e)<new Date(r))&&void 0)}function dateCheck(e){var r=e;return""!=$("."+e).val()?1==isDateGreaterNow($("."+e).val())?($("."+r).css("border","2px solid red"),$("#Error_"+r).html("<small style='color:red'> Can't be prior today..</small>"),$("#Error_"+r).show(),!1):($("."+r).css("border","2px solid green"),$("#Error_"+r).hide(),!0):($("."+r).css({border:""}),$("#Error_"+r).hide(),$("."+e).val(null),!0)}function resetDisable(e){return $("."+e).attr("disabled",!0),$("#Error_"+e).hide(),$("."+e).css({border:""}),$("."+e).val(""),!0}function resetDateErorrBorder(e){return $("."+e+"_date").attr("disabled",!0),$("#Error_"+e+"_date").hide(),$("."+e+"_date").css({border:""}),$("."+e+"_date").val(""),!0}function resetDateErorrBorderDna(){var e="dna_result_date";$("."+e).attr("disabled",!0),$("#Error_"+e).hide(),$("."+e).css({border:""}),$("."+e).val(""),dna_result_date=!0}function resetErorrBorderDnaResult(){var e="dna_result";$("."+e).attr("disabled",!0),$("#Error_"+e).hide(),$("."+e).css({border:""}),$("."+e).val(""),dna_result=!0}function postMortemDate(){"Pending"===$(".postmortem_status").val()?(postmortem_date=isfirstDateGreaterThanSecondPendingDate("pickup_date","postmortem_date"))&&(pauper_burial_requested=!0):"Completed"===$(".postmortem_status").val()?postmortem_date=""==$(".postmortem_date").val()?($(".postmortem_date").css("border","2px solid red"),$("#Error_postmortem_date").html("<small style='color:red'> required..</small>"),$("#Error_postmortem_date").show(),!1):isfirstDateGreaterThanSecondCompletedDate("pickup_date","postmortem_date"):"Not Required"===$(".postmortem_status").val()&&(postmortem_date=!0,resetDisable("pathlogist"))}function fingerPrintDate(){$(".finger_print_date").prop("disabled")||(finger_print_date=1==isfirstDateGreaterThanSecondDate("pickup_date","finger_print_date")&&1==isfirstDateGreaterThanSecondDateNotReq("finger_print_date","postmortem_date"))}function gazettedDate(){$(".gazetted_date").prop("disabled")||(gazetted_date=1==isfirstDateGreaterThanSecondDate("pickup_date","gazetted_date")&&1==isfirstDateGreaterThanSecondDateNotReq("gazetted_date","pauper_burial_requested_date"))}function pauperBurialRequestedDate(){$(".pauper_burial_requested_date").prop("disabled")||(pauper_burial_requested_date=1==isfirstDateGreaterThanSecondDate("pickup_date","pauper_burial_requested_date")&&1==isfirstDateGreaterThanSecondDate("postmortem_date","pauper_burial_requested_date"))}function burialDate(){$(".burial_date").prop("disabled")||(burial_date=1==isfirstDateGreaterThanSecondDate("pickup_date","burial_date")&&1==isfirstDateGreaterThanSecondDate("finger_print_date","burial_date")&&1==isfirstDateGreaterThanSecondDate("gazetted_date","burial_date")&&1==isfirstDateGreaterThanSecondDate("pauper_burial_requested_date","burial_date")&&1==isfirstDateGreaterThanSecondDate("postmortem_date","burial_date"))}function checkDob(e,r){var t=r,a=$("."+e).val(),o=$("."+r).val();if("No"==$("#unidentified").val())return""!=o?1==dateCheck(r)&&(""!=a?0==isFirstDateGreaterThanSecDate(a,o)?($("."+t).css("border","2px solid green"),$("#Error_"+t).hide(),!0):($("."+t).css("border","2px solid red"),$("#Error_"+t).html("<small style='color:red'>Inconcievable D.O.B post death..</small>"),$("#Error_"+t).show(),!1):($("."+t).css("border","2px solid green"),$("#Error_"+t).hide(),!0)):($("."+t).css("border","2px solid red"),$("#Error_"+t).html("<small style='color:red'>Inconcievable D.O.B post death..</small>"),$("#Error_"+t).show(),!1)}function secondDateMustGrater(e,r){var t=$("."+e).val(),a=$("."+r).val();return""!=a?1==dateCheck(r)&&(""!=t?1==isFirstDateGreaterThanSecDate(t,a)?($("."+r).css("border","2px solid green"),$("#Error_"+r).hide(),!0):($("."+r).css("border","2px solid red"),$("#Error_"+r).html("<small style='color:red'>Inconcievable date..</small>"),$("#Error_"+r).show(),!1):($("."+r).css("border","2px solid green"),$("#Error_"+r).hide(),!0)):($("."+r).css("border","2px solid yellow"),$("#Error_"+r).hide(),!0)}function date_of_birth(e,r){var t=r,a=$("."+e).val(),o=$("."+r).val();return""!=o?1==dateCheck(r)&&(""!=a?1==secDateNotGrater(a,o)?($("."+t).css("border","2px solid green"),$("#Error_"+t).hide(),!0):0==secDateNotGrater(a,o)?($("."+t).css("border","2px solid red"),$("#Error_"+t).html("<small style='color:red'>Inconcievable D.O.B post death..</small>"),$("#Error_"+t).show(),!1):($("."+t).css("border","2px solid green"),$("#Error_"+t).hide(),!0):($("."+t).css("border","2px solid green"),$("#Error_"+t).hide(),!0)):($("."+t).css("border","2px solid green"),$("#Error_"+t).hide(),!0)}function corpse_stn(){var e=$(".corpse_stn_id").val();return corpse_stn_id=e.length<1?($(".corpse_stn_id").css("border","2px solid red"),$("#Error_corpse_stn_id").html("<small style='color:red'>Required..</small>"),$("#Error_corpse_stn_id").show(),!1):($(".corpse_stn_id").css("border","2px solid green"),$("#Error_corpse_stn_id").hide(),!0)}function getRequiredField(e){return $("."+e).val().length<1?($("."+e).css("border","2px solid red"),$("#Error_"+e).html("<small style='color:red'>Choose an option..</small>"),$("#Error_"+e).show(),!1):($("."+e).css("border","2px solid green"),$("#Error_"+e).hide(),!0)}function CorpseCondition(){condition=getRequiredField("condition")}function typeDeath(){type_death=getRequiredField("type_death")}function mannerDeath(){manner_death=getRequiredField("manner_death")}function anotomMethod(){anatomy=getRequiredField("anatomy")}function pickupLocation(e){myClass=e,namex=$("."+e).val();var r=$.trim(namex.length);return 0!=r?r<12||190<r?($("#Error_"+myClass).html("<small style='color:red'>Should be between 12-190 letters</small>"),$("#Error_"+myClass).show(),$("."+myClass).css("border","2px solid red"),!1):($("."+myClass).css("border","2px solid green"),$("#Error_"+myClass).hide(),!0):($("#Error_"+myClass).html("<small style='color:red'> is mandatory... </small>"),$("#Error_"+myClass).show(),$("."+myClass).css("border","2px solid red"),!1)}function causeOfDeath(e){myClass=e,namex=$("."+e).val();var r=$.trim(namex.length);return 0<r?r<7||1e3<r?($("#Error_"+myClass).html("<small style='color:red'>Should be between 7-1000 letters</small>"),$("#Error_"+myClass).show(),$("."+myClass).css("border","2px solid red"),!1):($("."+myClass).css("border","2px solid green"),$("#Error_"+myClass).hide(),!0):r<=0&&!$(".cause_of_Death").prop("disabled")?($("#Error_"+myClass).html("<small style='color:red'> is now *mandatory...If not sure 'UNKNOWN' suffice </small>"),$("#Error_"+myClass).show(),$("."+myClass).css("border","2px solid red"),!1):($("."+myClass).css("border","2px solid green"),$("#Error_"+myClass).hide(),!0)}function dnaResult(){myClass="dna_result",namex=$(".dna_result").val();var e=$.trim(namex.length);dna_result=0<e?e<7||500<e?($("#Error_"+myClass).html("<small style='color:red'>Should be between 7-500 letters</small>"),$("#Error_"+myClass).show(),$("."+myClass).css("border","2px solid red"),!1):($("."+myClass).css("border","2px solid green"),$("#Error_"+myClass).hide(),!0):e<=0&&!$(".dna_result").prop("disabled")?($("#Error_"+myClass).html("<span style='color:red'> is now *mandatory...If not sure 'Negative Or Positive' suffice </span>"),$("#Error_"+myClass).show(),$("."+myClass).css("border","2px solid red"),!1):($("."+myClass).css("border","2px solid green"),$("#Error_"+myClass).hide(),!0)}function dateCheckRequired(e){var r=e;return""!=$("."+e).val()?1==isDateGreaterNow($("."+e).val())?($("."+r).css("border","2px solid red"),$("#Error_"+r).html("<small style='color:red'> Can't be prior today..</small>"),$("#Error_"+r).show(),!1):($("."+r).css("border","2px solid green"),$("#Error_"+r).hide(),!0):($("."+r).css("border","2px solid red"),$("#Error_"+r).html("<small style='color:red'> Is Mandatory *..</small>"),$("#Error_"+r).show(),!1)}function checkPickUpdate(e,r){var t=r,a=$("."+r).val();return pickup_date=""!=a?1==dateCheckRequired(r)&&(""!=$("."+e).val()&&0==isFirstDateGreaterThanSecDate($("."+e).val(),a)?($("."+t).css("border","2px solid red"),$("#Error_"+t).html("<small style='color:red'>Inconcievable date..</small>"),$("#Error_"+t).show(),!1):($("."+t).css("border","2px solid green"),$("#Error_"+t).hide(),!0)):($("."+t).css("border","2px solid red"),$("#Error_"+t).html("<small style='color:red'>Date is mandatory..</small>"),$("#Error_"+t).show(),!1)}function isfirstDateGreaterThanSecondDateNotReq(e,r){var t=e,a=$("."+r).val();return""!=a?"Pending"===$(".postmortem_status").val()?""!=$("."+e).val()?(console.log(27),0==isFirstDateGreaterThanSecDate($("."+e).val(),a)?(console.log(37),$("."+t).css("border","2px solid red"),$("#Error_"+t).html("<small style='color:red'>Inconcievable date..</small>"),$("#Error_"+t).show(),!1):(console.log(47),$("."+t).css("border","2px solid green"),$("#Error_"+t).hide(),!0)):(console.log(57),$("."+t).css("border","2px solid green"),$("#Error_"+t).hide(),!0):1==dateCheckRequired(r)?(console.log(17),""!=$("."+e).val()?(console.log(27),0==isFirstDateGreaterThanSecDate($("."+e).val(),a)?(console.log(37),$("."+t).css("border","2px solid red"),$("#Error_"+t).html("<small style='color:red'>Inconcievable date..</small>"),$("#Error_"+t).show(),!1):(console.log(47),$("."+t).css("border","2px solid green"),$("#Error_"+t).hide(),!0)):(console.log(57),$("."+t).css("border","2px solid green"),$("#Error_"+t).hide(),!0)):(console.log(67),!1):($("#Error_"+t).hide(),!0)}function isfirstDateGreaterThanSecondDate(e,r){var t=r,a=$("."+r).val();return""!=a?1==dateCheckRequired(r)?(console.log("a"),""!=$("."+e).val()?(console.log("b"),0==isFirstDateGreaterThanSecDate($("."+e).val(),a)?(console.log("ab"),$("."+t).css("border","2px solid red"),$("#Error_"+t).html("<small style='color:red'>Inconcievable date..</small>"),$("#Error_"+t).show(),!1):(console.log("c"),$("."+t).css("border","2px solid green"),$("#Error_"+t).hide(),!0)):(console.log("d"),$("."+t).css("border","2px solid green"),$("#Error_"+t).hide(),!0)):(console.log("e"),!1):($("."+t).css("border","2px solid red"),$("#Error_"+t).html("<small style='color:red'>Date is mandatory..</small>"),$("#Error_"+t).show(),!1)}function isfirstDateGreaterThanSecondPendingDate(e,r){var t=r,a=$("."+r).val();if(""==a)return $(".postmortem_date").prop("disabled")||""!=a?($("."+t).css("border","2px solid green"),$("#Error_"+t).hide(),!0):($("."+t).css("border","2px solid red"),$("#Error_"+t).html("<small style='color:red'>Inconcievable date..</small>"),$("#Error_"+t).show(),!1);var o=new Date;return new Date(a)>=new Date(o)?(console.log("a"),""!=$("."+e).val()?(console.log("b"),0==isFirstDateGreaterThanSecDate($("."+e).val(),a)?(console.log("ab"),$("."+t).css("border","2px solid red"),$("#Error_"+t).html("<small style='color:red'>Inconcievable date..</small>"),$("#Error_"+t).show(),!1):(console.log("c"),$("."+t).css("border","2px solid green"),$("#Error_"+t).hide(),!0)):(console.log("d"),$("."+t).css("border","2px solid green"),$("#Error_"+t).hide(),!0)):(console.log("e"),$("."+t).css("border","2px solid red"),$("#Error_"+t).html("<small style='color:red'>Inconcievable date..</small>"),$("#Error_"+t).show(),!1)}function isfirstDateGreaterThanSecondCompletedDate(e,r){var t=r,a=$("."+r).val();return""!=a?1==dateCheckRequired(r)?(console.log("a"),""!=$("."+e).val()?(console.log("b"),0==isFirstDateGreaterThanSecDate($("."+e).val(),a)?(console.log("ab"),$("."+t).css("border","2px solid red"),$("#Error_"+t).html("<small style='color:red'>Inconcievable date..</small>"),$("#Error_"+t).show(),!1):(console.log("c"),$("."+t).css("border","2px solid green"),$("#Error_"+t).hide(),!0)):(console.log("d"),$("."+t).css("border","2px solid green"),$("#Error_"+t).hide(),!0)):(console.log("e"),!1):($("."+t).css("border","2px solid green"),$("#Error_"+t).hide(),!0)}function requireDropDown(e){return""==$("."+e).val()?($("."+e).css("border","2px solid red"),$("#Error_"+e).html("<small style='color:red'>Required..</small>"),$("#Error_"+e).show(),!1):($("."+e).css("border","2px solid green"),$("#Error_"+e).hide(),!0)}function diaryType(){diary_type=$(".diary_type").val().length<1?($(".diary_type").css("border","2px solid red"),$("#Error_diary_type").html("<small style='color:red'>Required..</small>"),$("#Error_diary_type").show(),!1):($(".diary_type").css("border","2px solid green"),$("#Error_diary_type").hide(),!0)}function contactNumberValidate(e){var r=$("."+e).val();e=""!=r?9==r.length?($("."+e).css("border","2px solid green"),$("#Error_"+e).hide(),!0):($("#Error_"+e).html("<small style='color:red'> *only 10 digits... </small>"),$("#Error_"+e).show(),$("."+e).css("border","2px solid red"),!1):($("."+e).css("border","2px solid green"),$("#Error_"+e).hide(),!0)}function investigatorContact(e){var r=e.which?e.which:e.keyCode;if(46!=r&&31<r&&(r<48||57<r))return!1;contactNum()}function docContact(e){var r=e.which?e.which:e.keyCode;if(46!=r&&31<r&&(r<48||57<r))return!1;contactNumberValidate("dr_contact")}function nextOfKinContact(e){var r=e.which?e.which:e.keyCode;if(46!=r&&31<r&&(r<48||57<r))return!1;contactNumberValidate("next_of_kin_contact")}function isNumberKey(e){var r=e.which?e.which:e.keyCode;if(46!=r&&31<r&&(r<48||57<r))return!1;diaryNo()}function diaryNo(){$(".diary_no").val();diary_no=$(".diary_no").val().length<1?($(".diary_no").css("border","2px solid red"),$("#Error_diary_no").html("<small style='color:red'>Required.</small>"),$("#Error_diary_no").show(),!1):($(".diary_no").css("border","2px solid green"),$("#Error_diary_no").hide(),!0)}function entryDate(){entry_date=1==secondDateMustGrater("dob","entry_date")&&1==secondDateMustGrater("death_date","entry_date")}function postmortemStatus(){if(!requireDropDown("postmortem_status"))return postmortem_date=!0,resetDisable("postmortem_date"),postmortem_status=!1;var e=$(".postmortem_status").val();return"Completed"===e?($(".postmortem_date").attr("disabled",!1),buried=postmortem_date=!1,$(".buried").attr("disabled",!1),$(".pathlogist").attr("disabled",!1),$(".cause_of_Death").attr("disabled",!1),postmortem_status=!0):"Pending"===e?(postmortem_date=!1,"Yes"===$(".buried").val()&&($(".buried").val("No"),$(".burial_date").val(""),$(".burial_date").attr("disabled",!0)),resetDisable("pathlogist"),resetDisable("cause_of_Death"),$(".buried").attr("disabled",!0),$(".postmortem_date").attr("disabled",!1),postmortem_status=!0):"Not Required"===e?(buried=!1,$(".buried").attr("disabled",!1),$(".postmortem_date").attr("disabled",!0),$(".cause_of_Death").attr("disabled",!1),resetDisable("postmortem_date"),resetDisable("pathlogist"),postmortem_status=!0):void 0}function setDobDisable(){""!=$(".dob").val()||$(".dob").attr("disabled",!0)}function isTrueCheckRequireDrop(e,r){return!!requireDropDown(e)&&("Yes"===$("."+e).val()?($("#Error_"+e+"_date").hide(),$("."+e+"_date").css({border:""}),$("."+e+"_date").attr("disabled",!1),!0):"No"===$("."+e).val()?(resetDateErorrBorder(e),!0):($("."+e+"_date").val(""),$("#Error_"+e+"_date").hide(),$("."+e+"_date").css({border:""}),$("."+e+"_date").attr("disabled",!0),!1))}function isTrueCheckRequireDropBurial(e){return"Pending"===$(".postmortem_status").val()||(requireDropDown(e)?"Yes"===$("."+e).val()?($("#Error_burial_date").hide(),$(".burial_date").css({border:""}),$(".burial_date").attr("disabled",!1),!0):"No"===$("."+e).val()?(burial_date=!0,$(".burial_date").val(""),$("#Error_burial_date").hide(),$(".burial_date").css({border:""}),$(".burial_date").attr("disabled",!0),!0):($(".burial_date").val(""),$("#Error_burial_date").hide(),$(".burial_date").css({border:""}),$(".burial_date").attr("disabled",!0),!1):($(".burial_date").val(""),$(".burial_date").attr("disabled",!0),$("#Error_burial_date").hide(),$(".burial_date").css({border:""}),!1))}function SetUnidentify(e){checkValue=$("."+e).val(),(""==checkValue||checkValue.length<3||null==checkValue)&&($("."+e).val("Unidentified"),$("."+e).attr("disabled",!1))}function SetUnKnown(e){checkValue=$("."+e).val(),(""==checkValue||checkValue.length<3||null==checkValue)&&($("."+e).val("UNKNOWN"),$("."+e).attr("disabled",!1))}function SetPathologist(e){checkValue=$("."+e).val(),(""==checkValue||checkValue.length<3||null==checkValue)&&($("."+e).val("No Post-Mortem"),$("."+e).attr("disabled",!1))}function SetRequestStatus(e){checkValue=$("."+e).val(),""!=checkValue&&null!=checkValue||($("."+e).val("No"),$("."+e).attr("disabled",!1))}function SetBuried(){checkValue=$(".buried").val(),""!=checkValue&&null!=checkValue||($(".buried").val("No"),$(".buried").attr("disabled",!1))}function SetApprovalStatus(e){checkValue=$("."+e).val(),""!=checkValue&&null!=checkValue||($("."+e).val("No Request"),$("."+e).attr("disabled",!1))}function SetUnidentifiNation(e){checkValue=$("."+e).val(),""==checkValue||checkValue.length<3||null==checkValue?$("#nationality").val("Default Jamaica"):$("#nationality").val(checkValue)}function SetCauseOfDeath(e){checkValue=$("."+e).val(),""==checkValue&&($("."+e).val("NO POSTMORTEM INFO.."),$("."+e).attr("disabled",!1))}function funeralHome(){funeralhome_id=requireDropDown("funeralhome_id")}function investigator_stn(){station_id=requireDropDown("station_id")}function investigatorRank(){rank_id=requireDropDown("rank_id")}function investigator(e){namex=$("."+e).val();var r=$.trim(namex.length);return 0!=r?r<3||15<r?($("#Error_"+e).html("<small style='color:red'>Should be between 3-15 letters</small>"),$("#Error_"+e).show(),$("."+e).css("border","2px solid red"),!1):/^[a-zA-Z_ ]*$/.test(namex)?($("."+e).css("border","2px solid green"),$("#Error_"+e).hide(),!0):($("#Error_"+e).html("<small style='color:red'>Only letters allowed... </small>"),$("#Error_"+e).show(),$("."+e).css("border","2px solid red"),!1):($("#Error_"+e).html("<small style='color:red'> is allowed here... </small>"),$("#Error_"+e).show(),$("."+e).css("border","2px solid red"),!1)}function investFirstName(e){investigator_first_name=investigator(e)}function investLastName(e){investigator_last_name=investigator(e)}function validatePhone(e){return/(\d{1,2}[-\s]?)?(\d{3}[-]?){2}\d{4}/.test(e)}function validateRegNum(e){return/^(\(?\+?[0-9]*\)?)?[0-9_\- \(\)]*$/.test(e)}function contactNum(){var e=$(".contact_no").val();return contact_no=""!=e?10==e.length?($(".contact_no").css("border","2px solid green"),$("#Error_contact_no").hide(),!0):($("#Error_contact_no").html("<small style='color:red'> *only 10 digits... </small>"),$("#Error_contact_no").show(),$(".contact_no").css("border","2px solid red"),!1):($("#Error_contact_no").html("<small style='color:red'> Required... </small>"),$("#Error_contact_no").show(),$(".contact_no").css("border","2px solid red"),!1)}function regulationNum(){var e=$(".regNum").val();return""!=e?0<e&&validateRegNum(e)&&e.length<=6&&3<=e.length?($(".regNum").css("border","2px solid green"),$("#Error_regNum").hide(),!0):($("#Error_regNum").html("<small style='color:red'> Invalid number... </small>"),$("#Error_regNum").show(),$(".regNum").css("border","2px solid red"),!1):($("#Error_regNum").html("<small style='color:red'> is allowed here... </small>"),$("#Error_regNum").show(),$(".regNum").css("border","2px solid red"),!1)}function pathlogistName(e){namex=$("."+e).val();var r=$.trim(namex.length);return 0!=r?r<3||25<r?($("#Error_"+e).html("<small style='color:red'>Should be between 3-25 letters</small>"),$("#Error_"+e).show(),$("."+e).css("border","2px solid red"),!1):($("."+e).css("border","2px solid green"),$("#Error_"+e).hide(),!0):r<=0&&!$(".pathlogist").prop("disabled")?($("#Error_"+e).html("<small style='color:red'> Now *required</small>"),$("#Error_"+e).show(),$("."+e).css("border","2px solid red"),!1):($("#Error_"+e).hide(),!0)}$("#pauper_burial_requested_show").slideUp(),$(".cause_of_Death").attr("disabled",!0),$(".pathlogist").attr("disabled",!0),$(".address").val(""),$(".pauper_burial_approved").val(""),$(".volume_no").attr("disabled",!0),$(".dna_result_date").attr("disabled",!0),$(".dna_result").attr("disabled",!0),""!=$(".suspected_name").val()?$(".suspected_name").attr("disabled",!1):$(".suspected_name").attr("disabled",!0),$(".postmortem_date").attr("disabled",!0),$(".finger_print_date").attr("disabled",!0),$(".pauper_burial_requested_date").attr("disabled",!0),$(".burial_date").attr("disabled",!0),$(".gazetted_date").attr("disabled",!0),$(function(){$("#username_error_message").hide(),$("#password_error_message").hide(),$("#retype_password_error_message").hide(),$("#email_error_message").hide();$(".first_name").focusout(function(){first_name=name("first_name","first_name")}),$(".first_name").keyup(function(){first_name=name("first_name","first_name")}),$(".middle_name").focusout(function(){middle_name=middleName("middle_name","middle_name")}),$(".middle_name").keyup(function(){middle_name=middleName("middle_name","middle_name")}),$(".suspected_name").focusout(function(){suspected_name=suspectedName("suspected_name","suspected_name")}),$(".suspected_name").keyup(function(){suspected_name=suspectedName("suspected_name","suspected_name")}),$(".last_name").focusout(function(){last_name=name("last_name","last_name")}),$(".last_name").keyup(function(){last_name=name("last_name","last_name")}),$(".address").focusout(function(){address=corpseAddress("address","address")}),$(".address").keyup(function(){address=corpseAddress("address","address")}),$(".summary").focusout(function(){case_summary()}),$(".summary").keyup(function(){case_summary()}),$(".death_date").focusout(function(){death_date=secondDateMustGrater("dob","death_date")}),$(".death_date").mouseleave(function(){death_date=secondDateMustGrater("dob","death_date")}),$(".dob").focusout(function(){dob=date_of_birth("death_date","dob")}),$(".dob").mouseleave(function(){dob=date_of_birth("death_date","dob")}),$(".volume_no").focusout(function(){volumeNo()}),$(".volume_no").mouseleave(function(){volumeNo()}),$(".entry_date").focusout(function(){entryDate()}),$(".entry_date").mouseleave(function(){entryDate()}),$(".diary_no").focusout(function(){diaryNo()}),$(".diary_no").mouseleave(function(){diaryNo()}),$(".pickup_date").focusout(function(){checkPickUpdate("death_date","pickup_date")}),$(".pickup_date").mouseleave(function(){checkPickUpdate("death_date","pickup_date")}),$(".pickup_location").focusout(function(){pickup_location=pickupLocation("pickup_location")}),$(".pickup_location").keyup(function(){pickup_location=pickupLocation("pickup_location")}),$(".investigator_first_name").focusout(function(){investFirstName("investigator_first_name")}),$(".investigator_first_name").keyup(function(){investFirstName("investigator_first_name")}),$(".investigator_last_name").focusout(function(){investLastName("investigator_last_name")}),$(".investigator_last_name").keyup(function(){investLastName("investigator_last_name")}),$(".contact_no").focusout(function(){contactNum()}),$(".contact_no").keyup(function(){contactNum()}),$(".regNum").focusout(function(){regNum=regulationNum()}),$(".regNum").keyup(function(){regNum=regulationNum()}),$(".assign_date").focusout(function(){assign_date=isfirstDateGreaterThanSecondDate("pickup_date","assign_date")}),$(".assign_date").mouseleave(function(){assign_date=isfirstDateGreaterThanSecondDate("pickup_date","assign_date")}),$(".pathlogist").focusout(function(){pathlogist=pathlogistName("pathlogist")}),$(".pathlogist").keyup(function(){pathlogist=pathlogistName("pathlogist")}),$(".cause_of_Death").focusout(function(){cause_of_Death=causeOfDeath("cause_of_Death")}),$(".cause_of_Death").keyup(function(){cause_of_Death=causeOfDeath("cause_of_Death")}),$(".postmortem_date").focusout(function(){postmortem_date=postMortemDate()}),$(".cause_of_Death").keyup(function(){postmortem_date=postMortemDate()}),$(".dna_result").focusout(function(){dnaResult()}),$(".dna_result").keyup(function(){dnaResult()}),$(".finger_print_date").focusout(function(){fingerPrintDate()}),$(".finger_print_date").mouseleave(function(){fingerPrintDate()}),$(".dna_date").focusout(function(){dnaDate()}),$(".dna_date").mouseleave(function(){dnaDate()}),$(".dna_result_date").focusout(function(){dnaResultDate()}),$(".dna_result_date").mouseleave(function(){dnaResultDate()}),$(".gazetted_date").focusout(function(){gazettedDate()}),$(".gazetted_date").mouseleave(function(){gazettedDate()}),$(".pauper_burial_requested_date").focusout(function(){pauperBurialRequestedDate()}),$(".pauper_burial_requested_date").mouseleave(function(){pauperBurialRequestedDate()}),$(".burial_date").focusout(function(){burialDate()}),$(".burial_date").mouseleave(function(){burialDate()})});