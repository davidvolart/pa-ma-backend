<?php

namespace App\Observers;

use App\Notifications\SignupActivate;
use App\User;

class UserObserver
{
    /**
     * Handle the user "created" event.
     *
     * @param  \App\User  $user
     * @return void
     */
    public function created(User $user)
    {
        $user->notify(new SignupActivate());
    }
}
