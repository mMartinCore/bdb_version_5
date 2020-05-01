
<!DOCTYPE html>
<html>
 <head>
  <title>mlm test</title>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" />
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
  <meta name="csrf-token" content="{{ csrf_token() }}">
 </head>
 <body>
 
  <div class="container">
 






    <script>
        var is_form1_on=true;
        $(document).ready(function(){
    
          $("#flip").click(function(){
            is_form1_on=true;
           $('.opendForm2')[0].reset();
           $('#postForm')[0].reset();
            $("#panel").slideToggle("slow");
            $(".simpleSearch").slideToggle("slow");
    
          });
    
          $("#flip2").click(function(){
            is_form1_on=false;
           $('#postForm')[0].reset();
            $('.opendForm2')[0].reset();
            $("#panel").slideToggle("slow");
            $(".simpleSearch").slideToggle("slow");
    
          });
    
    
    
        });
        </script>
    
    
    
    {{-- LOADER OF BUTTONS --}}
    
    
    
    <style>
        .btnLoaderSimpleSearch {
    
          cursor: pointer;
        }
        .btnLoaderSimpleSearch:disabled {
          opacity: 0.5;
        }
        .hide {
          display: none;
        }
      </style>    
    
    
        <style>
        #panel, #flip {
    
          border: solid 1px #c3c3c3;
        }
    
        #panel {
    
          display: none;
        }
    
    
        .organizeBtn{
    position: relative;
    top: 290%;
    
        }
        </style>
    
         <body>
    
    <hr>
    




   <div class="row">
    <div class="col-lg-12">
        @include('corpses.formAdvance')
    </div>

   </div>
   <br>
 
 

   <div class="table-responsive">
    <table class="table table-striped table-bordered">
        <thead>
      <tr>
        <th width="5%" class="sorting" data-sorting_type="asc" data-column_name="id" style="cursor: pointer">ID <span id="id_icon"></span></th>
        <th width="15%" class="sorting" data-sorting_type="asc" data-column_name="last_name" style="cursor: pointer">Name <span id="post_title_icon"></span></th>
     
        <th scope="col">Date Of Death</th>
        <th scope="col">Pick Up Date</th>
        <th scope="col">Anatomy</th>
        <th scope="col">Post Mortem</th>
        <th scope="col">Division</th>
        <th scope="col">Requested</th>
        <th scope="col">Approved</th>
        <th scope="col">Buried</th>
        <th scope="col">Storage</th>
        <th scope="col">Excess</th>
        <th scope="col">Action</th>
      </tr>
    </thead>
  
      @include('pagination_data')
 
    </table>






 
 

    <input type="hidden" name="hidden_page" id="hidden_page" value="1" />
    <input type="hidden" name="hidden_column_name" id="hidden_column_name" value="id" />
    <input type="hidden" name="hidden_sort_type" id="hidden_sort_type" value="asc" />

 

   </div>
  </div>
 </body>
</html>

<script>
$(document).ready(function(){

 function clear_icon()
 {
  $('#id_icon').html('');
  $('#post_title_icon').html('');
 }

 function fetch_data(page, sort_type, sort_by, query)
 {
     
      $('#page').val(page);
      $('#sort_type').val(sort_type);
      $('#sort_by').val(sort_by);
      $('#query').val(query);
      var form_data = $(".opendForm2").serializeArray();

  $.ajax({
      // url:"/pagination/fetch_data?page="+page+"&sortby="+sort_by+"&sorttype="+sort_type+"&query="+query,
      type: "get",
      url:"/pagination/fetch_data",
      data:form_data,
     success:function(data)
        {
            $('tbody').html('');
            $('tbody').html(data);
        }
        })
 }

//  $(document).on('keyup', '#serach', function(){
    $('.savedAdvance').click( function(event){
        event.preventDefault();
  var query = $('#serach').val();
  var column_name = $('#hidden_column_name').val();
  var sort_type = $('#hidden_sort_type').val();
  var page = $('#hidden_page').val();
  fetch_data(page, sort_type, column_name, query);
 });

 $(document).on('click', '.sorting', function(event){
      event.preventDefault()
  var column_name = $(this).data('column_name');
  var order_type = $(this).data('sorting_type');
  var reverse_order = '';
  if(order_type == 'asc')
  {
   $(this).data('sorting_type', 'desc');
   reverse_order = 'desc';
   clear_icon();
   $('#'+column_name+'_icon').html('<span class="glyphicon glyphicon-triangle-bottom"></span>');
  }
  if(order_type == 'desc')
  {
   $(this).data('sorting_type', 'asc');
   reverse_order = 'asc';
   clear_icon
   $('#'+column_name+'_icon').html('<span class="glyphicon glyphicon-triangle-top"></span>');
  }
  $('#hidden_column_name').val(column_name);
  $('#hidden_sort_type').val(reverse_order);
  var page = $('#hidden_page').val();
  var query = $('#serach').val();
  fetch_data(page, reverse_order, column_name, query);
 });

 $(document).on('click', '.pagination a', function(event){
  event.preventDefault();
  var page = $(this).attr('href').split('page=')[1];
  $('#hidden_page').val(page);
  var column_name = $('#hidden_column_name').val();
  var sort_type = $('#hidden_sort_type').val();

  var query = $('#serach').val();

  $('li').removeClass('active');
        $(this).parent().addClass('active');
  fetch_data(page, sort_type, column_name, query);
 });

});
</script>