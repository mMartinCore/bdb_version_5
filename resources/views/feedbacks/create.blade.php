@extends('layouts.app')

@section('content')
    <section class="content-header">
        <h1>
            <i class="fa fa-comments" aria-hidden="true"></i> Feedback
        </h1>
        
    </section>

    <div class="content">
        <small>Thank you for writing. We appreciate your feedback and your perspective.</small> 
        <div class="box box-primary">

            <div class="box-body">
                
                <div class="row col-sm-offet-2">
                    {!! Form::open(['route' => 'feedbacks.store']) !!}

                        @include('feedbacks.fields')

                    {!! Form::close() !!}
                </div>
            </div>
        </div>
    </div>
@endsection
