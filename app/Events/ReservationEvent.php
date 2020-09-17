<?php

namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;
use Carbon\Carbon;

class ReservationEvent implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;
    private $message = 'New reservation!';
    private $type, $user, $restaurant, $reservation;
    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct($restaurant, $reservation, $message = "New reservation", $type = "new_reservation", $user = null)
    {
        $this->type = $type;
        $this->user = $user;
        $this->message = $message;
        $this->restaurant = $restaurant;
        $this->reservation = $reservation;
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return \Illuminate\Broadcasting\Channel|array
     */
    public function broadcastOn()
    {
        // return new PrivateChannel('reservation');

        return new PrivateChannel('reservation.' . $this->restaurant->id);

        // return new Channel('reservation');
    }

    public function broadcastWith()
    {

        return [
            // 'id'       => $this->user->id,
            // 'name'     => $this->user->name,
            'first_name' => $this->reservation->first_name,
            'last_name' => $this->reservation->last_name,
            'number_of_people' => $this->reservation->number_of_people,
            'appointment_date' => Carbon::createFromFormat('Y-m-d', $this->reservation->appointment_date)->format('d-m-Y'),
            'appointment_time' => $this->reservation->appointment_time,
            'action'   => $this->type,
            'on'       => now()->toDateTimeString(),
            'message' => $this->message
        ];
    }
}
