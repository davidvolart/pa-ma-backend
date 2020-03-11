<?php

namespace App\Listeners;

use App\Events\UserRegisteredEvent;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class UserRegisteredListener
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
     * @param  UserRegisteredEvent  $event
     * @return void
     */
    public function handle(UserRegisteredEvent $event)
    {
        if(is_null($event->getFamilyId())){
            //generate a family and save it
            //Send email to partner
            //Register user in UserFamily whith family id given in the generated family
        }else{
            //Register user in UserFamily
        }
    }
}
