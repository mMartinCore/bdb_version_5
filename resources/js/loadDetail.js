  

  function getViewId(id) 
  {
    var url =window.location.protocol+"//"+window.location.hostname+":8000/corpses/"+id;
  $("#load_show_view").load(url, function(responseTxt, statusTxt, xhr){
  if(statusTxt == "success")
  {
      document.getElementById('demo02').click(); // Works!
      return false;
  }
  if(statusTxt == "error"){
  Command: toastr["error"]("Inconceivable!","Error: " + xhr.status + ": " + xhr.statusText)
  
  toastr.options = {
  "closeButton": true,
  "debug": false,
  "newestOnTop": false,
  "progressBar": true,
  "positionClass": "toast-top-center",
  "preventDuplicates": false,
  "onclick": null,
  "showDuration": "900",
  "hideDuration": "1000",
  "timeOut": "5000",
  "extendedTimeOut": "1000",
  "showEasing": "swing",
  "hideEasing": "linear",
  "showMethod": "fadeIn",
  "hideMethod": "fadeOut"
  }
  
  }
  return false;
  
  });
  }
  
  
  
  function getViewId_view_Notify(id) {
    var url =window.location.protocol+"//"+window.location.hostname+":8000/corpses/"+id;
  $("#load_show_view").load(url, function(responseTxt, statusTxt, xhr){
  if(statusTxt == "success")
  {
      document.getElementById('demo02').click(); // Works!
      return false;
  }
  if(statusTxt == "error"){
  
  Command: toastr["error"]("Inconceivable!","Error: " + xhr.status + ": " + xhr.statusText)
  
  toastr.options = {
  "closeButton": true,
  "debug": false,
  "newestOnTop": false,
  "progressBar": true,
  "positionClass": "toast-top-center",
  "preventDuplicates": false,
  "onclick": null,
  "showDuration": "900",
  "hideDuration": "1000",
  "timeOut": "5000",
  "extendedTimeOut": "1000",
  "showEasing": "swing",
  "hideEasing": "linear",
  "showMethod": "fadeIn",
  "hideMethod": "fadeOut"
  }
  
  }
  return false;
  
  });
  }
  
  
 