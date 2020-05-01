<?php

namespace App\Listeners;
use Illuminate\Support\Facades\Mail;
use App\Events\pauperBurialRequest;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class SendPauperBurialRequestEmail
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
     * @param  pauperBurialRequest  $event
     * @return void
     */
    public function handle(pauperBurialRequest $event)
    {
//try {
    //code...

        foreach ($event->user as $user) {

        $data = array('name' => $user->firstName, 'email' => $user->email,
        'body' => ' A new request has been made for Paupers Burial
        made by '.$event->corpse->user->email.' for '. $event->corpse->station->station.' Station/Section of the '. $event->corpse->station->division->division.' Division '.' Note use this id :'.
        $event->corpse->id.' for reference');


        Mail::send('emails.mail', $data, function($message) use ($data) {
            $message->to($data['email'])
                ->subject("Pauper's Burial Request");
        $message->from('jcfdbdsystem@gmail.com');
        });




       }

    // } catch (\Throwable $th) {
    //      echo json_encode($output=" Connection could not be established !!");;
    // }




    }
}
