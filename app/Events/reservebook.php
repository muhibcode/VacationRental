<?php

namespace App\Events;

use App\Models\Booking;
use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class reservebook implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $mess;
    public $nmsg;
    public $recID;
    /**
     * Create a new event instance.
     */
    public function __construct($mess, $nmsg)
    {
        $this->mess = $mess;
        $this->nmsg = $nmsg;

    }

    public function broadcastAs(): string
    {
        return 'booking';
    }

    // public function broadcastWith(): array
    // {
    //     return ['grmsg' => 'this is from brwith'];
    // }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return array<int, \Illuminate\Broadcasting\Channel>
     */
    public function broadcastOn(): Channel
    {
        return new Channel('booking-notify.' . $this->recID);

    }
}
