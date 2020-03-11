<?php

namespace App\Events;

use App\User;
use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class UserRegisteredEvent
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    /**
     * @var User $user
     */
    private $user;

    /**
     * @var int $family_id
     */
    private $family_id;

    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct($user, $family_id)
    {
        $this->user = $user;
        $this->family_id = $family_id;
    }

   public function getUser(): User
   {
        return $this->user;
   }

   public function getFamilyId()
   {
        return $this->family_id;
   }
}
