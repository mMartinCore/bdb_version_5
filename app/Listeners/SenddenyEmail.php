<?php

namespace App\Listeners;
use Illuminate\Support\Facades\Mail;
use App\Events\deny;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class SenddenyEmail
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  deny  $event
     * @return void
     */
    public function handle(deny $event)
    {


        foreach ($event->user as $user) {
            $this->subject='(Request Denied) Re:'.' Pauper\'s'.' Burial of '.$event->corpse['name']. ' Corpse picked up on'.' '.$event->corpse['pickupdate'];
             $data = array('name' => $user->firstName, 'email' => $user->email,
             'body' => ' Re:'.$event->corpse['name'].' Corpse picked up on '.$event->corpse['pickupdate'].' at '.$event->corpse['location'].' in '.$event->corpse['station'].
             ' Police Area, within '. $event->corpse['division'].' Division. '.'
             It is imperative that the body be Post mortemed, Finger Printed, Gazetted or DNA be done as the case may be to facilitate burial forthwith. '.
             ' Note use this id : '.$event->corpse['id'].' for reference or use Crime reference no: '.$event->corpse['cr_no']);

             Mail::send('emails.mail', $data, function($message) use ($data) {
                 $message->to($data['email'])
                     ->subject($this->subject);
             $message->from('jcfdbdsystem@gmail.com');
             }
         );

   }
    }
}
