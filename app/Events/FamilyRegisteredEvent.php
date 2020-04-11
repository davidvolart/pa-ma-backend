<?php

namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class FamilyRegisteredEvent
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $family_code;
    public $partner_email;

    /**
     * FamilyRegisteredEvent constructor.
     * @param $family_code
     * @param $validatedData
     */
    public function __construct($family_code, $partner_email)
    {
        $this->family_code = $family_code;
        $this->partner_email = $partner_email;
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return \Illuminate\Broadcasting\Channel|array
     */
    public function broadcastOn()
    {
        return new PrivateChannel('channel-name');
    }
}
