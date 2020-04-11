<?php

namespace App\Listeners;

use App\Events\FamilyRegisteredEvent;
use App\Mail\FamilyRequestMail;
use Illuminate\Support\Facades\Mail;

class SendFamilyRequestToPartner
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
     * @param  object  $event
     * @return void
     */
    public function handle(FamilyRegisteredEvent $event)
    {
        $email = new FamilyRequestMail($event->family_code);
        Mail::to($event->partner_email)->send($email);
    }
}
