<?php

namespace App\Listeners;
use Illuminate\Support\Facades\Mail;
use App\Events\fifteenDays;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class SendFifteenDaysEmail
{
    public $subject='';
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
     * @param  fifteenDays  $event
     * @return void
     */
    public function handle(fifteenDays $event)
    {

        foreach ($event->user as $user) {
                   //  dd($event->corpse);
                   $this->subject='Fifteen (15) Days..Re:'.' '.$event->corpse['name']. ' Corpse picked up on'.' '.$event->corpse['pickupdate'];
                    $data = array('name' => $user->firstName, 'email' => $user->email,
                    'body' => ' Re:'.$event->corpse['name'].' Corpse picked up on '.$event->corpse['pickupdate'].' at '.$event->corpse['location'].' in '.$event->corpse['station'].
                    ' Police Area, within '. $event->corpse['division'].' Division. '.'
                    Be advised the above mentioned corpse has been in storage for fifteen (15) days.
                    It is imperative that the body be Post mortemed, Finger Printed, Gazetted or DNA be done as the case may be to facilitate burial forthwith. '.
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
