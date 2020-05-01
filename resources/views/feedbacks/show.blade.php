@extends('layouts.app')

@section('content')
    <section class="content-header">
        <h1>
               View Feedback
        </h1>
    </section>
    <div class="content">
        <div class="box box-primary">
            <div class="box-body">
                <div class="row" style="padding-left: 20px">
                    @include('feedbacks.show_fields')
                    <a href="{!! route('feedbacks.index') !!}" class="btn btn-default">Back</a>
                </div>
            </div>
        </div>
    </div>
@endsection
