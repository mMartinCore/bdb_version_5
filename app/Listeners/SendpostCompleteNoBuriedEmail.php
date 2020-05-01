<?php

namespace App\Listeners;
use Illuminate\Support\Facades\Mail;
use App\Events\postCompleteNoBuried;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class SendpostCompleteNoBuriedEmail
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public $subject='';
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  postCompleteNoBuried  $event
     * @return void
     */
    public function handle(postCompleteNoBuried $event)
    {

        foreach ($event->user as $user) {
                   //  dd($event->corpse);
                   $this->subject='Postmortem Completed and No Burial.. Re:'.' '.$event->corpse['name']. ' Corpse picked up on'.' '.$event->corpse['pickupdate'];
                    $data = array('name' => $user->firstName, 'email' => $user->email,
                    'body' => ' Re:'.$event->corpse['name'].' Corpse picked up on '.$event->corpse['pickupdate'].' at '.$event->corpse['location'].' in '.$event->corpse['station'].
                    ' Police Area, within '. $event->corpse['division'].' Division. '.'
                    Be advised that the above mentioned corpse has been in storage for days and not buried even though the Postmortem is completed.
                    It is imperative that the body be Finger Printed, Gazetted or DNA be done as the case may be to facilitate burial forthwith. '.
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
