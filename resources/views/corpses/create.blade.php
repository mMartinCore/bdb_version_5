@extends('layouts.app')

@section('content')


<style>
    div {
      font-family: sans-serif;
    }

 
    .btn_save_loader {
    
    cursor: pointer;
    }
    .btn_save_loader:disabled {
    opacity: 0.5;
    }

    .hide {
          display: none;
        }


    </style>
    {{-- <script>
    window.addEventListener("load", function () {
        const loader = document.querySelector(".loader");
        loader.className += " hidden"; // class "loader hidden"
    });
    </script>
    <div class="loader">
            <img src="{{asset('/dist/img/LOADING.gif')}}"   alt="Loading...">
      </div> --}}








<link rel="stylesheet" href="{{asset('dist/task.css')}}">
    <div class="content" style="background:white">
            {{-- {{-- <div class="panel panel-default"> --}}
                    <div class="title"><h4> <i class="fa fa-plus-circle" aria-hidden="true"></i>  New Corpse Detail </h4></div> 
                    <span id="output"></span>
                    <div   class="panel-body" style="background:white">
                            @include('corpses.step')
                        <span id="form_output"></span>
                <div class="row" >
                    {!! Form::open(['route' => 'corpses.store','id'=>'postForm']) !!}
                       {{csrf_field()}}
                       @include('corpses.fields')                  
                    {!! Form::close() !!}
                </div>
            </div>
        {{-- </div> --}}
    </div>

{{-- 
    @include('corpses.showModal') --}}

@endsection
