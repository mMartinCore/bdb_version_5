@extends('layouts.app')


@section('content')


<div class="container"  style="min-height:900px;">
<div class="col-lg-10 col-lg-offset-1">

    <h3><i class="fa fa-list-ul" aria-hidden="true"></i> List of bodies reached thirty days </h3>
    <div id="output"></div>
    <hr>
    <div  class="table-responsive">
     <?php   $countVal=0;?>
  
        <table class="table table-bordered table-striped">

            <thead  style=" width:100%;border-collapse:collapse;background-color:#3c8dbc; font-size:small; color:white" >
                <tr style="test-align:center" >
                    <th>ID No.</th>
                    <th>Name</th>
                     <th>Division</th>
                     <th>Pickup Date</th>
                     <th>Status</th>
                     <th>Storage</th>
                    <Th>Excess</Th>
                    {{-- <th>Actions</th> --}}

                </tr>
            </thead>

            <tbody style="font-size:small;" >

    @foreach ($corpses as $corpse)

        @if ($corpse->storagedays() >= 30 && $corpse->burial_date =="")

        <tr class="col">
                     <?php
                     $name='';

                    if ($corpse->first_name == "Unidentified") {

                    if ($corpse->suspected_name != '')
                        $name = '*' .ucfirst($corpse->suspected_name). '*';
                    else {
                        $name = 'Unidentified';
                    }
                    } else {
                    $name = ucfirst($corpse->first_name) . ' ' . ucfirst($corpse->middle_name). ' ' . ucfirst($corpse->last_name);
                    }
                    $storagedays = '';
                    $excess = 0;

            $storagedays = $corpse->storagedays();
            if ($storagedays >= 30) {
                $countVal++;
                $storagedays =  $storagedays;

                if ($storagedays > 30) {

                    $excess = $storagedays - 30;


                    if ($excess > 0) {

                    } else {
                        $excess = 0;
                    }
                } else {
                    $excess = 0;
                }

                // $overThirty=
            } elseif ($storagedays >= 20 &&  $storagedays < 30) {
                $excess = 0;
                $storagedays = $storagedays;
            }

                 ?>
                      <td>    @hasrole('SuperAdmin|Admin|viewer|writer')
                        <a href="#" onclick="getViewId({!!$corpse->id!!});" class='btn btn-success btn-xs'>    {!!$corpse->id!!}</a>
                        @endrole
                    </td>
                      <td>{!! $name!!}</td>
                      <td>{!!$corpse->station->division->division!!}</td>
                      <td>{!! $corpse->pickup_date!!}</td>
                      @if ($corpse->pauper_burial_approved =='No')
                      <td  class=" text-danger   " >
                          <h3 class="label label-danger"><i class="fa fa-clock-o"></i>  Denied</h3>
                      </td> 
  
                      @elseif ($corpse->pauper_burial_approved =='Processing')
                      <td  class=" text-warning   " >
                          <h3 class="label label-warning"><i class="fa fa-clock-o"></i>    {!! $corpse->pauper_burial_approved!!}</h3>
                      </td> 
                      @else
                      <td  class=" text-success   " >
                        <h3 class="label label-success"><i class="fa fa-clock-o"></i>    {!! $corpse->pauper_burial_approved!!}</h3>
                    </td>
                      @endif
                   
                      <td>{!!  $storagedays!!}</td>
                      <td>{!!  $excess!!}</td>
                  
{{--
                            <div class='btn-group'>
                                @hasrole('SuperAdmin')
                                <a href="#" onclick="approved({!!$corpse->id!!});" class='btn btn-success btn-xs'> Approve</a>
                                <a href="#" onclick="deny({!!$corpse->id!!});" class='btn btn-danger btn-xs'> Deny </a>
                                @endrole
                            </div> --}}


                </tr>
                @endif
                @endforeach

            </tbody>
            <?php
            if ($countVal ==0){
                echo     "<td colspan='8'><h4>No Data Found</h4></td>";
                }
                ?> 
        </table>   

{!! $corpses->links()  !!}
    </div>
    

{{--
    <a href="{{ route('corpses.create') !!}" class="btn btn-success">Add corpse</a> --}}
 

</div>

</div>


@endsection
<script>
 
    function approved(id){
       if (id!='') {

        $.ajax({
            url:"/approved",
            method:"POST",
            data: {
                'corpse_id':id,
                "_token": "{{ csrf_token() }}",
            },

            dataType:"json",
            success:function(data)
            {
                if(data.error.length > 0)
                {
                    var error_html = '';
                    for(var count = 0; count < data.error.length; count++)
                    {
                        error_html +='<div class="alert alert-danger">'+data.error[count]+'</div>';
                    }
                    $('#output').html(error_html);
                }
                else
                {
                    $('#output').html(data.success);
                    setTimeout(function(){
                    $('#output').html('');
                    window.location.reload();
                    }, 3000);
                }
            }
        })

       } else {
            alert("No Id");
       }

      }


      function deny(id){
        if (id!='') {

                    $.ajax({
                        url:"/deny",
                        method:"POST",
                        data: {
                            'corpse_id':id,
                            "_token": "{{ csrf_token() }}",
                        },
                        dataType:"json",
                        success:function(data)
                        {
                            if(data.error.length > 0)
                            {
                                var error_html = '';
                                for(var count = 0; count < data.error.length; count++)
                                {
                                    error_html += '<div class="alert alert-danger">'+data.error[count]+'</div>';
                                }
                                $('#output').html(error_html);
                            }
                            else
                            {
                                $('#output').html(data.success);

                                setTimeout(function(){
                                $('#output').html('');
                                window.location.reload();
                                }, 3000);
                            }
                        }
                    })

} else {
    alert("No Id");

      }
    }



    </script>
 