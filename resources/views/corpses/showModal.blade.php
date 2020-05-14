

<link rel="stylesheet"  href="{{asset('showModal\css\normalize.min.css')}}">
<link rel="stylesheet" href="{{asset('showModal\css\animate.min.css')}}">

        <style>
            #btn-close-modal {
                width:100%;
                text-align: center;
                cursor:pointer;
                color:#fff;
                display: none;
            }
            #modalbody {
                display: none;
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

            <div id="modalbody" class="modal-content">
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
                document.getElementById('btn-close-modal').style.display = "block";  
                document.getElementById('modalbody').style.display = "block";              
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
                    document.getElementById('btn-close-modal').style.display = "none";
                    document.getElementById('modalbody').style.display = "none";
              //    alert("The animation is completed");
                }
            });





        </script>

