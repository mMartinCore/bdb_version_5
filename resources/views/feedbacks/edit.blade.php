@extends('layouts.app')

@section('content')
    <section class="content-header">
        <h1>
              Edit feedback
        </h1>
   </section>
   <div class="content">

       <div class="box box-primary">
           <div class="box-body">
               <div class="row">
                   {!! Form::model($manner, ['route' => ['feedbacks.update', $manner->id], 'method' => 'patch']) !!}

                        @include('feedbacks.fields')

                   {!! Form::close() !!}
               </div>
           </div>
       </div>
   </div>
@endsection
