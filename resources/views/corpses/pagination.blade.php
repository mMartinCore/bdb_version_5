 
   <div class="table-responsive">
    <table class="table table-striped table-bordered">
        <thead>
      <tr>
        <th   class="sorting" data-sorting_type="asc" data-column_name="id" style="cursor: pointer">ID <span id="id_icon"></span></th>
        <th  class="sorting" data-sorting_type="asc" data-column_name="last_name" style="cursor: pointer">Name <span id="last_name_icon"></span></th>
     
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
      <tbody>  
          @include('pagination_data')
      </tbody>
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
  $('#last_name_icon').html('');
 }

 function fetch_data(page, sort_type, sort_by, query)
 {
     
  
      
       if(is_form1_on==true){
         

        $('#SimpleForm_page').val(page);
        $('#SimpleForm_sort_type').val(sort_type);
        $('#SimpleForm_sort_by').val(sort_by);
        $('#SimpleForm_query').val(query);

            $(".loading-icon").removeClass("hide");
            $(".btnLoaderSimpleSearch").attr("disabled", true);
            $(".btn-txt").text("Fetching Data Please wait...");
            var form_data = $("#postForm").serializeArray();
        } else {
          $('#page').val(page);
          $('#sort_type').val(sort_type);
          $('#sort_by').val(sort_by);
          $('#query').val(query);

            $(".load-icon").removeClass("hide");
            $(".loadFormAdvance").attr("disabled", true);
            $(".btnloadFormAdvancetxt").text("Fetching Data Please wait...");
            var form_data = $(".opendForm2").serializeArray();
          }


  $.ajax({
      // url:"/pagination/fetch_data?page="+page+"&sortby="+sort_by+"&sorttype="+sort_type+"&query="+query,
      type: "get",
      url:"/pagination/fetch_data",
      data:form_data,
     success:function(data)
        {
          if(is_form1_on==true){
            $(".loading-icon").addClass("hide");
            $(".btnLoaderSimpleSearch").attr("disabled", false);
            $(".btn-txt").text("Search");
        } else {
          $(".load-icon").addClass("hide");
            $(".loadFormAdvance").attr("disabled", false);
            $(".btnloadFormAdvancetxt").text("Search");
          }
       

            $('tbody').html('');
            $('tbody').html(data);
        }
        })
 }


 function sort_order_data(page, sort_type, sort_by, query)
 {
     

      
      if(is_form1_on==true){   
        
        $('#SimpleForm_page').val(page);
        $('#SimpleForm_sort_type').val(sort_type);
        $('#SimpleForm_sort_by').val(sort_by);
        $('#SimpleForm_query').val(query);

         var form_data = $("#postForm").serializeArray();
       } else {
        $('#page').val(page);
        $('#sort_type').val(sort_type);
        $('#sort_by').val(sort_by);
        $('#query').val(query);      
         var form_data = $(".opendForm2").serializeArray();
       }

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




 $('#postForm').on('submit', function(event){
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
  sort_order_data(page, reverse_order, column_name, query);
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
 sort_order_data(page, sort_type, column_name, query);
 });

});
</script>