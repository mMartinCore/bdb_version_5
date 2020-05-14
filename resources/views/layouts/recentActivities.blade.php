<link rel="stylesheet" href="{{asset('dist/popover/bootstrap-popover-x.css')}}">
{{-- <script src="{{ asset('dist/popover/bootstrap-popover-x.js')}}"></script> --}}
<script src="https://cdn.jsdelivr.net/npm/bootstrap-popover-x@1.4.7/js/bootstrap-popover-x.min.js"></script>
 <!-- PopoverX content -->
 <div id="myPopover2" class="popover popover-x popover-danger">
    <div class="arrow"></div>
    <h3 class="popover-header popover-title"><span class="close pull-right" data-dismiss="popover-x">&times;</span>Recent Activities</h3>
    <div class="popover-body popover-content">

  <table id="corpses-table" class="table table-hover stripe" id="commendations-table ">       <thead>

    <thead  style="width:100%;border-collapse:collapse;background-color:#3c8dbc; font-size:small; color:white" >
        <tr>
    <th scope="col">ID No.</th>
    <th scope="col"> Name<a class="column_sort sorting_name" id="nameSort" data-order="desc" href="#">&nbsp;</a></th>
    <th scope="col">Date Of Death</th>
    <th scope="col">Pick Up Date</th>
    <th scope="col">Post Mortem</th>
    <th scope="col">Requested</th>
    <th scope="col">Approved</th>
    <th scope="col">Buried</th>
    <th scope="col">Storage</th>
    <th scope="col">Excess</th>
    <th scope="col">Action</th>
        </tr>
    </thead>
            <tbody id="myrecentact">

            </tbody>
          </table>
    </div>
    <div class="popover-footer">
        <button  data-dismiss="popover-x"  class="btn  btn-sm btn-danger">close</button>
    </div>
</div>

<script>
    $(document).ready(function () {

        $('.showRecentActivities').click( function(event){
            $("#myrecentact").html('<h3> Please wait Fetching data..</h3>');
            load_data();
        });


    });

function load_data()
      {
        $.ajax({
        type: "Post",
        url:"{{ route('recentActivities') }}",
        data: {
        "_token": "{{ csrf_token() }}",
        },
            success:function(data){

            $("#myrecentact").html(data['table']);


                }
           })
      }
</script> 








