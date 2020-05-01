
@extends('layouts.app')

@section('content')



<style>
.my_container {
    width: auto;
}

</style>

    <div class="container my_container"   style="min-height:900px;"> 
    <br><br>

       <div class="row">

    @hasrole('SuperAdmin|Admin')
        <div class="col-sm-3 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-red">
            <div class="inner">
              <h3>{!!$overThirtyDays!!}</h3>

              <p> Bodies Over 30 Days</p>
            </div>
            <div class="icon">
                <i class="fa fa-calendar" aria-hidden="true"></i>
            </div>
            <a href="#" class="small-box-footer">  <i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>
        <!-- ./col -->
        <div class="col-sm-3 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-green">
            <div class="inner">
            <h3> {!!$post_mortem_pending!!}<sup style="font-size: 20px"></sup></h3>

              <p> Post Mortem Pending</p>
            </div>
            <div class="icon">
              <i class="ion ion-stats-bars"></i>
            </div>
            <a href="#" class="small-box-footer"> <i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>
        <!-- ./col -->
        <div class="col-sm-3 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-yellow">
            <div class="inner">
            <h3>{!!$burial_request!!}</h3>

              <p> Burial Request</p>
            </div>
            <div class="icon">
              <i class="ion ion-person-add"></i>
            </div>
            <a href="{!! route('corpses.approve') !!}" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>
        <!-- ./col -->
        <div class="col-sm-3 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-purple">
            <div class="inner">
            <h3> {!!$burial_NotApproved!!}</h3>

              <p> Burial Not Approved</p>
            </div>
            <div class="icon">
              <i class="ion ion-pie-graph"></i>
            </div>
            <a href="{!! route('corpses.notApprove') !!}" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>
        <!-- ./col --> 
        @endrole
      <br>

      @hasrole('SuperAdmin')

            <div class="panel-body ">
                <div class="row ">
                        <div class="col-sm-6">
                        {!! $chart->html() !!}
                        </div>
                        <div class="col-sm-6">
                            {!! $bar->html() !!}
                        </div>
                </div>

<hr>
                <div class="row">
                    <div class="col-sm-6">
                    {!! $pie->html() !!}
                    </div>
                    <div class="col-sm-6">
                        {!! $notApproved_bar->html() !!}
                    </div>
            </div>
@endrole
            <hr>

            <div class="row">
                @hasrole('SuperAdmin|Admin|viewer|writer')
                <div class="col-sm-12">
                  <br>
                {!! $bar_station->html() !!}
                </div>
             @endrole
           </div>

            </div>

    </div>
</div>

    {!! Charts::scripts() !!}
    {!! $chart->script() !!}
    {!! $bar->script() !!}
    {!! $pie->script() !!}
    {!! $bar_station->script() !!}

    {!! $notApproved_bar->script() !!}


@endsection
