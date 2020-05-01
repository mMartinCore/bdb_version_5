<?php

namespace App\Listeners;

use App\Events\UserRole;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Support\Facades\Mail;

class SendRoleEmail
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
     * @param  UserRole  $event
     * @return void
     */
    public function handle(UserRole $event)
    {

      // foreach ($event->user as $user) {

            $data = array('name' => $event->user->firstName, 'email' => $event->user->email, 'body' => 'Welcome to
            Disposal of Dead Body System. Always check your mail. Kindly note that you have been assigned the role : '. $event->user->roles()->pluck('name')->implode(' ') );
            Mail::send('emails.mail', $data, function($message) use ($data) {
                $message->to($data['email'])
                        ->subject('Assigned Role');
                $message->from('jcfdbdsystem@gmail.com');
            });


         //  }
    }
}
