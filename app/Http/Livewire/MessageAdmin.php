<?php

namespace App\Http\Livewire;

use Livewire\Component;

class MessageAdmin extends Component
{  
    public $corpseId =1000;
    public $message ='mlm knjn jbjbhb n';
    public $subject ='';

    public function xx($corpse_id)
    {     
        $this->corpseId=$corpse_id;
    } 
    
    
    public function send_message($message)
    {     
        $this->message= 'xxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxx';
    } 

    
    public function render()
    {
        return view('livewire.message-admin');
    }
}
