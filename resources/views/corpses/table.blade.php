


 


<span id="error"></span>
<div class="table-responsive">
<small>Total record(s): <b> {{$total_records}}</small></b>
 
    @include('corpses.pagination') 
</div>
 
{{-- <script src="{{ asset('bower_components/jquery/dist/jquery-1.11.1.min.js')}}"></script> --}}
<script>

$("#nameSort").html('&nbsp;<span  style="color:lightsteelblue" class="glyphicon glyphicon-arrow-up"></span>');
$('.exporting').on('click', function() {

          $(".exporting-icon").removeClass("hide");
          $(".exporting").attr("disabled", true);
          $(".btnexportingtxt").text("Exporting Data Please wait...");

    setTimeout(function() {
            $(".exporting-icon").addClass("hide");
            $(".exporting").attr("disabled", false);
            $(".btnexportingtxt").text("Export");

   }, 9000);
});



$('.SimpleFormExporting').on('click', function() {

$(".SimpleFormExporting-icon").removeClass("hide");
$(".SimpleFormExporting").attr("disabled", true);
$(".btnSimpleFormExportingtxt").text("Exporting Data Please wait...");

setTimeout(function() {
  $(".SimpleFormExporting-icon").addClass("hide");
  $(".SimpleFormExporting").attr("disabled", false);
  $(".btnSimpleFormExportingtxt").text("Export");

}, 9000);
});



 





$(document).ready(function() {
 //   getCorpses(1)

 


    $(".reset").click(function(e) {
        e.preventDefault();
        $('#postForm')[0].reset();
    });

    $(".resetAdvanceForm").click(function(e) {
        e.preventDefault();
        $('.opendForm2')[0].reset();
    });

 



      function load_data(page)
      {
        $.ajax({
        type: "Post",
        url:"{{ route('corpses.getCorpse') }}",
        data: {
        'page':page,
        "_token": "{{ csrf_token() }}",
        },
            success:function(data){
                $("#count").html(data['cnt']+' of '+data['search_Count_total']);
            $("tbody").html(data['table']);
            $("#pagination_link").html(data['pagination_link']);

                }
           })
      }
 

    $(document).on('click', '.pagination_link', function(event){
         event.preventDefault();
         var page = $(this).attr("id");
         $("#pageNumForm2").val(page);
        var form_data = $(".opendForm2").serializeArray();

        if (is_form1_on==true) {

            $("#pageNumForm2").val(page);
            var form_data = $(".opendForm2").serializeArray();
        } else {

            $("#pageNumForm1").val(page);
            var form_data = $("#postForm").serializeArray();

        }

        $.ajax({
            url:"{{ route('corpses.getCorpse') }}",
        method:"Post",
        data:form_data,

        success:function(data){
            $("#count").html(data['cnt']+' of '+data['search_Count_total']);
            $("tbody").html(data['table']);
            $("#pagination_link").html(data['pagination_link']);

                },
       error: function (jqXHR, exception) {
        var msg = '';
        if (jqXHR.status === 0) {
            msg = 'Not connect.\n Verify Network.';
        } else if (jqXHR.status == 404) {
            msg = 'Requested page not found. [404]';
        } else if (jqXHR.status == 500) {
            msg = 'Internal Server Error [500].';
        } else if (exception === 'parsererror') {
            msg = 'Requested JSON parse failed.';
        } else if (exception === 'timeout') {
            msg = 'Time out error.';
        } else if (exception === 'abort') {
            msg = 'Ajax request aborted.';
        } else {
            msg = 'Uncaught Error.\n' + jqXHR.responseText;
        }
        $('#error').html(msg);
    }

       });
    });








//////////////////////////////////////////////////////////////////////////////////////////////////////////////






$(document).on('click', '.sorting_name', function(event){
         event.preventDefault();

           var column_name = $(this).attr("id");
           var order = $(this).data("order");
           var arrow = '';

         if(order == 'desc')
           {
                $(this).data('order', 'asc');
                arrow = '&nbsp;<span  style="color:lightsteelblue" class="glyphicon glyphicon-arrow-down"></span>';
                $("#order_by_last_nameForm1").val(order);
              //  $("#order_by_last_nameForm2").val(order);
           }
           else
             {   $("#order_by_last_nameForm1").val(order);
              //  $("#order_by_last_nameForm2").val(order);
                 $(this).data('order', 'desc');
                 arrow = '&nbsp;<span  style="color:lightsteelblue" class="glyphicon glyphicon-arrow-up"></span>';
           }



        if (is_form1_on==true) {

            var form_data = $(".opendForm2").serializeArray();
        } else {

            var form_data = $("#postForm").serializeArray();

        }

        $.ajax({
            url:"{{ route('corpses.getCorpse') }}",
        method:"POST",
        data:form_data,

        success:function(data){
            $("#count").html(data['cnt']+' of '+data['search_Count_total']);
            $("tbody").html(data['table']);
            $("#pagination_link").html(data['pagination_link']);
            $('#'+column_name+'').html(arrow);

                },
       error: function (jqXHR, exception) {
        var msg = '';
        if (jqXHR.status === 0) {
            msg = 'Not connect.\n Verify Network.';
        } else if (jqXHR.status == 404) {
            msg = 'Requested page not found. [404]';
        } else if (jqXHR.status == 500) {
            msg = 'Internal Server Error [500].';
        } else if (exception === 'parsererror') {
            msg = 'Requested JSON parse failed.';
        } else if (exception === 'timeout') {
            msg = 'Time out error.';
        } else if (exception === 'abort') {
            msg = 'Ajax request aborted.';
        } else {
            msg = 'Uncaught Error.\n' + jqXHR.responseText;
        }
        $('#error').html(msg);
    }

       });
    });










////////////////////////////////////////////////////////////////////////////////////////////////////////////////



});





function getCorpses(corpse_id) {
     $.ajax({
    type: "Post",
    url:"{{ route('corpses.getCorpse') }}",
    data: {
    'corpse_id':corpse_id,
    "_token": "{{ csrf_token() }}",
    },
    // dataType: "json",
    success:function(data){
        $("tbody").html(data);
       }

       });
    }




function getCorpse(corpse_id) {
  var container= $("#getTask");
    $.ajax({
    type: "post",
    url:"{{ route('corpses.getCorpse') }}",
    data: {
    'corpse_id':corpse_id,
    "_token": "{{ csrf_token() }}",
    },
    // dataType: "json",
    success:function(data){
 console.log(data);
        $("tbody").html(data);
                // $.each(data, function(i, item) {
                //     $("#getTask").append('<div class="list-type3">  <ul> <li> <a href="#"> '+item.task+' '+timeAgo(item.created_at)+' </a>    </li>  </ul>   </div>');
                // });
                //  $("#getTask").append('<br>');

       }

       });   // $("#getTask").html(data);///.delay(3000).fadeOut();
    }

</script>




 

<script>


function getId(id)
                {

                var r = confirm(" Are you Sure ?");
                if (r == true) {


                    window.location.href ='corpses/delete/'+id;
                    return false;
                }
                }

</script>



