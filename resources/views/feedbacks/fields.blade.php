

<!-- manner Field -->
<div class="form-group col-sm-12">
    {!! Form::label('subject', 'Subject:') !!}
    {!! Form::text('subject', null, ['class' => 'form-control']) !!}
</div>



<!-- manner Field -->
<div class="form-group col-sm-12">
    {!! Form::label('feedbacks', 'Feedback:') !!}
    {!! Form::textarea('feedback', null, ['class' => 'form-control']) !!}
</div>



<!-- Submit Field -->
<div class="form-group col-sm-12">
    <button type="submit" class="btn btn-primary"><i class="fa fa-paper-plane-o" aria-hidden="true"></i> Send</button> 
    <a href="/" class="btn btn-default"> <i class="fa fa-ban" aria-hidden="true"></i> Cancel</a>
</div>
