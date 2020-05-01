<?php

namespace App\Listeners;
use Illuminate\Support\Facades\Mail;
use App\Events\requestStatus;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class SendRequestStatusEmail
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
     * @param  requestStatus  $event
     * @return void
     */
    public function handle(requestStatus $event)
    {

        foreach ($event->user as $user) {
                   //  dd($event->corpse);
                   $this->subject='(Approved) Re:'.' Pauper\'s'.' Burial of '.$event->corpse['name']. ' Corpse picked up on'.' '.$event->corpse['pickupdate'];
                    $data = array('name' => $user->firstName, 'email' => $user->email,
                    'body' => ' Re:'.$event->corpse['name'].' Corpse picked up on '.$event->corpse['pickupdate'].' at '.$event->corpse['location'].' in '.$event->corpse['station'].
                    ' Police Area, within '. $event->corpse['division'].' Division. '.'
                     It is imperative that the body be  buried forthwith. '.
                    ' Note use this id : '.$event->corpse['id'].' for reference.');

                    Mail::send('emails.mail', $data, function($message) use ($data) {
                        $message->to($data['email'])
                            ->subject($this->subject);
                    $message->from('jcfdbdsystem@gmail.com');
                    }
                );

          }


    }
}
