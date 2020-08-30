<?php

namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class ReservationEvent implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;
    private $message = 'New reservation!';
    private $type, $user;
    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct($message = "New reservation", $type = "new_reservation", $user = null)
    {
        $this->type = $type;
        $this->user = $user;
        $this->message = $message;
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return \Illuminate\Broadcasting\Channel|array
     */
    public function broadcastOn()
    {
        return new PrivateChannel('reservation');
        // return new Channel('reservation');
    }

    public function broadcastWith()
    {
        return [
            // 'id'       => $this->user->id,
            // 'name'     => $this->user->name,
            'action'   => $this->type,
            'on'       => now()->toDateTimeString(),
            'message' => $this->message
        ];
    }
}
