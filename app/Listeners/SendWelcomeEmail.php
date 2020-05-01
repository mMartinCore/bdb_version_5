<?php

namespace App\Listeners;

use App\Events\UserRegistered;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Support\Facades\Mail;
class SendWelcomeEmail
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
     * @param  UserRegistered  $event
     * @return void
     */
    public function handle(UserRegistered $event)
    {
        $data = array('name' => $event->user->firstName, 'email' => $event->user->email, 'body' => 'Welcome to
        Disposal of Dead Body System. Kindly note that you will be assigned a role shortly.');
        Mail::send('emails.mail', $data, function($message) use ($data) {
            $message->to($data['email'])
                    ->subject('Successful Registration');
            $message->from('jcfdbdsystem@gmail.com');
        });
    }
}
