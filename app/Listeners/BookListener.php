<?php

namespace App\Listeners;

use App\Events\reservebook;
use Illuminate\Broadcasting\Channel;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class BookListener
{
    /**
     * Create the event listener.
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     */
    public function handle(reservebook $event): void
    {
        // $mess = $event->mess;
        // broadcast(new Channel('booking-notify'));
    }
}
