@extends('layouts.app')

@section('content')

{{-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" />
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script> --}}

<script>
    var is_form1_on=true;
    $(document).ready(function(){

      $("#flip").click(function(){
        is_form1_on=false;
 
       $('.opendForm2')[0].reset();
       $('#postForm')[0].reset();
        $("#panel").slideToggle("slow");
        $(".simpleSearch").slideToggle("slow");

      });

      $("#flip2").click(function(){
        is_form1_on=true;
        
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






    <section class="content-header simpleSearch">
        <div class="box box-success">
            <div class="box-header with-border">
                <h4 class="box-title pull-left">Corpse Index</h4>
                     <span class=" pull-right">
                   <a class="btn btn-info btn-sm"  id="flip" href="#"> <i class="fa fa-search-plus" aria-hidden="true"></i> Advance Search</a>&emsp;
                @hasrole('SuperAdmin|Admin|writer')
                   <a class="btn btn-primary btn-sm"  href="{!! route('corpses.create') !!}"> <i class="fa fa-plus-circle" aria-hidden="true"></i> Add New</a>
                @endrole
            </div>
            </span>

            @include('corpses.formsimple')

          </div>
     </section>




        <section class="content-header" id="panel">
            <div class="box box-success">
                <div class="box-header with-border">
                    <h4 class="box-title pull-left">Corpse Index</h4>

              <span class=" pull-right">
                      <a class="btn btn-info btn-sm flip " id="flip2"  href="#"> <i class="fa fa-search-plus" aria-hidden="true"></i> Simple Search</a>
                    @hasrole('SuperAdmin|Admin|writer')
                      <a class="btn btn-primary btn-sm  "  href="{!! route('corpses.create') !!}"> <i class="fa fa-plus-circle" aria-hidden="true"></i> Add New</a>
                    @endrole
                </div>
             </span>

             @include('corpses.formAdvance')
              </div>
         </section>





    <div class="content">
        <div class="clearfix"></div>


        <div class="clearfix"></div>
        <div class="box box-primary">
            <div class="box-body">


              
                    @include('corpses.table')
            </div>
        </div>
        <div class="text-center">

        </div>
    </div>


@endsection
