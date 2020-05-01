

<link rel="stylesheet"  href="{{asset('showModal\css\normalize.min.css')}}">
<link rel="stylesheet" href="{{asset('showModal\css\animate.min.css')}}">

        <style>
            #btn-close-modal {
                width:100%;
                text-align: center;
                cursor:pointer;
                color:#fff;
            }

        </style>

        <!--Call your modal-->
        <a id="demo02" href="#modal-02"> </a>

        <!--DEMO02-->
        <div id="modal-02">
            <!--"THIS IS IMPORTANT! to close the modal, the class name has to match the name given on the ID-->
            <div  id="btn-close-modal" class="close-modal-02">
                CLOSE MODAL HERE
            </div>

            <div class="modal-content">
                <!--Your modal content goes here-->
                <div id="load_show_view">

                </div>
            </div>
        </div>
        <script src="{{ asset('showModal\js\jquery.min.js')}}"></script>
        <script src="{{ asset('showModal\js\animatedModal.js')}}"></script>

        <script>


            //demo 02
            $("#demo02").animatedModal({
                animatedIn:'lightSpeedIn',
                animatedOut:'bounceOutDown',
                color:'#3498db',
                // Callbacks
                beforeOpen: function() {
                //    alert("The animation was called");
                },
                afterOpen: function() {
                  //  alert("The animation is completed");
                },
                beforeClose: function() {
               //     document.getElementById('btn-close-modal').click(); // Works!
                  //alert("The animation was called");
                },
                afterClose: function() {
                    $("#load_show_view").html("");
              //    alert("The animation is completed");
                }
            });














function getViewId(id) {
    var url =window.location.protocol+"//"+window.location.hostname+"/corpses/"+id;
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
    var url =window.location.protocol+"//"+window.location.hostname+"/corpses/"+id;
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






        </script>

