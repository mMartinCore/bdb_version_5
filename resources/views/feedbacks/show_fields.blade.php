 



  
<!-- Created At Field -->
<div class="form-group col-sm-12">
    {!! Form::label('created_at', 'Created at:') !!}
    {{$feedback->created_at}}
</div>
<!-- manner Field -->
<div class="form-group col-sm-12">
    {!! Form::label('subject', 'Subject:') !!}
   {{ $feedback->subject  }}
</div>



<!-- manner Field -->
<div class="form-group col-sm-12">
    {!! Form::label('feedbacks', 'Feedback:') !!}
    {!! Form::textarea('feedback', $feedback->feedback , ['class' => 'form-control']) !!}
</div>





 
