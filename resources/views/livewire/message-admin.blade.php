

<div>
    <div class="modal-body">
       <h1>{{$message.'  '. $subject}}</h1>
          <div class="form-group col-sm-12"><br>
            {!! Form::label('subject', 'Subject:') !!}
            <input type="text" wire:model="subject" class="form-control"> 
        </div> 
        <div class="form-group col-sm-12">
            {!! Form::label('mesaage', 'Message:') !!}
            <textarea wire:model="message"  class="form-control" cols="30" rows="6"></textarea> 
        </div>

        <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            <button wire:click="send_message($corpse_id)" type="button" class="btn btn-primary">Send</button>
        </div>
       </div>
               
  
          
</div>
